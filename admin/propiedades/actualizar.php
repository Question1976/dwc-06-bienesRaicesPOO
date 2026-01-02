<?php    

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\Drivers\Gd\Driver;
    use Intervention\Image\ImageManager as Image;

    require '../../includes/app.php';

    // Comprobar autenticadión
    estaAutenticado();

    // Validar que sea un ID válido
    // y que no metan datos por url
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location: /admin');
    }

    // Obtener los datos de la propiedad 
    $propiedad = Propiedad::find($id);

    // Obtener los vendedores
    $vendedores = Vendedor::all();

    // Array con mensajes de errores
    $errores = Propiedad::getErrores();
        
    // Ejecutar el código después de que
    // el usuario envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Asignar los atributos
        $args = $_POST['propiedad'];

        // Sincroniza el obj en memoria
        // con los cambios realizados
        // por el usuario
        $propiedad->sincronizar($args);

        // Validación
        $errores = $propiedad->validar();

        // == SUBIDA DE IMÁGENES ==       
                      
        // Si el array de errores está vacio
        // (es que no hay ningún error)
        // se ejecuta la consulta sql para 
        // crear registro/propiedad
        if (empty($errores)) {

            // Setear la imagen
            // Realiza un resize a la imagen
            // con 'intervention'
            if ($_FILES['propiedad']['tmp_name']['imagen']) {

                // Generar un nombre único a la imagen
                $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";
                            
                $manager = new Image(Driver::class);
                $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
                $propiedad->setImagen($nombreImagen);
                
                // Almacenar la imagen
                $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            }

            
            $propiedad->guardar();            

        }        
    }
                                     
    incluirTemplate('header');             //include 'includes/templates/header.php';     
?>

    <!-- Main | contenido principal -->
    <main class="contenedor seccion">
        <h1>Actualizar propiedad</h1>
        
        <a href="/admin" class="boton boton-verde">Volver</a>

        <!-- Mostrar errores del formulario -->
        <?php foreach($errores as $error) { ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        

        <form class="formulario" method="POST" enctype="multipart/form-data">
            
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Actualizar propiedad" class="boton boton-amarillo">
        </form>
    </main> 

<?php  
    incluirTemplate('footer');          //include 'includes/templates/footer.php';
?>