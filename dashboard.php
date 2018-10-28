<?php
    session_start();
   
    if(!isset($_SESSION['id'])){ 
        header ('Location: index.php');
    }
?>

<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koumparas</title>

    <!-- CSS & CUSTOM FONTS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Play:700,400%7CSintony:400,400&subset=cyrillic,cyrillic-ext,devanagari,greek,greek-ext,khmer,latin,latin-ext,vietnamese,hebrew,arabic,bengali,gujarati,tamil,telugu,thai,cyrillic,cyrillic-ext,devanagari,greek,greek-ext,khmer,latin,latin-ext,vietnamese,hebrew,arabic,bengali,gujarati,tamil,telugu,thai">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://unpkg.com/ionicons@4.4.4/dist/ionicons.js"></script>

</head>

<body>

    <div id="top-nav">
        <div id="logo-container">
            <img id="logo" src="images/logo.png" alt="">
            <span id="logo-text">Koumbaras</span>
        </div>
        <div class="mobile-menu-container">
            <span class="mobile-menu-icon"></span>
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a class="active" href="dashboard.php">Dashboard</a></li>
        </ul>
    </div>


    <div class="container-fluid content no-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="has-plan-container col-md-12">
                            <div class="info-box">
                                <span id="current-savings">$30</span>
                                <span class="small">out of</span>
                                <span id="goal-savings">$100</span>
                            </div>
                            <a href="sign_out.php">Sign Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>


    <script>
        $(document).ready(function() {

            $('.mobile-menu-container').on('click', function() {
                $(this).children('.mobile-menu-icon').toggleClass('open');
                $('#top-nav ul').slideToggle("fast");

            });


        });

    </script>

</body>

</html>
