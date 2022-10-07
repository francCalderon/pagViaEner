<?php

// Definicion de variablres para crear el contenido del correo
$nombreCabecera = $_GET["name"];
$nombre = $_GET["name"]; 
$mail = $_GET["mail"];
$telefono = $_GET["phone"];
$comentario = $_GET["message"];

// Creacion del cuerpo del correo
$cuerpo = "Nombre: " . $nombre . "<br>Correo: " . $mail .  "<br>Teléfono: " . $telefono . "<br>Mensaje: " . $comentario;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'php/PHPMailer/Exception.php';
require 'php/PHPMailer/PHPMailer.php';
require 'php/PHPMailer/SMTP.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                                               //Enable verbose debug output
    $mail->isSMTP();                                                    //Send using SMTP
    $mail->Host       = 'mail.viaener.cl';                              //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                           //Enable SMTP authentication
    $mail->Username   = 'ventas@viaener.cl';                            //SMTP username
    $mail->Password   = '(3t5vSdYK.#[';                                 //SMTP password
    $mail->SMTPSecure = 'ssl';                                          //Enable implicit TLS encryption
    $mail->Port       = 465;                                            //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('ventas@viaener.cl', $nombreCabecera);               //que se envie desde el correo del hosting           
    $mail->addAddress('fco.sl93@gmail.com');                            //al correo de destino
    // $mail->addAddress('ellen@example.com');                          //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('ccarreno@viaener.cl', $nombreCabecera);
    $mail->addCC('gerencia@viaener.cl', $nombreCabecera);
    // $mail->addCC('fco.sl93@gmail.com', $nombreCabecera);
    // $mail->addBCC('bcc@example.com');

    //Content
    $mail->isHTML(true);                                                //Set email format to HTML
    $mail->Subject = 'Solicitud de informacion a traves de la pagina web';
    $mail->Body    = $cuerpo;
    $mail->Charset = 'UTF-8';

    $mail->send();
    echo '<script>
        alert("El mensaje se envió correctamente");
        window.history.go(-1);
        </script>';
} catch (Exception $e) {
    echo "Hubo un error al enviar el mensaje: {$mail->ErrorInfo}";
}

?>


