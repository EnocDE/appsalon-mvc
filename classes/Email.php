<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;


class Email
{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarConfirmacion()
    {
        // Crear el objeto de Email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('barbershop@barber.com', 'Barber Shop');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirmación de cuenta';

        // set Html
        $mail->isHTML();
        $mail->CharSet = "UTF-8";

        // Crear contenido html del mensaje
        $contenido = "<html>";
        $contenido .= "<p>Hola <b>" . $this->nombre .  "</b> has creado tu cuenta en BarberShop, solo debes confirmarla ingresando en el siguiente enlace: ";
        $contenido .= "<a href= '" . $_ENV['PROJECT_URL'] . "/account-confirmation?token=" . $this->token . "'> Ingresa desde aqui </a></p>";
        $contenido .= "<p><i>Si tu no te registraste en nuestra pagina puedes ignorar este mensaje.</i></p>";
        $contenido .= "</html>";

        // Asignar el contenido al email
        $mail->Body = $contenido;

        // Enviar email
        $mail->send();
    }

    public function enviarInstrucciones()
    {
        // Crear el objeto de Email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom('barbershop@barber.com', 'Barber Shop');
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Restablecer contraseña';

        // set Html
        $mail->isHTML();
        $mail->CharSet = "UTF-8";

        // Crear contenido html del mensaje
        $contenido = "<html>";
        $contenido .= "<p>Hola <b>" . $this->nombre .  "</b> para restaurar tu contraseña solo debes confirmarla ingresando en el siguiente enlace: ";
        $contenido .= "<a href= '" . $_ENV['PROJECT_URL'] . "/recover?token=" . $this->token . "'> Ingresa desde aqui </a></p>";
        $contenido .= "<p><i>Si tu solicitaste este correo en nuestra pagina puedes ignorar este mensaje.</i></p>";
        $contenido .= "</html>";

        // Asignar el contenido al email
        $mail->Body = $contenido;

        // Enviar email
        $mail->send();
    }
}
