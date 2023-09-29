<?php

if(isset($_SESSION["loggedIn"]) && $_SESSION["loggedIn"] == true){
    $loggedIn = true; 
}

else{
    $loggedIn = false;
}

if($loggedIn){

    echo'<nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/login-system">LogSys</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">';

            if($loggedIn){

                echo '<li class="nav-item">
                <a class="nav-link" aria-current="page" href="/login-system/welcome.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login-system/logout.php">Logout</a>
                    </li>';
            }
            if(!$loggedIn){

                echo '<li class="nav-item">
                <a class="nav-link" href="/login-system/signup.php">Sign Up</a>
                </li>
                <li class="nav-item">
                <a class="nav-link" href="/login-system/login.php">Login</a>
                </li>';
            }
            echo '</ul>';
            
            if($loggedIn){
                
                echo '<form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-light" type="submit">Search</button>
                </form>';
            }
            
            echo'</div>
            </div>
            </nav>';
            
    }
            
?>
