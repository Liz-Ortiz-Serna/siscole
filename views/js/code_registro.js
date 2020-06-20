//****************************************************************************************** */
//****************************************************************************************** */
//**************************** FUCNIONES MODULO REGISTRO **************************** */
//****************************************************************************************** */
//****************************************************************************************** */

//****************************************************************************************** */
//****************************************************************************************** */
//------------------ INSERTAR SLIDER ------------------------------
/**
 *  
 */
function dataHTML_registro(){   
    let txt_user = document.querySelector("#user");    
    let txt_password = document.querySelector("#password");    

    return {
        element:{
            txt_user,
            txt_password
        },
        value:{      
            txt_userv : tratar_elemento(txt_user),
            txt_passwordv: tratar_elemento(txt_password)
        }
    }
}
/**
 * 
 */
function eval_registro(){    
    let dataHTML = dataHTML_registro();
    let {txt_user, txt_password} = dataHTML.element;     
    
    let arr_elemetos = [txt_user, txt_password];
    let cont_err = 0;
    arr_elemetos.forEach(element => {
        if(tratar_elemento(element).length == 0){
            cont_err += 1;
            intercambiaClases(element,'is-valid','is-invalid',false)
        }else{
            intercambiaClases(element,'is-invalid','is-valid',false)
        }
        
    });
    
    if(cont_err != 0){
        sweetModalMin('Falta completar los datos!','top-end',3000,'error');        
        return false;
    }else{        
        return true;
    }

}

/**
 * 
 */
function execute_registro(){    
    if(eval_registro()){
        let dataHTML = dataHTML_registro();
        let {txt_userv, txt_passwordv} = dataHTML.value;
        
        fetchKev('POST',{
            id:'I-REGISTRO',
            txt_userv, 
            txt_passwordv,
            estado:0
        },data=>{            
            console.log(data);
            if(data.eval){                
                sweetModal('Datos registrados!','center','success',1500);
            }else{
                sweetModal('No se registro el usuario!!','center','error',1500);
            }
        },URL_AJAX_PROCESAR); //URL_AJAX_PROCESAR

    }
}

//-- FUNCIONES DE OPERACION 
/**
 * @param {string} type_img formato de imagagen. EJM 'img/jpeg'. Este dato es proporcionado por la propiedad 'type' del elemento FILE html
 * ------------ EN QUE FUNCIONES SE ESTÁ USANDO
 * @function eval_registro Se está usando en está funcion (descripcion)
 *  
 */
function nombrePrueba_registro(){    
    return true;
}

function compruebaEmail_registro(){       
    return true;
}