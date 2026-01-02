<?php 
    require 'includes/app.php';

    // Importar clases
    use App\Propiedad;

    // Validar el ID
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location: /');          // Redireccionar al index.php (principal)
    }
 
    // Traer registro
    $propiedad = Propiedad::find($id);

    incluirTemplate('header');          //include 'includes/templates/header.php';     
?>

    <!-- Main | contenido principal -->
    <main class="contenedor seccion contenido-centrado">
        <h1>
            <?php echo $propiedad->titulo; ?>
        </h1>
       
        <img 
            src="/imagenes/<?php echo $propiedad->imagen; ?>" 
            alt="Imagen de la propiedad" 
            loading="lazy"
        >

        <div class="resumen-propiedad">
            <p class="precio">
                <?php echo $propiedad->precio; ?>€
            </p>

            <ul class="iconos-caracteristicas">
                <li>
                    <img class="icono" src="build/img/icono_wc.svg" alt="Icono wc" loading="lazy">
                    <p>
                        <?php echo $propiedad->wc; ?>
                    </p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_estacionamiento.svg" alt="Icono estacionamiento" loading="lazy">
                    <p>
                        <?php echo $propiedad->estacionamiento; ?>
                    </p>
                </li>
                <li>
                    <img class="icono" src="build/img/icono_dormitorio.svg" alt="Icono dormitorio" loading="lazy">
                    <p>
                        <?php echo $propiedad->habitaciones; ?>
                    </p>
                </li>
            </ul>

            <p>
                <?php echo $propiedad->descripcion; ?>
            </p>
        </div>
    </main>

<?php 
    incluirTemplate('footer');          //include 'includes/templates/footer.php';
?>
