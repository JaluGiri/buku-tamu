<?php 
    require 'connection.php';
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: logreg.php');
        exit;
    }
    $email = $_SESSION['email'];
    $query  = "SELECT * FROM pengguna WHERE email = '$email'";
    $pengguna = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($pengguna);

    if (isset($_POST['kirim'])) {
    $nama= $_POST['nama'];
    $alamat = $_POST['alamat'];
    $notelp = $_POST['notelp'];
    $pesan = $_POST['pesan'];
    $kepada = $_POST['kepada'];
    $tanggal = $_POST['tanggal'];
    $keperluan = $_POST['keperluan'];
    
    // var_dump([$nama, $alamat, $notelp, $pesan, $kepada, $tanggal, $keperluan]);
    // Die();

    $query = "INSERT INTO tamu(nama, alamat, notelp, pesan, kepada, tanggal, keperluan) VALUES ('$nama', '$alamat', '$notelp', '$pesan', '$kepada', '$tanggal', '$keperluan')";
    // var_dump($query);
    // Die();
    mysqli_query($conn, $query);
    // // var_dump();
    // // Die();
    $_SESSION['message'] = 'Data has been Created';
    }

    //emmail tujuan start

    $query = "SELECT * FROM tujuan";
    $tujuan = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="formulir.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <link rel="icon" type="image/x-icon" href="logo.png">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
</head>
<body>

    <div class="background"></div>
    
    <div class="leftside">
        <div class="margin">
            <h1 class="titless">KEMENAG R.I</h1>
            <img src="logo.png" class="logo" alt="">
        </div>
    </div>

    <div class="rightside">
        <form action="send-mail.php" method="post">
        <?php if($_SESSION['message'] ?? false): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['message'] ?? '' ; sleep(1); unset($_SESSION['message'])?>
                </div>
        <?php endif; ?> 

            <div class="title">
                <h1 class="titles">Isi format Buku Tamu dibawah ini!</h1>
            </div><br>
            <div class="forms">
                <div class="input-group mb-2 from">
                    <input type="text" name="nama" id="" class="form-control form" placeholder="Nama">
                    <input type="alamat" name="alamat" id="" class="form-control form" placeholder="Alamat">
                </div>
            <div class="input-group mb-2 from">
                <input type="number" name="notelp" id="" class="form-control form" placeholder="Nomor Telepon">
                <input type="datetime-local" name="tanggal" id="" class="form-control form" >
            </div>
            <div class="input-group mb-2 from">
                <select name="kepada" id="" class="form-select js-example-basic-single form" aria-label="Default select example">
                <?php
                    foreach($tujuan as $tuj) { ?>
                        <option value="<?= $tuj['bagiann'] ?>-<?= $tuj['namaa'] ?>&<?= $tuj['emailtujuan'] ?>"><?= $tuj['bagiann']?> - <?= $tuj['namaa'] ?></option>
                <?php
                } ?>
                </select>
                <input type="text" name="pesan" id="" class="form-control form" placeholder="Pesan">
            </div>
            <div class="input-group mb-3 from">
                <input type="text" name="keperluan" id="" class="form-control form" placeholder="Keperluan">
            </div>
            <div class="button">
                <button type="submit" nama="kirim" class="btn btn-light buttons">KIRIM</button>
                <a href="logout.php" class="btn btn-danger">Keluar</a>
            </div>

        </form>
    </div>
    <script language="JavaScript">
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
    });
            $('select').select2({
    placeholder: 'Pilih Salah Satu',
    allowClear: true
    });
</script>
</body>
</html>