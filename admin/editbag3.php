<?php
    require 'connection.php';
    // get data from database in id
    $id = $_GET['id'];
    $tamu = mysqli_query($conn, "SELECT * FROM tamu WHERE id=$id");
    $row = mysqli_fetch_assoc($tamu);

    if (isset($_POST['submit'])) {
        $nama= $_POST['nama'];
        $alamat = $_POST['alamat'];
        $notelp = $_POST['notelp'];
        $pesan = $_POST['pesan'];
        $kepada = $_POST['kepada'];
        $tanggal = $_POST['tanggal'];
        $keperluan = $_POST['keperluan'];
        

        $tamu = mysqli_query($conn, "UPDATE tamu SET nama='$nama', alamat='$alamat', notelp='$notelp', pesan='$pesan', kepada='$kepada', tanggal='$tanggal', keperluan='$keperluan'  WHERE id=$id");
        if ($tamu) {
            $_SESSION['flash'] =[
                'type' => 'success',
                'message' => 'Data Tamu Bagian 3 Berhasil Diperbarui '
            ];
            header('location: bagian3.php');
        }
    }

    // email tujuan start
    $query = "SELECT * FROM tujuan";
    $tujuan = mysqli_query($conn, $query);
    // email tujuan end
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Bagian 3</title>
    <link rel="icon" type="image/png" sizes="32x32" href="logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script>
    $(document).ready(function() {
        $(".js-example-basic-single").select2({
            maximumSelectionLength: 1
        });
        $('select').select2({
  placeholder: 'Pilih Salah Satu',
  allowClear: true
});
    });
</script>
</head>
<body>

        <div class="title">
            <a class=text href="bagian1.php">
                <iconify-icon icon="bytesize:arrow-left" width="40" height="40"></iconify-icon>
            </a>
        </div>
    <div class="container py-5">
        <h2>Edit Data <?= $row['nama'] ?></h2>
        <form class="col col-sm-5 col-lg-6 col-md-7" action="" method="POST">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="nama" placeholder="Full Name" value="<?= $row['nama']?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <input type="text" name="alamat" placeholder="Email Address" value="<?= $row['alamat']?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">No.Telp</label>
                <input type="number" name="notelp" placeholder="Nomor Telpon" value="<?= $row['notelp']?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Pesan</label>
                <input type="text" name="pesan" placeholder="Isi Pesan Disini" value="<?= $row['pesan']?>" class="form-control">
                
                <div class="mb-1">
                <label class="form-label pt-2">Kepada</label>    
                <select class="form-select js-example-basic-single" name="kepada" aria-label="Default select example" autocomplete="off">
                    <?php
                        foreach($tujuan as $tuj) { ?>
                        <option value="<?= $tuj['bagiann'] ?>-<?= $tuj['namaa'] ?>&<?= $tuj['emailtujuan'] ?>"<?php echo'selected'?>><?= $tuj['bagiann']?> - <?= $tuj['namaa'] ?></option>
                    <?php
                        } ?>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal dan Waktu</label>
                <input type="datetime-local" name="tanggal" value="<?= $row['tanggal']?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Keperluan</label>
                <input class="form-control" type="text" name="keperluan" value="<?= $row['keperluan']?>" placeholder="Apa Keperluan Mu?">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>