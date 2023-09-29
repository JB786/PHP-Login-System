<?php

$login = false;
$showErrorAlert = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include "./components/dbconnect.php";

    $username = $_POST["username"];
    $password = $_POST["password"];
    

    // $sql = "SELECT * FROM usertable WHERE username='$username' AND password='$password'";
    $sql = "SELECT * FROM usertable WHERE username='$username'";
    $result = mysqli_query($connect, $sql);
    $num = mysqli_num_rows($result);

    if($num == 1){
        while($row = mysqli_fetch_assoc($result)){
            if(password_verify($password, $row['password'])){
                $login = true;

                session_start();
        
                $_SESSION["loggedIn"] = true;
                $_SESSION["username"] = $username;
        
                header("location: welcome.php");
            }
            else{
                $showErrorAlert = " Invalid Credentials!!";
            }
        }

    }
    else{
        $showErrorAlert = " Invalid Credentials!!";
    }
     
}


?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        #container {
            width: 630px;
            height: 420px;
            background-color: #0d6efd;
            border-radius: 25px;
        }

        #container h1 {
            line-height: 2;
        }
        #alert{
            height: 50px;
        }
        label{
            font-weight: bold;
            letter-spacing: 0.5px;
        }
    </style>
</head>

<body>
    <?php require "./components/navbar.php"  ?>

    <div id="alert">

        <?php

        if ($login) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> Logged in Successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        if ($showErrorAlert) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Sorry!</strong>'.$showErrorAlert.'
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }

        ?>
    </div>

    <div id="container" class="container text-center">
        <h1 class="mt-5">Login To Your Account</h1>
        <form action="/login-system/login.php" method="post" class="d-flex flex-column align-items-center mt-4">
            <div class="mb-3 col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
                <p class="mt-2">Forgot Password? <a class="text-warning" href="/login-system/signup.php">Click Here</a></p>
            </div>
        
            <button type="submit" class="btn btn-outline-light col-md-6" data-bs-theme="dark">Login</button>
        </form>
        <p class="mt-2">Not Registered? <a class="text-warning" href="/login-system/signup.php">Sign Up</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>