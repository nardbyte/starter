<?php
// app/controllers/ContactController.php
namespace App\Controllers;
class ContactController extends BaseController {
    public function index() {
        // Si el formulario ha sido enviado
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->sendEmail();
        }

        // Asignar el título de la página
        $page_title = "Contacto";
        $this->smarty->assign('title', $page_title);

        // Renderizar la plantilla de contacto
        $this->render('pages/contact.tpl', $page_title);
    }

    private function sendEmail() {
        // Obtener datos del formulario
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);

        // Verificar si los datos son válidos
        if ($name && $email && $message) {
            // Configurar los encabezados del email
            $headers = "From: $name <$email>\r\n";
            $headers .= "Reply-To: $email\r\n";
            $headers .= "Content-type: text/plain; charset=UTF-8\r\n";

            // Enviar el email
            $to = 'admin@yourdomain.com'; // Cambia esto a tu email de administrador
            $subject = 'Nuevo mensaje de contacto desde el Starter';
            $body = "Nombre: $name\nEmail: $email\nMensaje:\n$message";

            if (mail($to, $subject, $body, $headers)) {
                $this->smarty->assign('success', 'Tu mensaje ha sido enviado con éxito.');
            } else {
                $this->smarty->assign('error', 'Hubo un problema al enviar tu mensaje. Por favor, inténtalo nuevamente.');
            }
        } else {
            $this->smarty->assign('error', 'Por favor, completa todos los campos correctamente.');
        }
    }
}
