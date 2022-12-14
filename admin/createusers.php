<?php
    require 'connection.php';
    // get data from database in id
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
                'message' => 'Data User '
            ];
            header('location: datausers.php');
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Users</title>
    <link rel="stylesheet" type="text/css" href="style1.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container py-5">
        <?php global $errors;
            if ($errors) {
                foreach ($errors as $err) {
                    echo "<p class='alert alert-danger py-1'>$err</p>";
                }
            }   
        ?>
        </div>
        <form class="userrr" action="" method="POST">
        <h2 align="center">Create User</h2>
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
            <div class="buttons">
            <div class="bunttonss">
            <button type="submit" name="create" class="btn btn-primary">Submit</button>
        </div>
        <div class="buttonsss">
            <a href="create.php" class="btn btn-primary">Back</a>
        </div>
        </div>
        </form>
</body>
</html>