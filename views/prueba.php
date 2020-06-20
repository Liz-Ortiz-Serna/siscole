<!DOCTYPE html>
<html lang="es">
<head>
    
    <?php
        include_once('views/modules/cdnsheader.html');
    ?>

    <title>PRUEBA</title>
</head>
<body>

    <?php
        include_once("views/modules/navegacion.html");
    ?>



    <div class="container mt-4">
        <h1>HOLA MUNDO PRUEBA</h1>

        <?php
            var_dump($_SESSION)
        ?>


    </div>





    <?php        
        include_once('views/modules/cdnsfooter.html');
        include_once('views/modules/links_in_session.html');
    ?>

</body>
</html>