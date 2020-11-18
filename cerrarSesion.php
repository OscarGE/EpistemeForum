<?php
    session_name("Foro");
    session_start();
    if(@$_REQUEST["cerrar"]=="true"){
        session_unset();
        session_destroy();
        header("Location: index.php");
    }
?>