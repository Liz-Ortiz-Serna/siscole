<?php

    $conAjax = is_null($conAjax)?false:$conAjax;
    if($conAjax){
        require_once "../models/adminModel.php";
    }else{
        require_once "./models/adminModel.php";
    }

    class adminController extends adminModel{

        /**
         * VERIFICADO
         * (IMPORTANTE)
         */
        public function verificarSessionController(){
            $session = (isset($_SESSION['start']) && !empty($_SESSION['start']) &&!is_null($_SESSION)) ? true:false;
            return $session;
        }


        /**
         * VERIFICADO
         * (IMPORTANTE)
         */
        public function administrarPaginasController($session){

            //Cuando la sessión sea VERDADERA
            if($session){
                
                $pagina = isset($_GET['pg']) && !empty($_GET['pg']) ? $_GET['pg'] : "inicio";
                $pagina = strtolower(trim($pagina));   

                //Validando niveles de seguridad. [1]:NIVEL ADMINISTRADOR []:OTROS USUARIOS
                if($_SESSION['data']['tipo_usuario']==1){
                    $arrayPaginas = ["salir_sistema","inicio","prueba"];
                }else{
                    $arrayPaginas = ["salir_sistema","inicio","prueba"];
                }              
                
                /**
                 * Solo en caso de que esté logueado; verifica pagina seleccionada, y luego lo redirige.
                 * Si no coincide con ninguna página, te ridirecciona a la página de Inicio.php
                 */
                if(in_array($pagina, $arrayPaginas, true)){
                    $pagina .= ".php";
                }else {
                    $pagina = "inicio.php";
                }

            }else{
                //CUANDO LA SESSIÓN NO EXISTA
                //Presentación de la página principal

                $pagina = isset($_GET['pg']) && !empty($_GET['pg']) ? $_GET['pg'] : "login";
                $pagina = strtolower(trim($pagina));                          
                $arrayPaginas = ['login',"registro"];

                if(in_array($pagina, $arrayPaginas, true)){
                    $pagina .= ".php";
                }else {
                    $pagina = "login.php";
                }                
            
            }  

            return $pagina;

        }



        /**
         * VERIFICADO
         * (IMPORTANTE)
         */
        public function sessionController($data){
            //Recibiendo datos de la página
            $user = $this->txtres($data->userv);
            $password = $this->txtres($data->passwordv);
            //enviado datos al modelo
            $resModel = adminModel::obtenerUsuarioSession($user,$password);            
            //evaluando resultados
            if($resModel['eval']){
                //Obtener datos. y devolviendo resultado a la pagina (vista-usuario)
                $resData = $resModel['data'];                
                //Iniciando session
                session_start();
                $_SESSION['start']=true;
                $_SESSION['data']=$resData;
                //Retornando los datos a la vista
                return ['eval'=>true,'data'=>$resData];
            }else{
                return ['eval'=>false,'data'=>[]];
            }
        }


        /**
         * @return Array
         * @param Object $data
         * Funcion que insertar usuarios en la db
         */
        public function insertarUsuarioController($data){ 

            $password_hash = self::encriptar_desencriptar($this->txtres($data->txt_passwordv),'');

            $dataModel = new stdClass;

            $dataModel->user = $this->txtres($data->txt_userv);
            $dataModel->password = $password_hash;
            $dataModel->estado = ( $this->txtres($data->estado) ) ? 0 : 0 ;

            $resModel = adminModel::insertarUsuarioModel($dataModel);

            return $resModel;            
            
        }
        
        

        //------------------------------------------------------------------------------

        /**
         * (IMPORTANTE)
         * Parametro
         * @param {string} $variable
         * @return {string}
         * 
         * Limpia los espacios al principio y alfinal y luego lo convierte a minuscula
        */
        private function txtres($variable){
            return mb_strtolower(trim($variable),'UTF-8');            
        }

        
        /**
         * ----------------- prueba :D 
         */        
        public function probando123(){
            return "hello from server xd ";
        }



    }



?>