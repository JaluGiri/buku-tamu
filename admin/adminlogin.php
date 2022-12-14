<?php 
    require 'connection.php';

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == 1){
        header('location: adminpage.php', true);
    }

    if (isset($_POST['login'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $errors = [];
    
        empty($email) ? array_push($errors, "Field Email is required") : '';
        empty($password) ? array_push($errors, "Field Password is required") : '';

        if (count($errors) == 0) {
            $password = md5($password);
    
            $query = "SELECT * FROM admin WHERE email='$email' AND password='$password'";
            $results = mysqli_query($conn, $query);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['email'] = $email;
                $_SESSION['loggedin']  = 1;
                header('location: adminpage.php');
            } else {
                array_push($errors, "Wrong username/password combination");
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="logo.png">
     <script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
    <style>
        body{
            background: #006635;
            background: linear-gradient(to right, #ffffff, #ffffff);
        }
        .forms{
            bacground: #006635;
        }
        .margins{
            /* position: absolute; */
            margin-top: 2%; 
            margin-bottom: -1%
        }
        .logo{
            width: 4vw;
        }
        .btn{
            margin-top: 2px;
            margin-left: 65px;
        }
    </style>
</head>
<body>
        <div class="margins" align="center">
            <!-- <h1 class="logotitle">KEMENAG R.I</h1> -->
            
        </div>
    <div class="container" >
        <div class="row" >
            <div class="col-sm-9 col-lg-5 mx-auto">
                <div class="card border-success shadow rounded-3 my-5" >
                    <div class="card-body p-4 p-sm-5">
                        <div align="center">
                            <img class="logo" src="logo.png" alt="" align="center">
                        </div><br>
                        <h5 class="card-title text-center mb-3">Admin Login</h5>
                        <?php global $errors;
                            if ($errors) {
                                foreach ($errors as $err) {
                                    echo "<p class='alert alert-danger py-1'>$err</p>";
                                }
                            }
                        ?>  
                        <form action="" method="post" class="forms">
                            <div class="mb-2">
                                <label for="name">Email</label>
                                <input class="form-control" type="text" name="email" autocomplete="off" autofocus required>
                            </div>
                            <div class="mb-2">
                                <label for="name">Password</label>
                                <input class="form-control" type="password" name="password" required>
                            </div>
                            <div class="btn" align="center">
                                <button class="btn btn-outline-success" type="submit" name="login">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>