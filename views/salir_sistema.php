<?php

    unset($_SESSION['start']);
    session_destroy();
    
    $url_text_adicional = "system/Zb5CzbRI#S3kKL9gKEY6TKNxdnERKYQ";

    header("location:?$url_text_adicional");

?>