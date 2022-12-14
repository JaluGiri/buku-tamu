<?php 
    require 'connection.php';

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == 1){
        header('location: formulir.php', true);
    }

    if (isset($_POST['login'])) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $errors = [];
    
        empty($email) ? array_push($errors, "Field Email is required") : '';
        empty($password) ? array_push($errors, "Field Password is required") : '';
    
        if (count($errors) == 0) {
            $password = md5($password);
    
            $query = "SELECT * FROM pengguna WHERE email='$email' AND password='$password'";
            $results = mysqli_query($conn, $query);
            if (mysqli_num_rows($results) == 1) {
                $_SESSION['email'] = $email;
                $_SESSION['loggedin']  = 1;
                header('location: formulir.php');
            } else {
                array_push($errors, "Wrong username/password combination");
            }
        }
    }
?>
<?php 
    require 'connection.php';

    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] == 1){
        header('location: formulir.php', true);
    }

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
            $user_check_query = "SELECT * FROM pengguna WHERE email='$email' LIMIT 1";
            $result = mysqli_query($conn, $user_check_query);
            $user = mysqli_fetch_assoc($result);

            // Checking user in database
            if ($user) {
                if ($user['email'] === $email) {
                    array_push($errors, "Email already exists");
                }
            }

            $password = md5($password);
            $query = "INSERT INTO pengguna (name, email, password) VALUES ('$name', '$email', '$password')";
            mysqli_query($conn, $query);
            $_SESSION['email'] = $email;
            $_SESSION['loggedin']  = 1;
            header('location: formulir.php');
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="logo.png">
</head>
<body>
    
    <input type="radio" name="radio" id="login" class="radios" checked>
    <input type="radio" name="radio" id="register" class="radios">

    <div class="cover">
        <div class="margins">
            <h1 class="logotitle">KEMENAG R.I</h1>
            <img class="logo" src="logo.png" alt="">
        </div>
    </div>

    <div class="login">
        <div class="loginform">
            <form action="" method="post">
                <div class="title">
                    <h1 class="titles">LOGIN</h1>
                </div>
                <div class="form">
                    <input type="email" name="email" id="" class="forms" placeholder="Email" required autofocus autocomplete="off" oninvalid="this.setCustomValidity('Tolong Isi Email Anda')" oninput="setCustomValidity('')">
                    <br>
                    <input type="password" name="password" id="" class="forms" placeholder="Password" required  oninvalid="this.setCustomValidity('Tolong Isi Password Anda')" oninput="setCustomValidity('')">
                </div>
                <div class="button">
                    <button class="buttons" type="submit" name="login">LOGIN</button>
                </div>
                <label for="register">Tidak punya akun?</label>
            </form>
        </div>
    </div>
    
    <div class="register">
        <div class="loginform">
            <form action="" method="post">
                <div class="title">
                    <h1 class="titles">REGISTER</h1>
                </div>
                <div class="form">
                    <input type="text" name="name" id="" class="forms" placeholder="Nama" required oninvalid="this.setCustomValidity('Tolong Isi Nama Anda')" oninput="setCustomValidity('nice')">
                    <br>
                    <input type="email" name="email" id="" class="forms" placeholder="Email" required  oninvalid="this.setCustomValidity('Tolong Isi Email Anda')" oninput="setCustomValidity('')">
                    <br>
                    <input type="password" name="password" id="" class="forms" placeholder="Password" required  oninvalid="this.setCustomValidity('Tolong Isi Password Anda')" oninput="setCustomValidity('')">
                    <br>
                    <input type="password" name="confirm_password" id="" class="forms" placeholder="Konfirmasi Password" required  oninvalid="this.setCustomValidity('Tolong Konfirmasi Password Anda')" oninput="setCustomValidity('')">
                </div>
                <div class="button">
                    <button class="buttons">REGISTER</button>
                </div>
                <label for="login">Sudah punya akun?</label>
            </form>
        </div>
    </div>
    
</body>
</html>