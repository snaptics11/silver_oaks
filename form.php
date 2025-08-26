<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $phone  = $_POST['text'];
    $date   = $_POST['date'];

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'saikoushik166@gmail.com';
        $mail->Password   = 'zpky hljk sulm ntux'; // App password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Recipients
        $mail->setFrom('saikoushik166@gmail.com', 'Website Brochure');
        $mail->addAddress('your-receiving-email@gmail.com'); // Replace with actual recipient

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Brochure Request';
        $mail->Body    = "
            <h3>New Inquiry</h3>
            <p><strong>Name:</strong> $name</p>
            <p><strong>Email:</strong> $email</p>
            <p><strong>Phone:</strong> $phone</p>
            <p><strong>Date:</strong> $date</p>
        ";

        $mail->send();

        // ✅ Redirect after success
        header("Location: ./thankyouBrochure.html");
        exit();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
