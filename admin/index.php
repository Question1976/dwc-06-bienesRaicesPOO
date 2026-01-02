<?php
    require '../includes/app.php';
    
    // Comprobar autenticadión
    estaAutenticado();

    // Importar clases
    use App\Propiedad;
    use App\Vendedor;

    // Obtener todas las propiedades
    // R -> CRUD
    $propiedades = Propiedad::all();

    // Obtener todos los vendedores
    // R -> CRUD
    $vendedores = Vendedor::all();
    
    // Muestra mensaje condicional
    // Mandar valores desde 'crear.php'
    // aquí (index.php)
    $resultado = $_GET['resultado'] ?? null;

    // === Eliminar propiedad por ID ===
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Validar ID
        $id = $_POST['id'];
        $id = filter_var($id, FILTER_VALIDATE_INT);

        // Comprobar si el ID
        // es válido
        if ($id) {

            $tipo = $_POST['tipo'];

            if (validarTipoContenido($tipo)) {
                
                // Compara lo que 
                // vamos a eliminar
                if ($tipo === 'vendedor') {

                    // Obtener los datos del vendedor 
                    $vendedor = Vendedor::find($id);
        
                    $vendedor->eliminar(); 

                } else if ($tipo === 'propiedad') {
                    
                    // Obtener los datos de la propiedad 
                    $propiedad = Propiedad::find($id);
        
                    $propiedad->eliminar();        
                    
                }
            }       
                                                        
        }
    }
    
    // Incluye template
    //require '../includes/funciones.php';                                 
    incluirTemplate('header');          
         
?>

    <!-- Main | contenido principal -->
    <main class="contenedor seccion">
        <h1>Administrador de propiedades</h1>
        
        <?php
            /**
             * Mostrar notificaciones
             */
            $mensaje = mostrarNotificacion( intval($resultado) );   // convertir a INT

            if ($mensaje) { ?>
                <p class="alerta exito">
                    <?php echo s($mensaje); ?>
                </p>
            <?php } ?>                  
          
        <a href="/admin/propiedades/crear.php" class="boton boton-verde">Nueva propiedad</a>
        <a href="/admin/vendedores/crear.php" class="boton boton-amarillo">Nuevo(a) vendedor</a>

        <h2>Propiedades</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagen</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody> <!-- Mostrar los resultados del query -->
                <?php foreach( $propiedades as $propiedad ) { ?>
                    <tr>
                        <td>
                            <?php echo $propiedad->id; ?>
                        </td>
                        <td>
                            <?php echo $propiedad->titulo; ?>
                        </td>
                        <td>
                            <img src="/imagenes/<?php echo $propiedad->imagen; ?>" class="imagen-tabla">
                        </td>
                        <td>
                            <?php echo $propiedad->precio; ?> €
                        </td>
                        <td>
                            <form method="POST" class="w-100">
                                <!-- input (no visible) con el ID del registro a eliminar -->
                                <input 
                                    type="hidden" 
                                    name="id" 
                                    value="<?php echo $propiedad->id; ?>"
                                >
                                <input 
                                    type="hidden" 
                                    name="tipo" 
                                    value="propiedad"
                                > 
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>

                            <a 
                                href="/admin/propiedades/actualizar.php?id=<?php echo $propiedad->id; ?>" 
                                class="boton-amarillo-block">
                                Actualizar
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <h2>Vendedores</h2>

        <table class="propiedades">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Teléfono</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody> <!-- Mostrar los resultados del query -->
                <?php foreach( $vendedores as $vendedor ) { ?>
                    <tr>
                        <td>
                            <?php echo $vendedor->id; ?>
                        </td>
                        <td>
                            <?php echo $vendedor->nombre . " " . $vendedor->apellido; ?>
                        </td>                        
                        <td>
                            <?php echo $vendedor->telefono; ?> 
                        </td>
                        <td>
                            <form method="POST" class="w-100">
                                <!-- input (no visible) con el ID del registro a eliminar -->
                                <input 
                                    type="hidden" 
                                    name="id" 
                                    value="<?php echo $vendedor->id; ?>"
                                > 
                                <input 
                                    type="hidden" 
                                    name="tipo" 
                                    value="vendedor"
                                > 
                                <input type="submit" class="boton-rojo-block" value="Eliminar">
                            </form>

                            <a 
                                href="/admin/vendedores/actualizar.php?id=<?php echo $vendedor->id; ?>" 
                                class="boton-amarillo-block">
                                Actualizar
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </main> 

<?php      
    incluirTemplate('footer');          //include 'includes/templates/footer.php';
?>