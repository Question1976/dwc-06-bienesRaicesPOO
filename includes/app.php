<?php
/**
 * === Variables y constantes de configuración ===
 * 
 * Archivo principal, es el que va a orquestar, 
 * manda llamar funciones, clases y bbdd.
 */

require 'funciones.php';
require 'config/database.php';
require __DIR__ . '/../vendor/autoload.php';

// Conectar a la bbdd
$db = conectarDB();

use App\ActiveRecord;

ActiveRecord::setDB($db);