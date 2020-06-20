//****************************************************************************************** */
//****************************************************************************************** */
//****************************************************************************************** */
//------------------ LOGUIN DE USUARIO ------------------------------

/**
 *  
 */
function dataHTML_loginUser(){
    let user = document.querySelector("#user");
    let password = document.querySelector("#password");
    return {
        element:{
            user, password
        },
        value:{
            userv: tratar_elemento(user),
            passwordv: tratar_elemento(password)
        }
    };
}

function eval_loginUser(){
    let dataHtml = dataHTML_loginUser();
    let {userv,passwordv} = dataHtml['value'];
    let {user,password} = dataHtml['element'];

    let arr_element = [user,password];
    let cont = 0;
    arr_element.forEach(element=>{
        if(tratar_elemento(element).length != 0){            
            intercambiaClases(element,'is-invalid','is-valid',false);
            cont++;
        }else{
            intercambiaClases(element,'is-valid','is-invalid',false);
        }
    })

    if(cont != 0){
        return true;
    }else{
        sweetModalMin('Llenar los camposes','top-end',1500,'warning');
        return false;
    }
    //eliminar - mostrar ejemplo
    if(userv.length != 0 && passwordv.length != 0){
        intercambiaClases(user,'is-invalid','is-valid',false);
        intercambiaClases(password,'is-invalid','is-valid',false);
        return true;
    }else{
        (userv.length == 0)?intercambiaClases(user,'is-valid','is-invalid',false):intercambiaClases(user,'is-invalid','is-valid',false);
        (passwordv.length == 0)?intercambiaClases(password,'is-valid','is-invalid',false):intercambiaClases(password,'is-invalid','is-valid',false);        
        sweetModalMin('Llenar los campos','top-end',1500,'warning');
        return false;
    }
}
/**
 * 
 */
function execute_loginUser() {
    event.preventDefault();
    
    if(eval_loginUser()){
        let dataHtml = dataHTML_loginUser();
        let {user,password} = dataHtml['element'];
        let {userv,passwordv} = dataHtml['value'];

        fetchKev('post',{                   
            id:'SESSION',
            userv,
            passwordv
        },
        (data)=>{                    
            if(data.eval){
                location.reload(); // carga la página con la misma URL. de modo que es:: index.php?pg=login /                        
            }else{  
                sweetModalMin('Usuario no regstrado!!','top',2000,'warning');
                intercambiaClases(user,'is-valid',"",false);                      
                intercambiaClases(password,'is-valid',"",false);                      
            }
        }, URL_AJAX_PROCESAR);

    }
}

//-- FUNCIONES DE OPERACION
/**
 * 
 */