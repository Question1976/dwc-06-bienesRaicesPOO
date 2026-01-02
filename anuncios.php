<?php 
    require 'includes/app.php';                                 
    incluirTemplate('header');          //include 'includes/templates/header.php';     
?>

    <!-- Main | contenido principal -->
    <main class="contenedor seccion">
        <!-- Propiedades -->
        <section class="seccion contenedor">
            <h2>Casas y apartamentos en venta</h2>

            <?php 
                // Límite de propiedades a mostrar
                $limite = 12;

                // Traer template
                include 'includes/templates/anuncios.php';
            ?>

            <div class="alinear-derecha">
                <a href="anuncios.php" class="boton-verde">Ver todas</a>
            </div>
        </section>
    </main>

<?php  
    incluirTemplate('footer');          //include 'includes/templates/footer.php';
?>