<?php 

namespace Controllers;
use MVC\Router;
use Model\Propiedad;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController {
    public static function index(Router $router) {

        $propiedades = Propiedad::get(3);
        $inicio = true;
        
        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'inicio'      => $inicio
        ]);
    }

    public static function nosotros(Router $router) {
        
        $router->render('paginas/nosotros');
    }

    public static function propiedades(Router $router) {

        $propiedades = Propiedad::all();
        
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades
        ]);
    }

    public static function propiedad(Router $router) {

        $id = validarORedireccionar('/propiedades');
        // Buscar propiedad por ID
        $propiedad = Propiedad::find($id);
        
        $router->render('paginas/propiedad', [
             'propiedad' => $propiedad
        ]);
    }

    public static function blog(Router $router) {
        
        $router->render('paginas/blog');
    }

    public static function entrada(Router $router) {
        
        $router->render('paginas/entrada');
    }

    public static function contacto(Router $router) {

        $mensaje = null;
        
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $respuestas = $_POST['contacto'];
            // Crear una nueva instancia de PHPMailer
            $mail = new PHPMailer();

            // Configurar el SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Username = 'af414615935c3c';
            $mail->Password = 'a72fd711d829b6';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 2525;

            // Configurar el contenido del Mail
            $mail->setFrom('admin@bienesraices.com'); // Quien envia
            $mail->addAddress('admin@bienesraices.com', 'BienesRaices.com'); // Quien recibe
            $mail->Subject = 'Tienes un nuevo Mensaje';

            // Habilitar HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            // Definir el contenido
            $contenido  = '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre'] . '</p>';
            

            // Enviar de forma condicional algunos campos de email o telefono
            if($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Eligio ser contactado por Telefono:</p>';
                $contenido .= '<p>Teléfono: ' .       $respuestas['telefono'] . '</p>';
                $contenido .= '<p>Fecha Contacto: ' . $respuestas['fecha'] .    '</p>';
                $contenido .= '<p>Hora: ' .           $respuestas['hora'] .     '</p>';

            } else {
                // Es email, entonces agregamos el campo email
                $contenido .= '<p>Eligio ser contactado por Email:</p>';
                $contenido .= '<p>Email: ' . $respuestas['email'] . '</p>';
            }
            
            $contenido .= '<p>Mensaje: ' .                     $respuestas['mensaje'] .  '</p>';
            $contenido .= '<p>Vende o Compra: ' .              $respuestas['tipo'] .     '</p>';
            $contenido .= '<p>Precio o Presupuesto: $' .       $respuestas['precio'] .   '</p>';
            $contenido .= '<p>Prefiere ser contactado por: ' . $respuestas['contacto'] . '</p>';
            $contenido .= '</html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'Esto es texto alternativo sin HTML';

            // Enviar Email
            if($mail->send() ){
                $mensaje = "Mensaje enviado Correctamente";
            } else {
                $mensaje = "El mensaje no se pudo Enviar...!";
            }
        }

        $router->render('paginas/contacto', [
            'mensaje' => $mensaje
        ]);
    }
}