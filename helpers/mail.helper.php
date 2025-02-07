<?php


class HelperMailer
{

    /*=============================================
	SEND MAIL TO NEW USER TO VALIDATE
	=============================================*/

    static public function firtMailer($user)
    {

        var_dump($user);

        $mail = new PHPMailer(true);

        $env = parse_ini_file(__DIR__ . '/../.env');
        $email_host = $env['EMAIL_HOST'];
        $email_user = $env['EMAIL_USER'];
        $email_pass = $env['EMAIL_PASS'];
        $email_port = $env['EMAIL_PORT'];

        try {
            // Configuración del servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'mail.ougt.cl';  // Servidor SMTP de Gmail
            $mail->SMTPAuth = true;
            $mail->Username = $email_user;  // Tu correo
            $mail->Password = $email_pass;      // Contraseña o App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $email_port;

            // Configuración del remitente y destinatario
            $mail->setFrom('send@ougt.cl', 'Sender de comunidad');
            $mail->addAddress($user['email'], $user['username']);

            // Asunto del correo
            $mail->Subject = 'Este es un correo en HTML';

            // Habilitar HTML en el cuerpo del correo
            $mail->isHTML(true);
            $mail->Body = '
                <html>
                <head>
                    <title>Correo en HTML</title>
                </head>
                <body>
                    <h1 style="color:blue;">¡Hola, este es un correo en HTML!</h1>
                    <p style="font-size:16px;">Puedes agregar imágenes, enlaces y estilos como en una página web.</p>
                    <a href="https://www.tu-sitio.com" style="background-color:green;color:white;padding:10px 20px;text-decoration:none;">Visitar sitio</a>
                </body>
                </html>
            ';

            // Enviar el correo
            $mail->send();
            echo 'Correo enviado correctamente en HTML';
        } catch (Exception $e) {

            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    }
}
