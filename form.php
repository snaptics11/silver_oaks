<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $phone = strip_tags(trim($_POST["text"]));
    $date = strip_tags(trim($_POST["date"]));

    $mail = new PHPMailer(true);

    try {
        // SMTP settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'koushiksai8055@gmail.com';        
        $mail->Password = 'kpqk rvpz zpkc ygtw';     
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Email setup
        $mail->setFrom('your@email.com', 'Silver Oaks Website');
        $mail->addAddress('seo@snaptics.in');
        $mail->addAddress('saikumar.dmm@snaptics.in'); 

        // Email content
        $mail->isHTML(false);
        $mail->Subject = "New Brochure Download Request from $name";
        $mail->Body = "Name: $name\nEmail: $email\nPhone: $phone\nPreferred Visit Date: $date";

        $mail->send();

        // ✅ Redirect to thank you page
        header("Location: thankyouBrochure.html");
        exit();
    } catch (Exception $e) {
        echo "Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request method.";
}
