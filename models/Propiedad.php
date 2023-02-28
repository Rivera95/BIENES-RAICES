<?php 

namespace Model;

class Propiedad extends ActiveRecord {
    
  protected static $tabla = 'propiedades';
  protected static $columnasDB = ['id', 'titulo', 'precio', 'imagen', 'descripcion', 'habitaciones', 'wc',
    'estacionamiento', 'creado', 'vendedorId']; // MAPEA Y UNE EL OBJECTO QUE ESTAMOS CREANDO

  //INSTANCIA
  public $id;
  public $titulo;
  public $precio;
  public $imagen;
  public $descripcion;
  public $habitaciones;
  public $wc;
  public $estacionamiento;
  public $creado;
  public $vendedorId;

  public function __construct($args = [])
    {
        $this->id              = $args['id'] ?? null;
        $this->titulo          = $args['titulo'] ?? '';
        $this->precio          = $args['precio'] ?? '';
        $this->imagen          = $args['imagen'] ?? '';
        $this->descripcion     = $args['descripcion'] ?? '';
        $this->habitaciones    = $args['habitaciones'] ?? '';
        $this->wc              = $args['wc'] ?? '';
        $this->estacionamiento = $args['estacionamiento'] ?? '';
        $this->creado          = date('Y/m/d');
        $this->vendedorId      = $args['vendedorId'] ?? '';
    }

    public function validar() {
      // IF PARA IR AGREGANDO LAS VALIDACIONES AL ARREGLO ERRORES
        if(!$this->titulo){
          self::$errores[] = 'Debes insertar un titulo por favor.!';
        }
  
        if(!$this->precio){
          self::$errores[] = 'Debes insertar un precio por favor.!';
        }
  
        if(strlen($this->descripcion) < 20){
          self::$errores[] = 'Debes insertar una descripcion al menos con 20 caracteres.!';
        }
  
        if(!$this->habitaciones){
          self::$errores[] = 'Debes insertar las habitaciones por favor.!';
        }
  
        if(!$this->wc){
          self::$errores[] = 'Debes insertar los baños(wc) por favor.!';
        }
  
        if(!$this->estacionamiento){
          self::$errores[] = 'Debes insertar los estacionamiento por favor.!';
        }
  
        if(!$this->vendedorId){
          self::$errores[] = 'Debes insertar un vendedor por favor.!';
        }
  
        if(!$this->imagen) {
          self::$errores[] = 'La imagen es obligatoria por favor.!';
        }
  
          return self::$errores;
      }

}