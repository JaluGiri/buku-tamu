<?php 
    require 'connection.php';

    if (!isset($_SESSION['loggedin'])) {
        header('Location: adminlogin.php');
        exit;
    }
    // $query = "SELECT * FROM tamu WHERE nama LIKE '%".$cari."%' OR alamat LIKE '%".$cari."%' OR notelp LIKE '%".$cari."%' OR kepada LIKE '%".$cari."%' OR tanggal LIKE '%".$cari."%'";
    // $tamu = mysqli_query($conn, $query);
    // if $post filternya kosong
    if (isset($_POST['filter'])) {
        $filter = $_POST['filter'];
        $query = "SELECT * FROM tamu WHERE nama LIKE '%".$filter."%' OR alamat LIKE '%".$filter."%' OR notelp LIKE '%".$filter."%' OR kepada LIKE '%".$filter."%' OR tanggal LIKE '%".$filter."%'";
        $tamu = mysqli_query($conn, $query);
    } else {
        $query = "SELECT * FROM tamu";
        $tamu = mysqli_query($conn, $query);
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stileee.css">
    <link rel="icon" type="image/png" sizes="32x32" href="logo.png">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> -->
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.all.min.js"></script>

    <style>
        @media print {
            .filter {
                display: none;
            }
        }
    </style>

    <title>Print Data Tamu KEMENAG</title> 
</head>
<body>
   

    <section class="bagian">
        <div class="top">

            <div class="">
                <h2 align="center" style="color:#006635;" >Data Kunjungan Tamu KEMENAG R.I</h2>
            </div><br><br>
            <!-- <div class="title">
                <a class=text href="adminpage.php">
                <iconify-icon icon="bytesize:arrow-left" width="40" height="40"></iconify-icon>
                </a>
                </div> -->
        </div>
        <div class="dash-content">
            <div class="overview">
                <!-- <div class="title">
                <a class=text>
                <iconify-icon icon="bxs:user-detail" width="40" height="40"></iconify-icon>
                </a>
                    <span class="text">Bagian1</span>
                </div> -->
                <?php if (isset($_SESSION['flash'])) : ?>
                    <div class="flash-data" data-flashdata="<?= $_SESSION['flash']['message'] ?>"></div>
                <?php endif; unset($_SESSION['flash']); ?>
                <form action="" class="col-md-4 justify-content-center filter" method="post">
                    <input type="text" name="filter" placeholder="Filter Data" class="form-control">
                    <button type="submit" name="submit" class="btn btn-success my-2 mb-3">Filter</button>
                    <button type="button" onclick="window.print()" class="btn btn-success my-2 mb-3">Print</button>
                </form>
        <div class="hiha">
        <table class="table table-hover  table-bordered">
        <thead>
        <tr>
            <th scope="col" class="text-muted">No</th>
            <!-- <th scope="col">id</th> -->
            <th scope="col" class="text-muted">Nama</th>
            <th scope="col" class="text-muted">Alamat</th>
            <th scope="col" class="text-muted">No Telp</th>
            <th scope="col" class="text-muted">Pesan</th>
            <th scope="col" class="text-muted">Kepada</th>
            <th scope="col" class="text-muted">tanggal & waktu</th>
            <th scope="col" class="text-muted">Keperluan</th>
            <!-- <th scope="col" class="text-muted">Action</th> -->
            </tr>
        </thead>
        <tbody id="tampil">
            <?php $no = 1 ?>
            <?php while ($row = mysqli_fetch_assoc($tamu)) { ?>
                <tr>
                    <th class="text-muted" scope="row"><?= $no++; ?></th>
                    <!-- <td><?= $row['id']?></td> -->
                    <td class="text-muted"><?= $row['nama']?></td>
                    <td class="text-muted"><?= $row['alamat']?></td>
                    <td class="text-muted"><?= $row['notelp']?></td>
                    <td class="text-muted"><?= $row['pesan']?></td>
                    <td class="text-muted"><?= $row['kepada']?></td>
                    <td class="text-muted"><?= $row['tanggal']?></td>
                    <td class="text-muted"><?= $row['keperluan']?></td>
                    <!-- <td>
                      <div align="center">
                        <a href="editbag1.php?id=<?= $row['id']?>">Ubah</a><br>
                        <a onclick="SwalDelete(this)" data-id="<?= $row['id']?>" href="#">Hapus</a>
                        </div>
                    </td> -->
                </tr>
            </div>
            <?php } ?>
        </tbody>
        </table>
    </div>
    <!-- <script>
        window.print();
    </script> -->
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script type="text/javascript">
    // data table script

    $(document).ready(function () {
    $('#hehe').DataTable({
        dom: '<"toolbar">frtip',
    });
 
    $('div.toolbar').html();
});
    </script>
    <!-- <script>
        // show session flash sweatalert
        const flashData = $('.flash-data').data('flashdata');
        if (flashData) {
            Swal.fire({
                title: 'Selamat',
                text: flashData,
                icon: 'success',
                showConfirmButton: false,
                timer: 5000
            });
        }
    </script> -->
     <!-- <script>
    //delete sweetalert
    $(document).ready(function(){
        $(document).on('click', '#delete_tamu', function(e){
            console.log("hello");
            e.prevenDefault();
            var tamuId = $(this).data('id');
            // SwalDelete(userId);
            
        });
    });

    function SwalDelete(element){
        tamuId = element.dataset.id;
        // console.log(tamuId);
        // console.log();
        Swal.fire({
            title: 'Apakah anda yakin?',
            text: "Data akan dihapus secara permanen",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.value) {
                window.location.href = "deletebag1.php?id=" + tamuId;
            }
        })

    }
    </script> -->
    <script>
        $(document).ready(function() {
          $("#cari").keyup(function() {
            $.ajax({
              method: 'POST',
              url: 'searchta.php',
              data: {
                  cari: $(this).val()
              },
              cache: false,
              success: function(data) {
                $("#tampil").html(data);
              }
            });
          });
        });

        // START CLOCK SCRIPT

// Number.prototype.pad = function(n) {
//   for (var r = this.toString(); r.length < n; r = 0 + r);
//   return r;
// };

// function updateClock() {
//   var now = new Date();
// //   var milli = now.getMilliseconds(),
//     sec = now.getSeconds(),
//     min = now.getMinutes(),
//     hou = now.getHours(),
//     mo = now.getMonth(),
//     dy = now.getDate(),
//     yr = now.getFullYear();
//   var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
//   var tags = ["mon", "d", "y", "h", "m", "s"],
//     corr = [months[mo], dy, yr, hou.pad(2), min.pad(2), sec.pad(2),];
//   for (var i = 0; i < tags.length; i++)
//     document.getElementById(tags[i]).firstChild.nodeValue = corr[i];
// }

// function initClock() {
//   updateClock();
//   window.setInterval("updateClock()", 1);
// }

// END CLOCK SCRIPT
    </script>
</body>
<div class="seha">
    <footer class="main-footer">
                <div class="footer-left" style="color:#9D9D9D;">
                    Copyright © 2022 Develop By RPL SMKN 1 CIAMIS
                <!-- </div> -->
                <!-- <div class="footer-right"> -->
                    1.0.0
                </div>
            </footer>
    </div>
</html>
