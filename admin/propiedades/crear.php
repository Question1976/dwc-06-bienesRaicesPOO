<?php 
    // Comprobar autenticadión
    require '../../includes/app.php';

    use App\Propiedad;
    use App\Vendedor;
    use Intervention\Image\Drivers\Gd\Driver;
    use Intervention\Image\ImageManager as Image;

    estaAutenticado();

    // Instanciar clase
    $propiedad = new Propiedad;  

    // Obtener vendedores
    $vendedores = Vendedor::all();

    // Array con mensajes de errores
    $errores = Propiedad::getErrores();
    
    // Ejecutar el código después de que
    // el usuario envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Instanciar 'Propiedad'
        // referencia para leer atributos
        // del objeto mapeado
        $propiedad = new Propiedad($_POST['propiedad']);

        // == SUBIDA DE IMÁGENES ==         

        // Setear la imagen
        // Realiza un resize a la imagen
        // con 'intervention'
        if ($_FILES['propiedad']['tmp_name']['imagen']) {
            
            // Generar un nombre único a la imagen
            $nombreImagen = md5( uniqid( rand(), true ) ) . ".jpg";

            $manager = new Image(Driver::class);
            $imagen = $manager->read($_FILES['propiedad']['tmp_name']['imagen'])->cover(800, 600);
            $propiedad->setImagen($nombreImagen);
        }

        // Validar campos formaulario
        $errores = $propiedad->validar();           
         
        // Si el array de errores está vacio
        // (es que no hay ningún error)
        // se ejecuta la consulta sql para 
        // crear registro/propiedad
        if (empty($errores)) {                              
            
            // Crear carpeta 
            // en la carpeta raiz del proyecto
            if (!is_dir(CARPETA_IMAGENES)) {
                mkdir(CARPETA_IMAGENES);                
            }   
            
            // Guardar la imagen en el servidor
            $imagen->save(CARPETA_IMAGENES . $nombreImagen);
            
            // Guardar Propiedad 
            // C -> CRUD
            $resultado = $propiedad->guardar();

        }        
    }
                               
    incluirTemplate('header');               //include 'includes/templates/header.php';     
?>

    <!-- Main | contenido principal -->
    <main class="contenedor seccion">
        <h1>Crear propiedad</h1>
        
        <a href="/admin" class="boton boton-verde">Volver</a>

        <!-- Mostrar errores del formulario -->
        <?php foreach($errores as $error) { ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        

        <form class="formulario" method="POST" action="/admin/propiedades/crear.php" enctype="multipart/form-data">
            
            <?php include '../../includes/templates/formulario_propiedades.php'; ?>

            <input type="submit" value="Crear propiedad" class="boton boton-verde">
        </form>
    </main> 

<?php  
    incluirTemplate('footer');          //include 'includes/templates/footer.php';
?>