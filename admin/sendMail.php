<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
include '../config/db.php';

session_start();

$derguesiID = $_SESSION['id'];
$sqlEmail="SELECT email FROM admin WHERE id=$derguesiID";
$emailquery=mysqli_query($connection,$sqlEmail);
$email=mysqli_fetch_assoc($emailquery);
$derguesi=$email['email'];
$marresi = $_POST['marresi'];
$subject = $_POST['subject'];
$body = $_POST['body'];

$sql = "INSERT INTO mail
(derguesi, marresi, subject, body, status)
VALUES
('$derguesi','$marresi','$subject','$body','sent')";

mysqli_query($connection,$sql);

$mail = new PHPMailer(true);

try {

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;

    $mail->Username = 'eems.system@gmail.com';
    $mail->Password = 'fgzcxmnzedhrtmyl';

    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    $mail->setFrom('eems.system@gmail.com', 'School System');

    $mail->addAddress($marresi);

    $mail->Subject = $subject;
    $mail->Body = $body;

    $mail->send();

    header("Location: email.php");

} catch (Exception $e) {

    echo "Error: " . $mail->ErrorInfo;
}

?>