<?php 
    // Incluye templates
    require 'includes/app.php'; 

    // Importar la conexión de la bbdd    
    $db = conectarDB();

    // Array para mensajes de error
    $errores = [];

    // Autenticar el usuario
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
        // echo "<pre>";
        // var_dump($_POST);
        // echo "</pre>";

        // Capturar campos del formulario
        // y sanitizar entradas de datos
        $email = mysqli_real_escape_string($db, filter_var( $_POST['email'], FILTER_VALIDATE_EMAIL ) );
        $password = mysqli_real_escape_string($db, $_POST['password']);

        // Validaciones - Mensajes de error 
        // Campos vacíos
        if (!$email) {
            $errores[] = "El email es obligatorio o no es válido";
        }

        if (!$password) {
            $errores[] = "El password es obligatorio";
        }

        // Validaciones - Usuarios
        if (empty($errores)) {
            
            // Revisar si el usuario existe
            $query = "SELECT * FROM usuarios WHERE email = '$email';";
            $resultado = mysqli_query($db, $query);

            //var_dump($resultado);

            // Comprobar que hay resultados
            // en la consulta sql 
            if ( $resultado->num_rows ) {
                
                // Revisar si el password 
                // es correcto
                $usuario = mysqli_fetch_assoc($resultado);

                //var_dump($usuario);

                // Verificar si el password
                // es correcto o no
                $auth = password_verify($password, $usuario['password']);

                //var_dump($auth);

                if ($auth) {                    
                    // El usuario está autenticado
                    session_start();

                    // SESIÓN ACTIVA
                    // LLenar el array
                    // de la sesión
                    $_SESSION['usuario'] = $usuario['email'];
                    $_SESSION['login'] = true;

                    // echo "<pre>";
                    // var_dump($_SESSION);
                    // echo "</pre>";

                    // Autenticado, entrar
                    // como administrador
                    header('Location: /admin');

                } else {
                    $errores[] = "El password es incorrecto";
                }

            } else {
                $errores[] = "El usuario no existe";
            }
        }

        // echo "<pre>";
        // var_dump($errores);
        // echo "</pre>";
    }
                                    
    incluirTemplate('header');          //include 'includes/templates/header.php';     
?>

    <!-- Main | contenido principal -->
    <main class="contenedor seccion contenido-centrado">
        <h1>Iniciar sesión</h1>

        <?php foreach($errores as $error) { ?>
            <div class="alerta error">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        

        <form method="POST" class="formulario">
            <fieldset>
                <legend>Email y password</legend>

                <label for="email">E-mail</label>
                <input type="email" name="email" placeholder="Tu email" id="email" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Tu password" id="password" required>

            </fieldset>

            <input type="submit" value="Iniciar sesión" class="boton boton-verde">
        </form>
    </main> 

<?php  
    incluirTemplate('footer');          //include 'includes/templates/footer.php';
?>