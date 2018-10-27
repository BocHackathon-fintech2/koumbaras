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
            <span id="logo-text">Kumparas</span>
        </div>
        <div class="mobile-menu-container">
            <span class="mobile-menu-icon"></span>
        </div>
        <ul>
            <li><a href="#">Link 1</a></li>
            <li><a href="#">Link 2</a></li>
            <li><a href="#">Link 3</a></li>
            <li><a href="#">Link 4</a></li>
        </ul>
    </div>


    <div class="container-fluid content no-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="create-plan-container col-md-12">

                            <form class="create-plan-form" action="" method="post">

                                <span>Choose Goal:</span>
                                <select name="choose-goal" class="custom-select">
                                    <option selected>Select a goal</option>
                                    <option value="Mobile Phone">Mobile Phone</option>
                                    <option value="Laptop">Laptop</option>
                                    <option value="Car">Car</option>
                                </select>
                                <br><br>
                                <span>Saving Goal:</span>
                                <input name="saving-goal" type="number" id="example-number-input">

                                <br><br>
                                <span>By Date:</span>
                                <input name="end-date" type="date" id="example-date-input">

                                <br><br>
                                <span>Source Account:</span>
                                <select name="source-acount" class="custom-select">
                                    <option selected>Select an account</option>
                                    <option value="1">Option1</option>
                                    <option value="2">Option2</option>
                                    <option value="3">Option3</option>
                                </select>

                                <br><br>
                                <span>Destination Account:</span>
                                <select name="destination-acount" class="custom-select">
                                    <option selected>Select an account</option>
                                    <option value="1">Option1</option>
                                    <option value="2">Option2</option>
                                    <option value="3">Option3</option>
                                </select>

                                <br><br>
                                <span>Daily Savings:</span>
                                <input name="daily-savings" type="number" id="example-number-input">

                                <br><br>
                                <input class="start-saving-btn" type="submit" value="Create Plan">
                                <br><br>

                            </form>
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
