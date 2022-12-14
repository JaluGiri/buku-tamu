<?php
require "vendor/autoload.php";
require 'connection.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

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

$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->SMTPAuth = true;

$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->port = 587;

$mail->Username = "lisun4160@gmail.com";
$mail->Password = "qyiuhgmxbgjfphom";

$mail->setFrom('noreaply@kemenag.co.id', 'Buku Kemenag');

$mail->addAddress($emailkepada, $nama);

$mail->Subject = $keperluan;
$mail->Body = " 
Nama    = $nama
Alamat  = $alamat
Nomor Telpon    = $notelp
Pesan   = $pesan
Kepada  = $kepada[0]
Tanggal & Waktu = $tanggal
               ";
// $mail->Body = $message;

$mail->send();

// echo "email sent"; 
header ("location: complete.php");
// exit();