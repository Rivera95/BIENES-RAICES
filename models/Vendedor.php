<?php 

namespace Model;

class Vendedor extends ActiveRecord {

    protected static $tabla = 'vendedores';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'telefono']; // MAPEA Y UNE EL OBJECTO QUE ESTAMOS CREANDO

    //INSTANCIA
    public $id;
    public $nombre;
    public $apellido;
    public $telefono;

    public function __construct($args = [])
    {
        $this->id         = $args['id'] ?? null;
        $this->nombre     = $args['nombre'] ?? '';
        $this->apellido   = $args['apellido'] ?? '';
        $this->telefono   = $args['telefono'] ?? '';
    }

    public function validar() {
        // IF PARA IR AGREGANDO LAS VALIDACIONES AL ARREGLO ERRORES
          if(!$this->nombre){
            self::$errores[] = 'Debes insertar un nombre por favor.!';
          }
          if(!$this->apellido){
            self::$errores[] = 'Debes insertar un apellido por favor.!';
          }
          if(!$this->telefono){
            self::$errores[] = 'Debes insertar un telefono por favor.!';
          }

          // EXPRESION REGULAR CARACTERES
          if(!preg_match('/[0-9]{10}/', $this->telefono)){
            self::$errores[] = 'Formato no valido.!';
          }

          return self::$errores;
    }
}