<?php

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController {

    public static function index(Router $router) {
        
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null; //PARA VALIDAR EL MENSAJE CUANDO SE INSERTA

        $router->render('propiedades/admin', [
            'propiedades' => $propiedades,
            'resultado'   => $resultado,
            'vendedores' => $vendedores
        ]);
    }

    public static function crear(Router $router) {

        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        // EJECUTA EL CODIGO DESPUES DE QUE EL USUARIO ENVIAR EL FORMULARIO // SANITIZAMOS CON MYSQLI_REAL_ESCPA_STRING
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

        //INSTANCIA NUEVA
        $propiedad = new Propiedad($_POST['propiedad']);

        /** SUBIDA DE ARCHIVOS */
             

        // GENERAR UN NOMBRE UNICO PARA EL NOMBRE DE LAS IMAGENES
        $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";

        //REALIZA UN RESIZE A LA IMAGEN CON LA LIBRERIA INTERVENTION
        //SETEAR IMAGEN
        if($_FILES['propiedad']['tmp_name']['imagen']) {
              $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
              $propiedad->setImagen($nombreImagen);
        }
  
        //VALIDACION
        $errores = $propiedad->validar();
        
        //REVISA QUE EL ARRAY DE ERRORES ESTE VACIO
        if(empty($errores)){

         // CREAR CARPETA DE IMAGENES
         if(!is_dir(CARPETA_IMAGENES)) {
               mkdir(CARPETA_IMAGENES);
         }
  
        //GUARDA LA IMAGEN EN EL SERVIDOR
        $image->save(CARPETA_IMAGENES . $nombreImagen);

        //GUARDAR BASE DE DATOS
        //FUNCION PARA GUARDAR
        $propiedad->guardar();

       
        }
  }

        $router->render('propiedades/crear', [
            'propiedad'  => $propiedad,
            'vendedores' => $vendedores,
            'errores'    => $errores
        ]);
    }

    public static function actualizar(Router $router) {
        
        $id = validarORedireccionar('/admin');
        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();

        // EJECUTA EL CODIGO DESPUES DE QUE EL USUARIO ENVIAR EL FORMULARIO // SANITIZAMOS CON MYSQLI_REAL_ESCPA_STRING
      if($_SERVER['REQUEST_METHOD'] === 'POST') {
            
        //ASIGNAR LOS ATRIBUTOS
        $args = $_POST['propiedad'];

        $propiedad->sincronizar($args);
        
        // VALIDACIÓN 
        $errores = $propiedad->validar();

        //SUBIDA DE ARCHIVOS
        // GENERAR UN NOMBRE UNICO PARA EL NOMBRE DE LAS IMAGENES
        $nombreImagen = md5( uniqid( rand(), true)) . ".jpg";
        //SETEAR IMAGEN
        if($_FILES['propiedad']['tmp_name']['imagen']) {
              $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800,600);
              $propiedad->setImagen($nombreImagen);
        }
  
        //REVISA QUE EL ARRAY DE ERRORES ESTE VACIO
        if(empty($errores)){
         //ALMACENAR LA IMAGEN
         if ($_FILES['propiedad']['tmp_name']['imagen']){
          $image->save(CARPETA_IMAGENES . $nombreImagen);
        }
        
        $propiedad->guardar();
        }
  }

        $router->render('/propiedades/actualizar', [
            'propiedad'  => $propiedad,
            'errores'    => $errores,
            'vendedores' => $vendedores
        ]);
    }

    public static function eliminar() {
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //VALIDAR ID
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);
   
            //QUERY PARA ELIMINAR
            if($id) {
               
               $tipo = $_POST['tipo'];
               if(validarTipoContenido($tipo)){
                $propiedad = Propiedad::find($id);
                $propiedad->eliminar();
               } 
            }
         }
    }
}