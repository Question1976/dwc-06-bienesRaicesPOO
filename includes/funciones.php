<?php
/** 
 * === Configuración de rutas ===
 */

define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', __DIR__ . '/../imagenes/');

function incluirTemplate( string $nombre, bool $inicio = false) {
    include TEMPLATES_URL . "/$nombre.php";
}

/** 
 * === Comprobar autenticación ===
 */

/**
 * Comprobar atutenticación
 */
function estaAutenticado() {
    session_start();

    if (!$_SESSION['login']) {          // si NO está autenticado
        header('Location: /');          // redireccionar al index
    }
}

/**
 * Debuguear
 */
function debuguear($variable) {
    echo "<pre>";
    var_dump($variable);
    echo "</pre>";
    exit;
}

/**
 * Sanitizar HTML
 * Evitar inyección SQL
 */
function s($html) : string {                        
    $s = htmlspecialchars($html);                    
    return $s;
}

/**
 * Validar tipo de contenido
 */
function validarTipoContenido($tipo) {
    $tipos = ['vendedor', 'propiedad'];    
    return in_array($tipo, $tipos);
}

/**
 * Mostrar mensajes
 */
function mostrarNotificacion($codigo) {
    $mensaje = '';

    switch ($codigo) {
        case 1:
            $mensaje = 'Creado correctamente';
            break;        
        case 2:
            $mensaje = 'Actualizado correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }

    return $mensaje;
}