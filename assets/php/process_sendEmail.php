<?php
include("connection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';

$mail = new PHPMailer(true);

$email = $_POST["email"];
$token = bin2hex(random_bytes(32));

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
    $mail->Username = 'froschohy@gmail.com';                     //SMTP username
    $mail->Password = 'iukatyyvqnvicmgz';                                  //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('collabhubrenew@gmail.com', 'Mailer');
    $mail->addAddress($email, 'Fahmi Hafiz');     //Add a recipient

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Reset Password';
    $mail->Body = 'Dear user, here is the token for your reset password <br><b>' . $token . '</b>';

    $mail->send();


    // Prepare the SQL update statement
    $sql = "UPDATE user SET token = ? WHERE email =?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("ss", $token, $email);
    $stmt->execute();

    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
$connection->close();
?>