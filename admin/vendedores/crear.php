<?php

    // Comprobar autenticadión
    require '../../includes/app.php';

    use App\Vendedor;

    estaAutenticado();

    // Instanciar clase
    $vendedor = new Vendedor;

    // Array con mensajes de errores
    $errores = Vendedor::getErrores();

    // Ejecutar el código después de que
    // el usuario envia el formulario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Crear nueva instancia
        $vendedor = new Vendedor($_POST['vendedor']);

        // Validar
        // que no haya campos vacíos
        $errores = $vendedor->validar();

        // Si NO hay errores...
        // Guardar vendedor
        if (empty($errores)) {
            $vendedor->guardar();
        }

    }    

    incluirTemplate('header');               //include 'includes/templates/header.php';  

?>

    <!-- Main | contenido principal -->
    <main class="contenedor seccion">
        <h1>Registrar vendedor(a)</h1>
        
        <a href="/admin" class="boton boton-verde">Volver</a>

        <!-- Mostrar errores del formulario -->
        <?php foreach($errores as $error) { ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php } ?>        

        <form class="formulario" method="POST" action="/admin/vendedores/crear.php">
            
            <?php include '../../includes/templates/formulario_vendedores.php'; ?>

            <input type="submit" value="Registrar vendedor(a)" class="boton boton-verde">
        </form>
    </main> 

<?php  
    incluirTemplate('footer');          //include 'includes/templates/footer.php';
?>