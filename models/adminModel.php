<?php

    $conAjax = is_null($conAjax)?false:$conAjax;
    if($conAjax){
        require_once "../models/mainModel.php";
    }else{
        require_once "./models/mainModel.php";
    }

    class adminModel extends mainModel{        
        
        /**
         * (IMPORTANTE)
         * Parte Modulo session 
         */
        protected function obtenerUsuarioSession($user,$password){
            $query = "SELECT * FROM usuario WHERE user='{$user}' AND estado=1";
            $result = mainModel::ejecutar_una_consulta($query);
            if($result->rowCount() >= 1){
                $arr_data = [];
                $eval = false;
                while($reg_user = $result->fetch(PDO::FETCH_ASSOC)){
                    if(self::encriptar_desencriptar($password,$reg_user['password'])){
                        $arr_data = $reg_user;
                        $eval = true;
                    }
                }

                if($eval){
                    $arr_dataGenerales = $this->obtenerUsuarioDatosGenerales($arr_data['idusuario']);
                }

                return ['eval'=>$eval,'data'=>array_merge($arr_data, $arr_dataGenerales)];
            }else{
                return ['eval'=>$eval, 'data'=>[]];
            }
        }

        private function obtenerUsuarioDatosGenerales($idusuario){
            $query = "SELECT * FROM personal WHERE personal.usuario_idusuario = '{$idusuario}'";
            $result = mainModel::ejecutar_una_consulta($query);
            if($result->rowCount() >= 1){
                return $result->fetch(PDO::FETCH_ASSOC);
            }
            return [];
        }

        /**
         * 
         */
        protected function insertarUsuarioModel($data){
            $query = "INSERT INTO usuario SET
                    user = '{$data->user}',
                    password = '{$data->password}',
                    estado = {$data->estado}
                ";
            
            $result = mainModel::ejecutar_una_consulta($query);
            if($result->rowCount() >= 1){
                //INSERTAANDO DATOS POR DEFECTO
                $ok = $this->insertarUsuarioDatosDefaultModel($data);
                if($ok){
                    return ["eval"=>true,'data'=>$data];                    
                }
            }
            return ['eval'=>false,'data'=>[]];
        }

        private function insertarUsuarioDatosDefaultModel($data){
            $idusuario = $this->id_obtenerusuarioModel($data->user);
            $query = "INSERT INTO personal SET personal.usuario_idusuario = '{$idusuario}'";                
            $result = mainModel::ejecutar_una_consulta($query);
            if($result->rowCount() >= 1){
                return true;
            }else{
                return false;
            }
        }

        private function id_obtenerusuarioModel($user){
            $query = "SELECT idusuario FROM usuario WHERE user = '{$user}'";
            $result = mainModel::ejecutar_una_consulta($query);
            if($result->rowCount() >= 1){
                $res_id = $result->fetch(PDO::FETCH_ASSOC);
                return $res_id['idusuario'];
            }else{
                return null;
            }
        }

        
        
        //-------------------------------------------------------------------------------
        /**
         * (IMPORTANTE)
         * si es verad encripta y sino desencripta
         * @param boolean $encriptar
         * Contraseña a encriptar o desencriptar
         * @param string $password
         * @return string boolean
         * 
         * Función que encripta y desencripta
         */        
        protected function encriptar_desencriptar($password,$password_db){
            if(trim($password_db) === ''){
                return password_hash($password, PASSWORD_DEFAULT);//Encripta 
            }else{
                return password_verify($password,$password_db);//desencripta
            }
        }



    }

?>