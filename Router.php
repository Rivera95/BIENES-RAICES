<?php 

namespace MVC;

class Router {

    public function get($url, $fn)
    {
       $this->rutasGET[$url] = $fn;
    }

    public function post($url, $fn)
    {
       $this->rutasPOST[$url] = $fn;
    }

    public $rutasGET  = [];
    public $rutasPOST = [];
   

    public function comprobarRutas()
    {
        session_start();
        $auth = $_SESSION['login'] ?? null;

        // Arreglo de rutas protegidas..
        $rutas_protegidas = ['/admin', '/propiedades/crear', '/propiedades/actualizar', '/propiedades/eliminar',
        '/vendedores/crear', '/vendedores/actualizar', '/vendedores/eliminar'];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/'; //LEER LA URL ACTUAL
        $metodo = $_SERVER['REQUEST_METHOD'];

        if($metodo === 'GET') {
           $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
           $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        // Proyeger las rutas
        if(in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if($fn) {
            //LA URL EXISTE Y HAY UNA FUNCION ASOCIADA
            call_user_func($fn, $this);
        } else {
            echo "Pagina no encontrada";
        }
    }

    
    //MUESTRA UNA VISTA
    public function render($view, $datos = [])
    {
        foreach($datos as $key => $value){
           $$key = $value; // $$ variable de variable
        }

        ob_start(); // INICIAR UN ALMACENAMIENTO EN MEMORIA
        include_once __DIR__ . "/views/$view.php";

        $contenido = ob_get_clean(); // LIMPIAR MEMORIA
        include_once __DIR__ . "/views/layout.php";
    }
}