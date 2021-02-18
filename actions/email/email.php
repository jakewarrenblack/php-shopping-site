<?php
require_once '../../config.php';
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'vendor/autoload.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {

    $request->session()->forget("flash_data");
    $request->session()->forget("flash_errors");

    //Server settings
    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.mailtrap.io';                     // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = $_ENV['MAILTRAP_USERNAME'];                       // SMTP username
    $mail->Password   = $_ENV['MAILTRAP_PASSWORD'];                       // SMTP password

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 2525;                                   // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
    $mail->setFrom('from@example.com', 'Mailer');
    $mail->addAddress('joe@example.net', 'Joe User');           // Add a recipient
    $mail->addAddress('ellen@example.com');                     // Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    // Attachments
    if (FileUpload::exists('attachment')) {
        //If a file was uploded for attachment,
        //create a FileUpload object
        $file = new FileUpload("attachment");
        $mail->addAttachment($file->get());
    }
    // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');       // Optional name

    // Content
    $mail->isHTML(true);                                        // Set email format to HTML
    $mail->setFrom($request->input("email"), $request->input("name"));
    $mail->Subject = $request->input("subject");
    $mail->Body = $request->input("message");
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    require "include/flash.php";

    if ($mail->send()) {
        try{
            $request->session()->set("flash_message", "Your message has been sent!");
            $request->session()->set("flash_message_class", "alert-info");
            $request->session()->forget("flash_data");
            $request->session()->forget("flash_errors");
            /* 
                Error on this redirect caused by F:\XAMPP\htdocs\awdd\login-start\actions\email\vendor\phpmailer\phpmailer\src\SMTP.php on line 278 IF smtp debug output is turned on.
                You should never print/echo anything before sending headers, but smtp.php is trying to echo the debug output.
                
                So we get this error:
                'Warning: Cannot modify header information - headers already sent by (output started at F:\XAMPP\htdocs\awdd\login-start\actions\email\vendor\phpmailer\phpmailer\src\SMTP.php:281) 
                in F:\XAMPP\htdocs\awdd\login-start\classes\BookWorms\Http\HttpRequest.php on line 117'
            */
            $request->redirect("/views/contact.php");
        }
        catch(Exception $ex){
            $request->session()->set("flash_message", "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
            $request->session()->set("flash_message_class", "alert-warning");
            $request->session()->set("flash_data", $request->all());
            $request->session()->set("flash_errors", $request->errors());
            $request->redirect("/views/contact.php");
        }
        $mail->smtpClose();
    }

    // echo 'Message has been sent';
} catch (Exception $e) {
    $request->session()->set("flash_message", "Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
    $request->session()->set("flash_message_class", "alert-warning");

    $request->session()->set("flash_data", $request->all());
    $request->session()->set("flash_errors", $request->errors());

    $request->redirect("/views/contact.php");
}
