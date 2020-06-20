<?php

    session_start();

    $conAjax = true;

    require_once("../controllers/adminController.php");

    if(!is_null($_POST['data'])){
        
        $data = json_decode($_POST['data']);
        $objController = new adminController();
    
        
        if($data->id === "SESSION"){
            # code...
            $res_session = $objController->sessionController($data);
            echo json_encode($res_session);            
        }

        elseif ($data->id === "I-REGISTRO") {
            # code...
            $res_insert = $objController->insertarUsuarioController($data);
            echo json_encode($res_insert);
        }

        else {
            echo json_encode("ERROR!!");
        }
    }else{
        echo json_encode("ERROR FATAL!");
    }
    

?>
