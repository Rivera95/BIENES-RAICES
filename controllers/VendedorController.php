<?php

namespace Controllers;
use MVC\Router;
use Model\Vendedor;

class VendedorController {
    public static function crear(Router $router) {

        $errores = Vendedor::getErrores();
        $vendedor = new Vendedor;

    // EJECUTA EL CODIGO DESPUES DE QUE EL USUARIO ENVIAR EL FORMULARIO // SANITIZAMOS CON MYSQLI_REAL_ESCPA_STRING
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

    //CREAR UNA NUEVA INSTANCIA
    $vendedor = new Vendedor($_POST['vendedor']);

    //VALIDAR QUE NO HAYA CAMPOS VACIOS
    $errores = $vendedor->validar();

    //NO HAY ERRORES
    if(empty($errores)) {
        $vendedor->guardar();
    }
  }
  
        $router->render('/vendedores/crear', [
            'errores'  => $errores,
            'vendedor' => $vendedor
        ]);
    }

    public static function actualizar(Router $router) {

        $errores = Vendedor::getErrores();
        $id = validarORedireccionar('/admin');
        //Obtener datos del vendedor a actualizar
        $vendedor = Vendedor::find($id);

        // EJECUTA EL CODIGO DESPUES DE QUE EL USUARIO ENVIAR EL FORMULARIO // SANITIZAMOS CON MYSQLI_REAL_ESCPA_STRING
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            //ASIGNAR LOS VALORES
            $args = $_POST['vendedor'];
        //SINCRONIZAR OBJETO EN MEMORIA LO QUE EL CLIENTE ACTUALIZO
            $vendedor->sincronizar($args);
            //VALIDACION
            $errores = $vendedor->validar();

            if(empty($errores)) {
            $vendedor->guardar();
            }
    }
        
        $router->render('vendedores/actualizar', [
            'errores'  => $errores,
            'vendedor' => $vendedor
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
                $vendedor = Vendedor::find($id);
                $vendedor->eliminar();
               } 
            }
         }
    }
}