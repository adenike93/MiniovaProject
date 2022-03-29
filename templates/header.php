<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="./assests/styles/index.css">
    <title>Miniova</title>
</head>
<body>
<header>  
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid" class= "main-nav">
    <a class="navbar-brand" href="index.php">MINIOVA</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">HOME</a>
          </li>
          <?php 
                if(isset($_SESSION["user"])) {

                    $value = isset( $_SESSION['user'] ) ? $_SESSION['user'] : '';
                    $admin = isset($_SESSION["admin"]) ? ($_SESSION["admin"]): null;
                    $Experience = isset($_SESSION["admin"]) ? "ADMIN PAGE": "UPLOAD EXPERIENCE";
                    $path = isset($_SESSION["admin"]) ? "admin.php": "experiences2.php";

                    $Upload_user = ucfirst($value);
                    echo "
                    <li class='nav-item'>
                        <a class='nav-link active' href='$path'>$Experience</a>
                    </li>" ;
                    echo "
                    <li class='nav-item'>
                        <a class='nav-link active' href='logout.php'>LOGOUT</a>
                    </li>";
                    echo "<li class='nav-item'>
                    <a class='nav-link' style='color: black;font-weight:bold;'> Welcome, $Upload_user <span style='font-size:12px; color: red;'>$admin</span></a>
                    </li>";
                } else {
                    echo '
                    <li class="nav-item">
                        <a class="nav-link active" href="./signup2.php">CREATE ACCOUNT</a>
                     </li>';
                    echo '
                    <li class="nav-item">
                        <a class="nav-link active" href="./login2.php">LOGIN</a>
                     </li>';
                }    
          ?> 
        </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
</header>   
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">