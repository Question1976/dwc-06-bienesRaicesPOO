<?php
    // Incluye templates
    require 'includes/app.php'; 

    // Importar la conexión    
    $db = conectarDB();

    // Crear email y password
    $email = "correo@correo.com";
    $password = "123456";

    $passwordHash = password_hash($password, PASSWORD_BCRYPT);

    //var_dump($passwordHash);

    // Query para crear el usuario
    $query = "INSERT INTO usuarios (email, password) VALUES ('$email', '$passwordHash');";

    //echo $query;

    // Agregar usuario a la bbdd
    mysqli_query($db, $query);