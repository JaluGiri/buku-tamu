<?php
require 'connection.php';


$nama = $_POST["nama"];
$alamat = $_POST["alamat"];
$notelp = $_POST["notelp"]; 
$pesan = $_POST["pesan"];
$kepada = explode("&", $_POST["kepada"]);
$tanggal = $_POST["tanggal"];
$keperluan = $_POST["keperluan"];
$emailkepada = $kepada[1];
$kepadanama = $kepada[0];

$conn->query("INSERT INTO `tamu` (`nama`, `alamat`, `notelp`, `pesan`, `kepada`, `tanggal`, `keperluan`) VALUES ('$nama', '$alamat', '$notelp', '$pesan', '$kepadanama', '$tanggal', '$keperluan')");

require "vendor/autoload.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; 
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->Username = 'lisun4160@gmail.com';
    $mail->Password = 'qyiuhgmxbgjfphom'; 

    // Sender and recipient settings
    $mail->setFrom('contact@kemenag.com', 'noreplay KEMENAG');
    $mail->addAddress($emailkepada, $nama);
    $mail->addReplyTo('lisun4160@gmail.com', 'noreplay KEMENAG'); // to set the reply to

    // Setting the email content
    $mail->IsHTML(true);
    $mail->Subject = "Send email using Gmail SMTP and PHPMailer";
    // $mail->Body = 'HTML message body. <b>Gmail</b> SMTP email body.';
    // $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';
    $mail->Subject = $keperluan;
    $mail->Body = " 
    Nama    = $nama
    Alamat  = $alamat
    Nomor Telpon    = $notelp
    Pesan   = $pesan
    Kepada  = $kepada[0]
    Tanggal & Waktu = $tanggal
                   ";

    $mail->send();
    echo "Email message sent.";
    header ("location: complete.php");
} catch (Exception $e) {
    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
}
?>