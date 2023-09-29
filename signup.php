<?php

$showSuccessAlert = false;
$showErrorAlert = false;
$login = false;
$exists = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include "./components/dbconnect.php";

    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $cpassword = $_POST["cpassword"];


    // Validation for Client Side

    $checkQuery = "SELECT * FROM usertable WHERE username='$username' OR email='$email' ";
    $result1 = mysqli_query($connect, $checkQuery);

    if (mysqli_num_rows($result1) > 0) {
        // User with the same username or email already exists
        $exists = true;
        $showErrorAlert = " Either Username or Email already exists! Choose different Username or Email.";
    }

    if ($password == $cpassword) {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO `usertable`(`username`, `email`, `password`, `date_added`) VALUES ('$username', '$email', '$hashedPassword', current_timestamp())";

        $result2 = mysqli_query($connect, $sql);

        if ($result2) {
            $showSuccessAlert = true;
            $login = true;

            session_start();

            $_SESSION["loggedIn"] = true;
            $_SESSION["username"] = $username;

            header("location: welcome.php");
        }
    } else {
        $showErrorAlert = " Confirm Password is Incorrect!";
    }
    // Close the database connection
    mysqli_close($connect);
}

?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        #container {
            width: 630px;
            height: 530px;
            background-color: #0d6efd;
            border-radius: 25px;
        }

        #container h1 {
            line-height: 1.5;
        }

        #alert {
            height: 50px;
        }

        label {
            font-weight: bold;
            letter-spacing: 0.5px;
        }
    </style>
</head>

<body>
    <?php require "./components/navbar.php"  ?>

    <div id="alert">

        <?php

        if ($showSuccessAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hurray!</strong> Your Account Created Successfully.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }
        if ($showErrorAlert) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>' . $showErrorAlert . '
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>';
        }

        ?>
    </div>

    <div id="container" class="container text-center">
        <h1 class="mt-5">Register. Connect. Thrive.</h1>
        <form action="/login-system/signup.php" method="post" class="d-flex flex-column align-items-center">
            <div class="my-3 col-md-6">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username">
            </div>
            <div class="mb-3 col-md-6">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3 col-md-6">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3 col-md-6">
                <label for="cpassword" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" id="cpassword" name="cpassword" aria-describedby="cpasswordHelp">
                <div id="cpasswordHelp" class="form-text">Must Be Same As Above Entered Password</div>
            </div>
            <button type="submit" class="btn btn-outline-light col-md-6" data-bs-theme="dark">Submit</button>
        </form>
        <p class="mt-2">Already Have an Account? <a class="text-warning" href="/login-system/login.php">Login</a></p>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>