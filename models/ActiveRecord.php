<?php 

namespace Model;

class ActiveRecord {

    //BASE DE DATOS
    protected static $db;
    protected static $columnasDB = []; // MAPEA Y UNE EL OBJECTO QUE ESTAMOS CREANDO
    protected static $tabla = '';

    //ERRORES O VALIDACION
    protected static $errores = [];

     //DEFINIR LA CONEXION A LA BD
     public static function setDB($database) {
        self::$db = $database;
     }

    public function guardar() {
        if(!is_null($this->id)){
          //ACTUALIZAR
          $this->actualizar();
        } else {
          //CREANDO UN NUEVO REGISTRO
          $this->crear();
        }
    }

    public function crear(){

        // SANITIZAR LOS DATOS
        $atributos = $this->sanitizarAtributos();
     
        // INSERTAR EN LA BD
        $query = " INSERT INTO " . static::$tabla . " ( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (' ";
        $query .= join("', '", array_values($atributos));
        $query .= " ') ";

        // ALMACENAMOS EN LA BASE DE DATOS
        $resultado = self::$db->query($query);

         // MENSAJE DE LA CONFIRMACIÓN DE LA INSERTADA DE DATOS
         if($resultado) {

          header('Location: /admin?resultado=1'); // ME MANDA A LA VISTA ADMIN CUANDO INSERTA
    }
    }

    public function actualizar() {
       // SANITIZAR LOS DATOS
       $atributos = $this->sanitizarAtributos();

       $valores = [];
       foreach($atributos as $key => $value) {
         $valores[] = "{$key}='{$value}'";
       }
       
       // INSERTAR EN LA BD
       $query = " UPDATE " . static::$tabla . " SET ";
       $query .= join(', ', $valores );
       $query .= " WHERE id = '" . self::$db->escape_string($this->id) . "' ";
       $query .= " LIMIT 1 ";

       $resultado = self::$db->query($query);

        // CONFIRMACIÓN DE LA INSERTADA DE DATOS
        if($resultado) {
          header('Location: /admin?resultado=2'); // ME MANDA A LA VISTA ADMIN CUANDO INSERTA
    }
    }

    //ELIMINAR UN REGISTRO
    public function eliminar() {
      $query = "DELETE FROM " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
      $resultado = self::$db->query($query);

      if($resultado){
        $this->borrarImagen();
        header('Location: /admin?resultado=3');
    }
    }

    //ITERAR LOS ATRIBUTOS | IDENTIFICAR CUALES TENEMOS Y UNIR LOS ATRIBUTOS DE LA BD
    public function atributos() {
        $atributos = [];
        foreach(static::$columnasDB as $columna) {
            if($columna === 'id') continue; // CUANDO SE CUMPLE EL IF DEJA DE FUNCIONAR
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    //SANITIZAR LOS ATRIBUTOS
    public function sanitizarAtributos() {
         $atributos = $this->atributos();
         $sanitizado = [];
         foreach($atributos as $key => $value) { //ARREGLO SOCIATIVO EL KEY SON LOS CAMPOS Y VALUE LO QUE EL CLIENTE DIGITO
            $sanitizado[$key] = self::$db->escape_string($value);
         }

         return $sanitizado;
    }

    //SUBIDA DE ARCHIVOS
    public function setImagen($imagen) {
      // ELIMINAR LA IMAGEN PREVIA
      if(!is_null($this->id)){
        //COMPROBAR SI EXISTE EL ARCHIVO
        $this->borrarImagen();
      }
        //ASIGNAR AL ATRIBUTO DE IMAGEN EL NOMBRE DE LA IMAGEN
        if($imagen) {
            $this->imagen = $imagen;
        }
    }

    //ELIMINAR ARCHIVO
    public function borrarImagen() {
      //COMPROBAR SI EXISTE EL ARCHIVO
      $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
      if($existeArchivo) {
        unlink(CARPETA_IMAGENES . $this->imagen);
      }
    }

    // VALIDACION
    public static function getErrores() {
        return static::$errores;
    }

    public function validar() {
    // LAS VALIDACIONES AL ARREGLO ERRORES
      static::$errores = [];
      return static::$errores;
    }

    //LISTA TODAS LAS PROPIEDADES
    public static function all() {
        $query = "SELECT * FROM " . static::$tabla;
        $resultado = self::consultarSQL($query);

        return $resultado;
    }

    //OBTIENE DETERMINADO NUMERO DE REGISTROS
    public static function get($cantidad) {
      $query = "SELECT * FROM " . static::$tabla . " LIMIT " . $cantidad;
      $resultado = self::consultarSQL($query);

      return $resultado;
  }

    // BUSCA UN REGISTRO POR SU ID
    public static function find($id) {
      $query = "SELECT * FROM " . static::$tabla . " WHERE id = ${id}";
      $resultado = self::consultarSQL($query);

      return array_shift( $resultado );
    }

    //CONSULTAR MI SQL
    public static function consultarSQL($query) {
       //CONSULTAR LA BASE DE DATOS
       $resultado = self::$db->query($query);

       // ITERAR LOS RESULTADOS
       $array = [];
       while($registro = $resultado->fetch_assoc()) {
          $array[] = static::crearObjeto($registro);
       }

       //LIBERAR LA MEMORIA
       $resultado->free();

       //RETORNAR LOS RESULTADOS
       return $array;
    }

    protected static function crearObjeto($registro) {
       $objeto = new static;

       foreach($registro as $key => $value ) { //ARREGLO ASOCIATIVO
           if( property_exists( $objeto, $key ) ) { // MAPEANDO
               $objeto->$key = $value;
           }
       }

       return $objeto;
    }

    //SINCRONIZA EL OBJETO EN MEMORIA CON LOS CAMBIOS REALIZADOS POR EL USUARIO
    public function sincronizar( $args = []) {
        foreach($args as $key => $value) {
          if(property_exists($this, $key) && !is_null($value)) {
            $this->$key = $value;
          }
        }
    }
}