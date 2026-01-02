<?php

namespace App;

class Vendedor extends ActiveRecord {

    /**
     * Definir como se llama la tabla
     * que administra los vendedores
     */
    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono'];

    /**
     * Atributos
     */
    public $id;                                         
    public $nombre;
    public $apellido;
    public $telefono;

    /**
     * Constructor
     */
    public function __construct($args = [])             
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
       
    }

    /**
     * Mensajes de validación
     * del formulario
     */
    public function validar() {                         

        if (!$this->nombre) {
            self::$errores[] = "El nombre es obligatorio";
        }
        
        if (!$this->apellido) {
            self::$errores[] = "El apellido es obligatorio";
        }

        if (!$this->telefono) {
            self::$errores[] = "El teléfono es obligatorio";
        }

        if (!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = "Formato no válido";
        }
                
        return self::$errores;
    }
}