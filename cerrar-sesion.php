<?php 
    // Iniciar sesión
    session_start();

    // Cerrar sesión
    $_SESSION = [];

    //var_dump($_SESSION);

    header('Location: /');