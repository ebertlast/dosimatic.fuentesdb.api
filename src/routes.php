<?php

use Slim\Http\Request;
use Slim\Http\Response;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Routes

$app->get('/[{name}]', function (Request $request, Response $response, array $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    if(false){
        $conf = $this->get('settings');
        $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
        // var_dump($conf['mailer']['MailerMail']);
        try {
            //Server settings
            $mail->SMTPDebug = 0;                                 // Enable verbose debug output
            $mail->isSMTP();                                      // Set mailer to use SMTP
            $mail->Host = $conf['mailer']['Host'];  // Specify main and backup SMTP servers
            $mail->SMTPAuth = $conf['mailer']['SMTPAuth'];                               // Enable SMTP authentication
            $mail->Username = $conf['mailer']['Username'];                 // SMTP username
            $mail->Password = $conf['mailer']['Password'];                           // SMTP password
            $mail->SMTPSecure = $conf['mailer']['SMTPSecure'];                            // Enable TLS encryption, `ssl` also accepted
            $mail->Port = $conf['mailer']['Port'];                                    // TCP port to connect to
        
            //Recipients
            $mail->setFrom($conf['mailer']['MailerMail'], $conf['mailer']['MailerName']);
            $mail->addAddress('ebertunerg@gmail.com', 'Ebert Zerpa');     // Add a recipient
            // $mail->addAddress('ellen@example.com');               // Name is optional
            $mail->addReplyTo($conf['mailer']['ReplyToMail'], $conf['mailer']['ReplyToName']);
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
        
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
        
            //Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->charSet = "UTF-8"; 
            $mail->send();
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo 'Message could not be sent.';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
    }
    
    
    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});
