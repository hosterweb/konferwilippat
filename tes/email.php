 <?php
require_once('../PHPMailer/PHPMailerAutoload.php');
//require_once('PHPMailer/PHPMailerAutoload.php');

// Instantiation and passing `true` enables exceptions
$mail             = new PHPMailer();


try {
    //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'info@konferwil-jatim-ippat.com';           // SMTP username
    $mail->Password   = 'LoginMasuk*123';                          // SMTP password
    $mail->SMTPSecure = 'TLS';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = '587';                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('info@konferwil-jatim-ippat.com', 'Tes');
    $mail->addAddress('masbekid@gmail.com', 'Tes Penerima');     // Add a recipient


    // Attachments
    //$mail->addAttachment('phpmailer-min.png', 'image.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                        // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>