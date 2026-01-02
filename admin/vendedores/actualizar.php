<?php

    // Comprobar autenticadión
    require '../../includes/app.php';

    use App\Vendedor;

    estaAutenticado();

    // Validar que sea un ID válido
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header('Location: /admin');
    }

    // Obtener el array del vendedor
    $vendedor = Vendedor::find($id);

    // Array con mensajes de errores
    $errores = Vendedor::getErrores();

    // Ejecutar el código después de que
    // el usuario envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // Asignar los valores
        $args = $_POST['vendedor'];
        
        // Sincronizar obj en memoria
        // con lo que el usuario escribió
        $vendedor->sincronizar($args);

        // Validación
        $errores = $vendedor->validar();

        // Si pasa la validación
        // Actualizar!
        if (empty($errores)) {
            $vendedor->guardar();
        }
        
    }    

    incluirTemplate('header');               //include 'includes/templates/header.php';  

?>

    <!-- Main | contenido principal -->
    <main class="contenedor seccion">
        <h1>Actualizar vendedor(a)</h1>
        
        <a href="/admin" class="boton boton-verde">Volver</a>

        <!-- Mostrar errores del formulario -->
        <?php foreach($errores as $error) { ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php } ?>        

        <form class="formulario" method="POST">
            
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>

            <input type="submit" value="Guardar cambios" class="boton boton-verde">
        </form>
    </main> 

<?php  
    incluirTemplate('footer');          //include 'includes/templates/footer.php';
?>