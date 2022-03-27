<?php
    session_start();
    session_destroy();
    header("Location: http://projetweb/Accueil.php");
    exit();
?>