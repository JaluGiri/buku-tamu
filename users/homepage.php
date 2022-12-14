<?php 
    require 'connection.php';
    // If the user is not logged in redirect to the login page...
    if (!isset($_SESSION['loggedin'])) {
        header('Location: formlogin.php');
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
    <title>Buku Tamu - Form</title>
    <link rel="stylesheet" type="text/css" href="csslg/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="csslg/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="csslg/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="csslg/iofrm-theme15.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
</head>
<body>
    <div class="form-body" class="container-fluid">
        <div class="website-logo">
            <a href="index.html">
                <div class="logo">
                    <!-- <img class="logo-size" src="images/logo-light.png" alt=""> -->
                </div>
            </a>
        </div>
        <div class="row">
            <div class="img-holder">
                <div class="bg"></div>
                <div class="info-holder">
                    <br><br><br><br><br><br><br><br><br>
                    <h3>Buku Tamu Lorem ipsum dolor sit amet</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br><br>
                        Eveniet alias voluptatum saepe aliquid consectetur quisquam, ratione dicta, aperiam, nulla facilis magni sapiente libero asperiores dolorem nesciunt omnis in nobis est!</p><br><br><br><br><br>
                        <p class="copy">Copyright © 2022 <em>Develop By</em> <a class="brand" href="" target="_blank"><b>RPL SMKN 1 CIAMIS</b></a></p>
                </div>
            </div>
            <div class="form-holder">
                <div class="form-content form-sm">
                    <div class="form-items">
                        <h3 class="form-title">Isi Format Buku Tamu Dibawah Ini!!</h3>
                        <form action="send-mail.php" method="post">
                            <?php if($_SESSION['message'] ?? false): ?>
                                <div class="alert alert-success">
                                    <?= $_SESSION['message'] ?? '' ; sleep(1); unset($_SESSION['message'])?>
                                </div>
                            <?php endif; ?>     
                            <div class="form-row">
                                <div class="col">
                                <input type="text" class="form-control" name="nama" placeholder="Nama" required>
                                </div>
                                <div class="col">
                                <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
                                </div>
                            </div>
                            <div class="form-group">
                                
                                <!-- <label>Education</label> -->
                                <!-- <div class="custom-options">
                                    <input type="radio" id="rad1" name="rad"><label for="rad1">Master Degree</label>
                                    <input type="radio" id="rad2" name="rad"><label for="rad2">Bachelor Degree</label>
                                    <input type="radio" id="rad3" name="rad"><label for="rad3">Diploma</label>
                                    <input type="radio" id="rad4" name="rad"><label for="rad4">Other</label>
                                </div> -->
                                <div class="form-row">
                                    <div class="col">
                                        <input type="number" class="form-control" name="notelp" placeholder="Nomor Telpon" autocomplete="off" required>
                                    </div>
                                    <div class="col">
                                        <input type="datetime-local" class="form-control" name="tanggal" placeholder="">
                                    </div>
                                </div>
                                <div>
                                    <select class="form-control js-example-basic-single" name="kepada" aria-label="Default select example" autocomplete="off">
                                    <!-- <option selected>Pilih Salah Satu</option> -->

                                    <?php
                                        foreach($tujuan as $tuj) { ?>
                                        <option value="<?= $tuj['bagiann'] ?>-<?= $tuj['namaa'] ?>&<?= $tuj['emailtujuan'] ?>"><?= $tuj['bagiann']?> - <?= $tuj['namaa'] ?></option>
                                    <?php
                                        } ?>
                                        
                                        <!-- <option selected>Pilih Salah Satu</option>
                                        <option value="Bagian1-Bapak Siapa&lisun4160@gmail.com">Bagian1-Bapak Siapa</option>
                                        <option value="Bagian1-Ibu Siapa&abangjalugiri@gmail.com">Bagian1-Ibu Siapa</option>
                                        <option value="Bagian1-Pada Siapa&padasiapa1@gmail.com">Bagian1-Pada Siapa</option>
                                        <option value="Bagian2-Bapak Siapa&bapaksiapa2@gmail.com">Bagian2-Bapak Siapa</option>
                                        <option value="Bagian2-Ibu Siapa&ibusiapa2@gmail.com">Bagian2-Ibu Siapa</option>
                                        <option value="Bagian2-Pada Siapa&padasiapa2@gmail.com">Bagian2-Pada Siapa</option>
                                        <option value="Bagian3-Bapak Siapa&bapaksiapa3@gmail.com">Bagian3-Bapak Siapa</option>
                                        <option value="Bagian3-Ibu Siapa&ibusiapa3@gmail.com">Bagian3-Ibu Siapa</option>
                                        <option value="Bagian3-Pada Siapa&padasiapa3@gmail.com">Bagian3-Pada Siapa</option> -->
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <!-- <label>Tell us about you in short</label> -->
                                <input type="text" class="form-control" name="pesan" placeholder="Pesan" >
                                <input type="text" class="form-control" name="keperluan" placeholder="Keperluan" >
                            </div>
                            <div class="form-button text-right">
                                    <!-- <button class="btn btn-outline-danger">Logout</button> -->
                                    <a href="logout.php" class="btn btn-outline-danger">Logout</a>
                                    <button name="kirim" type="submit" class="ibtn" onclick="swalSave(this)">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="jslg/jquery.min.js"></script>
<script type="text/javascript" src="jslg/popper.min.js"></script>
<script type="text/javascript" src="jslg/bootstrap.min.js"></script>
<script type="text/javascript" src="jslg/main.js"></script>
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
        $('select').select2({
  placeholder: 'Pilih Salah Satu',
  allowClear: true
});
</script>

<!-- <script>
 $(document).ready(function(){
        $(document).on('click', '#save', function(e){
            console.log("hello");
            e.prevenDefault();
        });
    });
        function SwalSave(element){
        // userId = element.dataset.id;
        // console.log(userId);
        // console.log();
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data akan dihapus secara permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        })
        // .then((result) => {
        //     if (result.value) {
        //         window.location.href = "deleteusers.php?id=" + userId;
        //     }
        // })

    }
</script> -->
</body>
</html>