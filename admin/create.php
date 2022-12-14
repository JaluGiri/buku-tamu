<?php 
    require 'connection.php';

    if (!isset($_SESSION['loggedin'])) {
        header('Location: adminlogin.php');
        exit;
    }

    // create user start

    if (isset($_POST['create'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        $errors = [];

        empty($name) ? array_push($errors, "Field Name is required") : '';
        empty($email) ? array_push($errors, "Field Email is required") : '';
        empty($password) ? array_push($errors, "Field Password is required") : '';
        empty($confirm_password) ? array_push($errors, "Field Confirm Password is required") : '';

        $password != $confirm_password ? array_push ($errors, "Password you typed doesn't match") : '';

        if (count($errors) == 0) {
            $user_check_query = "SELECT * FROM pengguna WHERE email='$email' LIMIT 1";
            $pengguna = mysqli_query($conn, $user_check_query);
            $pengguna = mysqli_fetch_assoc($pengguna);

            // Checking user in database
            if ($pengguna) {
                if ($pengguna['email'] === $email) {
                    array_push($errors, "Email already exists");
                }
            }

            $password = md5($password);
            $query = "INSERT INTO pengguna (name, email, password) VALUES ('$name', '$email', '$password')";
            mysqli_query($conn, $query);
            $_SESSION['flash'] =[
                'type' => 'succes',
                'message' => 'Data User Berhasil Disimpan '
            ];
            header('location: datausers.php');
        }
    }
        // create user end



    // create tamu start
    if (isset($_POST['ctamu'])) {
        $nama= $_POST['nama'];
        $alamat = $_POST['alamat'];
        $notelp = $_POST['notelp'];
        $pesan = $_POST['pesan'];
        $kepada = $_POST['kepada'];
        $tanggal = $_POST['tanggal'];
        $keperluan = $_POST['keperluan'];

        $query = "INSERT INTO tamu(nama, alamat, notelp, pesan, kepada, tanggal, keperluan) VALUES ('$nama', '$alamat', '$notelp', '$pesan', '$kepada', '$tanggal', '$keperluan')";
        mysqli_query($conn, $query);
        $_SESSION['flash'] =[
            'type' => 'success',
            'message' => 'Data Tamu Berhasil Disimpan '
        ];

        header('location: datatamu.php');
    }
    // create tamu end


        // create admin start
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        $errors = [];

        empty($name) ? array_push($errors, "Fieluiredd Name is req") : '';
        empty($email) ? array_push($errors, "Field Email is required") : '';
        empty($password) ? array_push($errors, "Field Password is required") : '';
        empty($confirm_password) ? array_push($errors, "Field Confirm Password is required") : '';

        $password != $confirm_password ? array_push ($errors, "Password you typed doesn't match") : '';

        if (count($errors) == 0) {
            $user_check_query = "SELECT * FROM admin WHERE email='$email' LIMIT 1";
            $result = mysqli_query($conn, $user_check_query);
            $user = mysqli_fetch_assoc($result);

            // Checking user in database
            if ($user) {
                if ($user['email'] === $email) {
                    array_push($errors, "Email already exists");
                }
            }

            $password = md5($password);
            $query = "INSERT INTO admin (name, email, password) VALUES ('$name', '$email', '$password')";
            mysqli_query($conn, $query);
            $_SESSION['flash'] =[
                'type' => 'succes',
                'message' => 'Data Admin Berhasil Disimpan'
            ];
            header('location: adminpage.php');
        }
    }
    // create admin end
    
    
    //email tujuan start
    if (isset($_POST['mengirim'])) {
        $bagiann = $_POST['bagiann'];
        $namaa = $_POST['namaa'];
        $emailtujuan = $_POST['emailtujuan'];

        $query = "INSERT INTO tujuan (bagiann, namaa, emailtujuan) VALUES('$bagiann', '$namaa', '$emailtujuan')";
        mysqli_query($conn, $query);
        $_SESSION['flash'] =[
            'type' => 'success',
            'message' => 'Email Tujuan '
        ];
        header('location: dataemailtujuan.php');
    }
        
    // email tujuan end

     // email start
     $query = "SELECT * FROM tujuan";
     $tujuan = mysqli_query($conn, $query);
     // email end
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
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.6.0/dist/sweetalert2.all.min.js"></script> 
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <title>Admin Panel - create</title> 
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
                <i class="uil uil-envelope-alt"></i>
                    <span class="link-name">Daftar email</span>
                </a></li>
                <li><a href="create.php">
                <i class="uil uil-plus-square" style=" color: #006635;"></i>
                    <span class="link-name" style="color:#006635;">Create</span>
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
            <div>
                <h2 style="color:#006635;">Admin Dashboard<h2>
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
                    <i class="uil uil-plus-square"></i>
                    <span class="text">Create</span>
                </div>
                <!-- <div class="alert alert-success">
                    <strong>Success!</strong> Data berhasil ditambahkan.
                </div> -->

                <div>
                <!-- <p>Ini adalah halaman <strong>Create</strong>. Dihalaman ini kamu bisa menambahkan Data Tamu, Data User, dan juga Data Admin.</p><br><br> -->
                    <!-- createtamu start -->
                <div class="boxes">
                    <div class="box box1">
                        <a align="center" href="" class="text" data-toggle="modal" data-target="#ctamuModal">
                    <iconify-icon icon="fluent:people-add-16-filled" width="90" height="90"></iconify-icon>
                        <h2 class="">Create Tamu</h2>
                        </a>
                            <!-- Modal -->
                            <form action="send-mail.php" method="POST">
                            <div class="modal fade" id="ctamuModal" tabindex="-1" role="dialog" aria-labelledby="ctamuModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ctamuModalLabel">Create Tamu</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <form class="hehe" action="" method="POST">
                                    <!-- <h2 align="center">Create Tamu</h2> -->
                                        <div class="mb-1">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="nama" placeholder="Full Name" class="form-control">
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">Alamat</label>
                                            <input type="text" name="alamat" placeholder="Email Address"  class="form-control">
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">No.Telp</label>
                                            <input type="number" name="notelp" placeholder="Nomor Telpon" class="form-control">
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">Pesan</label>
                                            <input type="text" name="pesan" placeholder="Isi Pesan Disini" class="form-control">
                                        </div>    
                                        <div class="mb-1">
                                            <label class="form-label pt-2">Kepada</label>
                                            <select class="form-control" name="kepada" aria-label="Default select example">

                                            <?php
                                                foreach($tujuan as $tuj) { ?>
                                                <option value="<?= $tuj['bagiann'] ?>-<?= $tuj['namaa'] ?>&<?= $tuj['emailtujuan'] ?>"><?= $tuj['bagiann']?> - <?= $tuj['namaa'] ?></option>
                                            <?php
                                                } ?>

                                                <!-- <option selected>Pilih Salah Satu</option>
                                                <option value="Bagian1-Bapak Siapa">Bagian1-Bapak Siapa</option>
                                                <option value="Bagian1-Ibu Siapa">Bagian1-Ibu Siapa</option>
                                                <option value="Bagian1-Pada Siapa">Bagian1-Pada Siapa</option>
                                                <option value="Bagian2-Bapak Siapa">Bagian2-Bapak Siapa</option>
                                                <option value="Bagian2-Ibu Siapa">Bagian2-Ibu Siapa</option>
                                                <option value="Bagian2-Pada Siapa">Bagian2-Pada Siapa</option>
                                                <option value="Bagian3-Bapak Siapa">Bagian3-Bapak Siapa</option>
                                                <option value="Bagian3-Ibu Siapa">Bagian3-Ibu Siapa</option>
                                                <option value="Bagian3-Pada Siapa">Bagian3-Pada Siapa</option> -->
                                            </select>
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">Tanggal dan Waktu</label>
                                            <input type="datetime-local" name="tanggal" class="form-control">
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">Keperluan</label>
                                            <input class="form-control" type="text" name="keperluan" placeholder="Apa Keperluan Mu?">
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="ctamu" class="btn btn-primary">Create</button>
                                </div>
                                </div>
                            </div>
                            </div>
                    </div>
                    </form>
                    <!-- createtamu end -->



                    <!-- createuser start -->
                    <div class="box box2">
                        <a href="createusers.php" align="center" class="text" data-toggle="modal" data-target="#cuserModal">
                    <iconify-icon icon="icomoon-free:user-plus" width="90" height="90"></iconify-icon>
                        <h2 class="">Create User</h2>
                        </a>
                            <!-- Modal -->
                            <form action="" method="POST">
                            <div class="modal fade" id="cuserModal" tabindex="-1" role="dialog" aria-labelledby="cuserModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h class="modal-title" id="cuserModalLabel">Create User</h>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <!-- <div class="container py-5"> -->
                                    <?php global $errors;
                                        if ($errors) {
                                            foreach ($errors as $err) {
                                                echo "<script type ='text/JavaScript'>";  
                                                echo "alert('$err')";  
                                                echo "</script>"; 
                                            }
                                        }   
                                    ?>
                                    <!-- </div> -->
                                    <!-- <form class="userrr" action="" method="POST"> -->
                                    <!-- <h2 align="center">Create User</h2> -->
                                        <div class="mb-1">
                                            <label class="form-label">Name</label>
                                            <input type="text" name="name" placeholder="Full Name" class="form-control">
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">Email address</label>
                                            <input type="email" name="email" placeholder="Email Address"  class="form-control">
                                        </div>
                                        <div class="mb-1">
                                            <label class="form-label">Password</label>
                                            <input type="password" name="password" placeholder="Password" class="form-control">
                                        </div>
                                        <div class="mb-1">
                                            <label for="name">Confirm Password</label>
                                            <input class="form-control" type="password" name="confirm_password">
                                        </div>
                                        <!-- <div class="buttons">
                                        <div class="bunttonss">
                                        <button type="submit" name="create" class="btn btn-primary">Submit</button>
                                    </div>
                                    <div class="buttonsss">
                                        <a href="create.php" class="btn btn-primary">Back</a>
                                    </div> -->
                                    <!-- </div> -->
                                    <!-- </form> -->
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" name="create" class="btn btn-primary">Create</button>
                                </div>
                                </div>
                            </div>
                            </div>
                    </div>
                    </form>
                    <!-- createuser end -->


                    <!-- createadmin start -->
                    <div class="box box3">                        
                        <a align="center" class="text" href="" data-toggle="modal" data-target="#exampleModal">
                    <iconify-icon icon="subway:admin-1" width="90" height="90"></iconify-icon>
                    <h2>Create Admin</h2>
                    </a> 
                        <!-- Modal -->
                        <form action="" method="post">
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <?php global $errors;
                                        if ($errors) {
                                            foreach ($errors as $errss) {
                                                echo "<script type ='text/JavaScript'>";  
                                                echo "alert('$errss')";  
                                                echo "</script>"; 
                                            }
                                        }   
                                    ?>
                                <!-- <form action="" method="post"> -->
                                <div class="mb-2">
                                    <label for="name">Name</label>
                                    <input class="form-control" type="text" name="name">
                                </div>
                                <div class="mb-2">
                                    <label for="name">Email</label>
                                    <input class="form-control" type="text" name="email">
                                </div>
                                <div class="mb-2">
                                    <label for="name">Password</label>
                                    <input class="form-control" type="password" name="password">
                                </div>
                                <div class="mb-2">
                                    <label for="name">Confirm Password</label>
                                    <input class="form-control" type="password" name="confirm_password">
                                </div>
                                <!-- <div class="pt-3 d-flex justify-content-between align-self-center"> -->
                                    <!-- <button class="btn btn-primary" type="submit" name="register">Register</button> -->
                                    <!-- <a class="" href="adminlogin.php">I Have an account</a> -->
                                <!-- </div> -->
                                <!-- </form>      -->
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="register">Create</button>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div><br><br>
                <div class="title">
                    <span class="text">Alamat Email Tujuan</span>
                </div>
                    <form>
                    <div>
                    <form action="" method="post">
                        <div class="col-5 mb-2">
                            <label>Bagian</label>
                            <select class="form-control"name="bagiann" aria-label="Default select example">
                                <option selected>Piih Salah Satu</option>
                                <option value="1.Bagian ini">1.Bagian ini</option>
                                <option value="2.Bagian itu">2.Bagian itu</option>
                                <option value="3.Bagian anu">3.Bagian anu</option>
                                </select>
                        </div>
                    <!-- <div class="form-row"> -->
                        <div class="col-5 mb-2">
                            <label>Nama</label>
                            <input type="text" class="form-control" name="namaa" autocomplete="off" >
                        </div>
                        <div class="col-5 mb-2">
                        <label>Email</label>
                            <input type="email" class="form-control" name="emailtujuan" autocomplete="off" >
                        </div>
                    <!-- </div> -->
                        <div>
                            <button type="submit" name="mengirim" class="btn btn-primary">submit</button>
                        </div>
                    </form>
                                            
        
        <script src="src.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.iconify.design/iconify-icon/1.0.0-beta.3/iconify-icon.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
        $('select').select2({
  placeholder: 'Pilih Salah Satu',
  allowClear: true
});
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














    