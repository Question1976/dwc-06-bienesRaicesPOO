<?php 
    // Importar clases
    use App\Propiedad;

    
    // Si estamos en 'anuncios.php'...
    // Muestra todos las propiedades
    if ($_SERVER['SCRIPT_NAME'] === '/anuncios.php') {
        
        // Traer registros
        $propiedades = Propiedad::all();
        
    } else {
        // Si estamos en el 'index.php'...
        // Muestra sólo 3 propiedades

        // Traer registros
        $propiedades = Propiedad::get(3);
    }
?>

<div class="contenedor-anuncios">

    <?php foreach ($propiedades as $propiedad) { ?>

        <div class="anuncio">
            
            <img 
                src="/imagenes/<?php echo $propiedad->imagen; ?>" 
                alt="Imagen anuncio" 
                loading="lazy"
            >
            
            <div class="contenido-anuncio">
                <h3><?php echo $propiedad->titulo; ?></h3>
                <p><?php echo substr($propiedad->descripcion, 0, 60); ?> ...</p>
                <p class="precio"><?php echo $propiedad->precio; ?>€</p>

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

                <a 
                    href="anuncio.php?id=<?php echo $propiedad->id; ?>" 
                    class="boton-amarillo-block"
                >
                    Ver propiedad
                </a>
            </div><!-- .contenido-anuncio -->
        </div><!-- .anuncio -->

    <?php } ?>

</div><!-- .contenedor-anuncios -->