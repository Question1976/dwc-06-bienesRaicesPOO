<?php 
    // Arranca sesión si
    // no está definida
    if (!isset($_SESSION)) {        
        session_start();            
    }

    $auth = $_SESSION['login'] ?? false;

    //var_dump($auth);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienes Raices</title>
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <!-- Header -->
    <header class="header <?php echo $inicio ? 'inicio' : '' ?>"> <!-- index.php -->
        <div class="contenedor contenido-header">
            <div class="barra">
                <a href="/">
                    <img src="/build/img/logo.svg" alt="Imagen Logo">
                </a>

                <!-- Menú hamburguesa móvil -->
                <div class="mobile-menu">
                    <img src="/build/img/barras.svg" alt="Icono menu responsive">
                </div>

                <div class="derecha">
                    <img src="/build/img/dark-mode.svg" class="dark-mode-boton" alt="Imagen dark mode">
                    <nav class="navegacion">
                        <a href="/nosotros.php">Nosotros</a>
                        <a href="/anuncios.php">Anuncios</a>
                        <a href="/blog.php">Blog</a>
                        <a href="/contacto.php">Contacto</a>
                        <a href="/login.php">Login</a>

                        <?php if ($auth) { ?>
                            <a href="/cerrar-sesion.php">Cerrar sesión</a>
                        <?php } ?>
                    </nav>
                </div>

            </div><!-- .barra -->

            <?php
                // Muestra eslogan...
                if ($inicio) {
                    echo "<h1>Venta de casas y apartamentos</h1>";
                }
            ?>

        </div>
    </header>