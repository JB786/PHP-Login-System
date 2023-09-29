<?php
session_start();

if (!isset($_SESSION["loggedIn"]) || $_SESSION["loggedIn"] != true) {
    header("location: login.php");
    exit;
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome | <?php echo $_SESSION["username"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <?php require "./components/navbar.php"  ?>

    <div class="container my-5">
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Welcome! <?php echo $_SESSION["username"] ?></h4>
            <p>Aww yeah, you successfully registered with us. We're delighted to have you as part of our community! Whether you're here for inspiration, information, or simply a good time, you've landed in the right place.</p>
            <hr>
            <p class="mb-0">Whenever you want to logout, be sure to use this <a href="/login-system/logout.php">link</a></p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>