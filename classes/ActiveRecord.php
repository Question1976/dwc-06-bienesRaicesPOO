<?php

namespace App;

class ActiveRecord {

    /**
     * Atributos estáticos | bbdd
     */
    protected static $db;                               
    protected static $columnasDB = [];
    protected static $tabla = '';

    /**
     * Errores/Validación
     */
    protected static $errores = [];                     
      

    /**
     * Métodos estáticos
     */
    public static function setDB($database) {           
        self::$db = $database;
    }

    // === Métodos | lógica de negocio ===

    /**
     * Guardar registro 
     * en la bbdd
     */
    public function guardar() {
        if (isset($this->id)) {            
            $this->actualizar();        // Si hay un ID, Actualizar
        } else {
            $this->crear();             // Si NO hay un ID, Crear nuevo 
        }
    }

    /**
     * Crear registro
     */
    public function crear() {                                       
        
        // Sanitizar entrada de datos
        $atributos = $this->sanitizarAtributos();

        // Insertar los datos en la bbdd
        // query generado dinámicamente
        $query = "INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));           // llaves del array
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));       // valores del array 
        $query .= " ') ";

        $resultado = self::$db->query($query);

        if($resultado) {
            header('Location: /admin?resultado=1');                 // Redireccionar al usuario
        }
        return;                                                     //return $resultado;
    }

    /**
     * Actualizar registro
     */
    public function actualizar() {
        
        // Sanitizar entrada de datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];

        foreach ($atributos as $key => $value) {
            $valores [] = "{$key}='{$value}'";
        }

        // Insertar los datos en la bbdd
        // query generado dinámicamente
        $query = "UPDATE " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= " LIMIT 1 ";
        
        $resultado = self::$db->query($query);
        
        if($resultado) {
            header('Location: /admin?resultado=2');                 // Redireccionar al usuario
        }
       
        return $resultado;
    }

    /**
     * Eliminar registro
     */
    public function eliminar() {
        
        // Eliminar propiedad
        $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";

        $resultado = self::$db->query($query);
        
        if ($resultado) {
            $this->borrarImagen();
            header('Location: /admin?resultado=3');
        }
    }

    /**
     * Mapear las columnas con el obj en memoria
     */
    public function atributos() {                        
        $atributos = [];

        foreach(static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }

        return $atributos;
    }

    /**
     * Sanitizar los atributos
     */
    public function sanitizarAtributos() {              
        $atributos = $this->atributos();        
        $sanitizado = [];
        
        foreach($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }

    /**
     * Errores del formulario
     */
    public static function getErrores() {                       
        return static::$errores;
    }

    /**
     * Mensajes de validación
     * del formulario
     */
    public function validar() { 
        static::$errores = [];                         
        return static::$errores;
    }

    /**
     * Subida de archivos/imágenes
     * - 1ª Eliminar imagen previa 
     * - 2ª Asignar el atributo de imagen
     * el nombre de la imagen
     */
    public function setImagen($imagen) {
        if (isset( $this->id )) { 
            $this->borrarImagen();       // Eliminar imagen previa                      
        }

        if ($imagen) {                                                              
            $this->imagen = $imagen;    // Asignar al atributo imagen el nombre de la imagen
        }
    }

    /**
     * Eliminar imagen
     */
    public function borrarImagen() {
        // Comprobar si existe
        // el archivo
        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);

        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    /**
     * Listar todos los registros
     */
    public static function all() {                                   
        
        // Consulta SQL
        $query = "SELECT * FROM " . static::$tabla;

        // Pasar la consulta sql
        // al método 'consultarSQL'
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    /**
     * Obtiene un determinado
     * número de registros
     * para el index.php
     */
    public static function get($cantidad) {                                   
        
        // Consulta SQL
        $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;

        // Pasar la consulta sql
        // al método 'consultarSQL'
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    /**
     * Buscar un registro por su ID
     */
    public static function find($id) {                              
        
        // Consulta SQL
        $query = "SELECT * FROM " . static::$tabla . " WHERE id = $id";

        // Pasar la consulta sql
        // al método 'consultarSQL'
        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    /**
     * Consultar a la bbdd
     */
    public static function consultarSQL($query) {

        // Consultar la bbdd
        $resultado = self::$db->query($query);

        // Iterar los resultados
        $array = [];

        while ($registro = $resultado->fetch_assoc()) {     // trae array asociativo
            $array[] = static::crearObjeto($registro);        // convertir array en objeto 
        }

        // Liberar la memoria
        $resultado->free();

        // Retornar los resultados
        // un array de objetos
        return $array;
    }

    /**
     * Mapear los datos de array 
     * en objeto
     */
    protected static function crearObjeto($registro) {
        $objeto = new static;
        
        foreach($registro as $key => $value) {
            if (property_exists($objeto, $key)) {       
                $objeto->$key = $value;                  
            }
        }

        return $objeto;
    }

    /**
     * Sincroniza el obj en memoria 
     * con los cambios realizados 
     * por el usuario
     */
    public function sincronizar($args = []) {            
        foreach($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}