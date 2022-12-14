<?php 
    require 'connection.php';

    if (!isset($_SESSION['loggedin'])) {
        header('Location: adminlogin.php');
        exit;
    }
    $tahun = date('Y');

    $date = mysqli_query($conn, "SELECT COUNT(id) as count, Month(tanggal) as month, YEAR(tanggal) as tahun FROM tamu WHERE YEAR (tanggal) = $tahun GROUP BY Month(tanggal)")->fetch_all(MYSQLI_ASSOC);
    $data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
    foreach ($date as $key => $value) {
        $data[$value['month']-1] = intval($value['count']);
    }
    array_pop($data);
    $json = json_encode($data);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylee.css">

    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
    <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.all.min.js"></script>
    

    <title>Admin Panel - Dashboard</title> 
    <link rel="icon" type="image/png" sizes="32x32" href="logo.png">
    
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
                <li class=""><a href="adminpage.php" align="center">
                <i class="uil uil-estate" style=" color: #006635;"></i>
                    <span class="link-name" style="color:#006635;">Dashboard</span>
                </a></li>
                <li><a href="datatamu.php">
                <i class="uil uil-users-alt" style=" width: 35; height: 35;"></i>
                    <span class="link-name">Daftar tamu</span>
                </a></li>
                <li><a href="datausers.php">
                <i class="uil uil-user"></i>
                    <span class="link-name">Daftar users</span>
                </a></li>
                <li><a href="dataemailtujuan.php">
                <i class="uil uil-envelope-alt"></i>
                    <span class="link-name">Daftar email</span>
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
                <input type="text" placeholder="Search here..." id="cari" autofocus autocomplete="off">
            </div> -->
            <div class="logo-name">
               <h2 style="color:#006635;">Admin Dashboard</h2>
            </div>
            
            <body onLoad="initClock()">
                <div id="timedate" style="color:#006635;S">
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
                    <i class="uil uil-home"></i>
                    <span class="text">Dashboard</span>
                </div>
                
                <?php if (isset($_SESSION['flash'])) : ?>
                    <div class="flash-data" data-flashdata="<?= $_SESSION['flash']['message'] ?>"></div>
                <?php endif; unset($_SESSION['flash']); ?>

                <div class="boxes">
                    <div class="box box1">
                        <!-- <a align="center" class="text" href="bagian1.php">
                    <iconify-icon icon="bxs:user-detail" width="50" height="50"></iconify-icon>
                        </a> -->
                        <span class="text">Bagian 1</span>
                        <span class="text">
                        <?php
                            
                            $Bagian1 = "SELECT * FROM tamu WHERE kepada LIKE '%1%'";
                            $query_run = mysqli_query($conn, $Bagian1);

                            $bagian1 = mysqli_num_rows($query_run);

                            echo "<h1 class='isi'>$bagian1</h1>";

                            ?>
                            </span>
                            <div>
                                <hr class="garis">
                                <a class="text" href="bagian1.php">Lihat Selengkapnya<iconify-icon inline icon="bytesize:arrow-right"></iconify-icon></a>
                            </div>
                    </div>
                    <div class="box box2">
                    <!-- <a class="text" href="bagian2.php">
                        <iconify-icon icon="bxs:user-detail" width="50" height="50"></iconify-icon>
                    </a> -->
                        <span class="text">Bagian 2</span>
                        <span class="text" align="center">
                        <?php
                            
                            $Bagian2 = "SELECT * FROM tamu WHERE kepada LIKE '%Bagian2%'";
                            $query_run = mysqli_query($conn, $Bagian2);

                            $bagian2 = mysqli_num_rows($query_run);

                            echo "<h1 class='isi'>$bagian2</h1>";

                            ?>
                            </span>
                            <div>
                                <hr class="garis">
                                <a class="text" href="bagian2.php">Lihat Selengkapnya<iconify-icon inline icon="bytesize:arrow-right"></iconify-icon></a>
                            </div>
                    </div>
                    <div class="box box3">
                        <!-- <a class="text" href="bagian3.php">
                             <iconify-icon icon="bxs:user-detail" width="50" height="50"></iconify-icon>
                        </a> -->
                        <span class="text">Bagian 3</span>
                        <span class="text">
                        <?php
                            
                            $Bagian3 = "SELECT * FROM tamu WHERE kepada LIKE '%Bagian3%'";
                            $query_run = mysqli_query($conn, $Bagian3);

                            $bagian3 = mysqli_num_rows($query_run);

                            echo "<h1 class='isi'>$bagian3</h1>";

                            ?>
                        </span>
                        <div>
                            <hr class="garis">
                            <a class="text" href="bagian3.php">Lihat Selengkapnya<iconify-icon inline icon="bytesize:arrow-right"></iconify-icon></a>
                        </div>
                    </div>

                    <!-- <div class="box box3">
                        <a class="text" href="bagian3.php">
                             <iconify-icon icon="bxs:user-detail" width="50" height="50"></iconify-icon>
                        </a>
                        <span class="text">Bagian 4</span>
                        <span class="text">
                        <?php
                            
                            $Bagian3 = "SELECT * FROM tamu WHERE kepada LIKE '%Bagian3%'";
                            $query_run = mysqli_query($conn, $Bagian3);

                            $bagian3 = mysqli_num_rows($query_run);

                            echo "<h1 class='isi'>$bagian3</h1>";

                            ?>
                        </span>
                    </div> -->
                </div>
            </div><br><br><br><br><br>
            <!-- <?php $years = range(1990, strftime("%Y", time())); ?> -->
            <div style="max-width: 800px;">
            <!-- <form>
            <select>
            <option>Select Year</option>
            <?php foreach($years as $year) : ?>
                <option value="<?php echo $year; ?>"><?php echo $year; ?></option>
            <?php endforeach; ?>
            </select>
            </form> -->
            <canvas id="chart"></canvas>
            </div>
            
            <!-- <div class="data">
                <label class="label" for="bagian1">
                    <div class="top bagian1">
                        <div class="words">
                            <h1 class="isi">Bagian 1</h1>
                            <?php
                            
                            $Bagian1 = "SELECT * FROM tamu WHERE kepada LIKE 'Bagian1'";
                            $query_run = mysqli_query($conn, $Bagian1);

                            $bagian1 = mysqli_num_rows($query_run);

                            echo "<h1 class='isi'>$bagian1</h1>";

                            ?>
                            </div>
                            <div class="icons">
                                <i class='bx bx-briefcase'></i>
                            </div>
                        </div>
                    </label>
                </div>   -->
    <script src="script.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>  -->
    <!-- <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script> -->
    <!-- <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script> -->

    
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="text/javascript">

    const labels = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    const data = {
        labels: labels,
        datasets: [{
            label: 'data perbulan di tahun <?php echo date('Y') ?>',
            backgroundColor: '#006635',
            borderColor: '#006635',
            data: <?= $json; ?>
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {}
    };

    const myChart = new Chart(
    document.getElementById('chart'),
    config
    );


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
    <script>
        const flashData = $('.flash-data').data('flashdata');
        if (flashData){
            Swal.fire({
                title: 'Selamat',
                text: flashData + 'Berhasil Ditambahkan',
                icon: 'success',
                showConfirmButton: false,
                timer: 1500
            });
        }
    </script>

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
</body>
</html>
