<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        include_once("./views/modules/cdnsheader.html");
    ?>    
    <title>REGISTRO DE USUARIO</title>
</head>
<body>
    
    <?php
        include_once "views/modules/navegacion_inicio.html";
    ?>

    <div class="container text-center mt-4">
        <h2 class="text-center">REGISTRO DE USUARIO</h2>
        <hr>
        <form action="/" class="col-md-5 py-3 d-inline-block">            
            <div class="form-group">
                <label for="user">USUARIO</label> <br>
                <input type="text" class="form-control" id="user">
                <div class="valid-feedback">Bien! Campos llenos.</div>
                <div class="invalid-feedback">Error! Llenar campo.</div>                
            </div>
            <div class="form-group">
                <label for="password">CONTRASEÑA</label> <br>
                <input type="password" class="form-control" id="password">
                <div class="valid-feedback">Bien! Campos llenos.</div>
                <div class="invalid-feedback">Error! Llenar campo.</div>
            </div>
            <div class="form-group">
                <submit class="btn btn-success btn-lg btn-block my-4" id="btn-registro" onclick="execute_registro()">REGISTRARSE</submit>
            </div>
        </form>    
    </div>

    <?php
        include_once("./views/modules/cdnsfooter.html");
        include_once('views/modules/links_not_session.html');
    ?>

</body>
</html>