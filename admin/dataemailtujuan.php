<?php 
    require 'connection.php';

    if (!isset($_SESSION['loggedin'])) {
        header('Location: adminlogin.php');
        exit;
    }
    $tujuan = mysqli_query($conn, "SELECT * FROM tujuan");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylee.css">
    <link rel="icon" type="image/png" sizes="32x32" href="logo.png">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="https://kit.fontawesome.com/85cafb174a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.0/css/fontawesome.min.css" integrity="sha384-z4tVnCr80ZcL0iufVdGQSUzNvJsKjEtqYZjiQrrYKlpGow+btDHDfQWkFjoaz/Zr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.all.min.js"></script>

    <title>Admin Panel - Data email</title> 
</head>
<body>
    <nav>
        <div class="logo-name">
            <div class="logo-image">
                <img src="logo.png" alt="">
            </div>

            <span class="logo_name">Admin</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">
                <li><a href="adminpage.php">
                <i class="uil uil-estate"></i>
                    <span class="link-name adminn">Dashboard</span>
                </a></li>
                <li><a href="datatamu.php">
                <i class="uil uil-users-alt"></i>
                    <span class="link-name">Daftar tamu</span>
                </a></li>
                <li><a href="datausers.php">
                <i class="uil uil-user"></i>
                    <span class="link-name">Daftar users</span>
                </a></li>
                <li><a href="dataemailtujuan.php">
                <i class="uil uil-envelope-alt" style="color: #006635;"></i>
                    <span class="link-name" style="color:#006635;">Daftar email</span>
                </a></li>
                <li><a href="create.php">
                <i class="uil uil-plus-square"></i>
                    <span class="link-name">Create</span>
                </a></li>
                <li></li>
                <li></li>
            </ul>
            
            <ul class="logout-mode">
                <li><a href="logout.php">
                <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

                <li class="mode">
                    <a href="#">
                    <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                  <span class="switch"></span>
                </div>
            </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <i class="uil uil-bars sidebar-toggle"></i>

            <!-- <div class="search-box">
                <i class="uil uil-search"></i>
                <input type="text" placeholder="Search here..." id="search" autofocus autocomplete="off">
            </div> -->
            <div>
                <h2 style="color:#006635;">Admin Dashboard</h2>
            </div>
            <body onLoad="initClock()">
                <div id="timedate" style="color:#006635;">
                <strong>
                <a id="mon">January</a>
                <a id="d">1</a>,
                <a id="y">0</a><br />
                <a id="h">12</a> :
                <a id="m">00</a>:
                <a id="s">00</a>
                <!-- <a id="mi">000</a> -->
                </strong>
                </div>
            </body>
        </div>
        <div class="dash-content">
            <div class="overview">
                <div class="title">
                    <i class="uil uil-user"></i>
                    <span class="text">Daftar email</span>
                </div>
                <?php if (isset($_SESSION['flash'])) : ?>
                    <div class="flash-data" data-flashdata="<?= $_SESSION['flash']['message'] ?>"></div>
                <?php endif; unset($_SESSION['flash']); ?>
        <div class="hiha">
        <table id="hoho" class="table table-hover table-sm table-bordered">
        <thead>
        <tr>
            <th scope="col" class="text-muted">No</th>
            <th scope="col" class="text-muted">Bagian</th>
            <th scope="col" class="text-muted">Nama</th>
            <th scope="col" class="text-muted">Alamat Email</th>
            <th scope="col" class="text-muted">Action</th>
            </tr>
        </thead>
        <tbody id="nempo">
            <?php $no = 1 ?>
            <?php while ($row = mysqli_fetch_assoc($tujuan)) { ?>
                <tr >
                    <th scope="row" class="text-muted"><?= $no++; ?></th>
                    <td class="text-muted"><?= $row['bagiann']?></td>
                    <td class="text-muted"><?= $row['namaa']?></td>
                    <td class="text-muted"><?= $row['emailtujuan']?></td>
                    <td>
                    <!-- <input class="sisi" type="checkbox" id="mycheckbox">
                        <label for="mycheckbox"><img src="menu.png"></label>
                      <div class="sisa">
                        <a class="isi" href="adminlogin.php">Back</a><br>
                        <a class="isi" href="createtamu.php">Create Tamu</a><br>
                        <a class="isi" href="edittamu.php?id=<?= $row['id']?>">Edit</a><br>
                        <a class="isi" href="deletetamu.php?id=<?= $row['id']?>">Delete</a><br>
                      </div> -->
                      <!-- <div align="center">
                        <a href="editemailtuj.php?id=<?= $row['id']?>">Ubah</a><br>
                        <a onclick="SwalDelete(this)" data-id="<?= $row['id']?>" href="#">Hapus</a>
                        </div> -->
                        <div class="dropdown" align="center">
                            <i class="fa-solid fa-ellipsis-vertical" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item text-warning text-center" href="edittamu.php?id=<?= $row['id']?>"><i class="fa-regular fa-pen-to-square"></i> Ubah</a>
                                <a class="dropdown-item text-danger text-center" onclick="SwalDelete(this)" data-id="<?= $row['id']?>" href="#"><i class="fa-regular fa-trash-can"></i> Hapus</a>
                            </div>
                        </div>
                    </td>
                </tr>
            </div>
            <?php } ?>
        </tbody>
        </table>
    </div>
    <script src="script.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script> 
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
    <!-- <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"> -->
    <!-- <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->
    <script type="text/javascript">
    // data table script

    $(document).ready(function () {
    $('#hoho').DataTable({
        dom: '<"toolbar">frtip',
    });
 
    $('div.toolbar').html();
});
    </script>
    <script>
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
    </script>
    <script>
    //delete sweetalert
    $(document).ready(function(){
        $(document).on('click', '#delete_emailtuj', function(e){
            console.log("hello");
            e.prevenDefault();
            var emailtujId = $(this).data('id');
            // SwalDelete(userId);
            
        });
    });

    function SwalDelete(element){
        emailtujId = element.dataset.id;
        // console.log(emailtujId);
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
                window.location.href = "deleteemailtuj.php?id=" + emailtujId;
    //             Swal.fire(
    //   'Deleted!',
    //   'Your file has been deleted.',
    //   'success'
    // )
            }
        })

    }
    </script>
    <script>
        $(document).ready(function() {
          $("#neang").keyup(function() {
            $.ajax({
              method: 'POST',
              url: 'searchus.php',
              data: {
                  search: $(this).val()
              },
              cache: false,
              success: function(data) {
                $("#nempo").html(data);
              }
            });
          });
        });

        // START CLOCK SCRIPT

Number.prototype.pad = function(n) {
  for (var r = this.toString(); r.length < n; r = 0 + r);
  return r;
};

function updateClock() {
  var now = new Date();
//   var milli = now.getMilliseconds(),
    sec = now.getSeconds(),
    min = now.getMinutes(),
    hou = now.getHours(),
    mo = now.getMonth(),
    dy = now.getDate(),
    yr = now.getFullYear();
  var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  var tags = ["mon", "d", "y", "h", "m", "s"],
    corr = [months[mo], dy, yr, hou.pad(2), min.pad(2), sec.pad(2),];
  for (var i = 0; i < tags.length; i++)
    document.getElementById(tags[i]).firstChild.nodeValue = corr[i];
}

function initClock() {
  updateClock();
  window.setInterval("updateClock()", 1);
}

// END CLOCK SCRIPT
    </script>
    <div class="seha">
    <footer class="main-footer">
                <div class="footer-left" style="color:#9D9D9D;">
                    Copyright ?? 2022 Develop By RPL SMKN 1 CIAMIS
                <!-- </div> -->
                <!-- <div class="footer-right"> -->
                    1.0.0
                </div>
            </footer>
    </div>
    </body>
    </html>