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
    <?php
     session_start(); 

    
    ?>
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
            <li><a href="dashboard.php">Dashboard</a></li>
            <li><a href="sign_out.php">Logout</a></li>
        </ul>
    </div>


    <div class="container-fluid content no-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="create-plan-container col-md-12">

                            <form class="create-plan-form" action="plan_check.php" method="post">

                                <span>Choose Goal:</span>
                                <select name="choose-goal" class="custom-select">
                                    <option selected>Select a goal</option>
                                    <option value="Mobile Phone">Mobile Phone</option>
                                    <option value="Laptop">Laptop</option>
                                    <option value="Car">Car</option>
                                </select>
                                <br><br>
                                <span>Saving Goal:</span>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">€</span>
                                    </div>
                                    <input type="text" class="form-control" id="saving-goal" name="saving-goal" required>
                                </div>

                                <br><br>
                                <span>By Date:</span>
                                <input name="end-date" type="date" id="end-date" required>

                                <br><br>
                                <span>Source Account:</span>
                                <select name="source-acount" class="custom-select" id="source-acount" required>
                                    <option selected value="">Select an account</option>

                                </select>

                                <br><br>
                                <span>Destination Account:</span>
                                <select name="destination-acount" class="custom-select" id="destination-acount" required>
                                    <option selected value="">Select an account</option>

                                </select>

                                <br><br>
                                <span>Daily Savings:</span>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">€</span>
                                    </div>
                                    <input type="text" class="form-control" id="daily-savings" name="daily-savings" min="1" required>
                                </div>


                                <br><br>
                                <input name="submit" id="create-plan" class="start-saving-btn" type="submit" value="Create Plan">
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

            var daysDifference = 1;

            function dateDifference(date1, date2) {
                var res = Math.abs(date1 - date2) / 1000;
                var days = Math.floor(res / 86400);
                return days;
            }

            $('#end-date').on('change', function() {
                var date = this.value;
                var items = date.split('-');
                var today = new Date();
                var date2 = new Date(items[0], items[1], items[2]);
                var date1 = new Date(today.getFullYear(), today.getMonth() + 1, today.getDate());
                daysDifference = dateDifference(date1, date2);
                console.log(daysDifference);
                $('#daily-savings').val((parseInt($('#saving-goal').val()) / daysDifference).toFixed(2));
            });


            $('#end-date').on('change', function() {
                console.log(this.value);
            });

            $('.mobile-menu-container').on('click', function() {
                $(this).children('.mobile-menu-icon').toggleClass('open');
                $('#top-nav ul').slideToggle("fast");

            });

            var subId = <?php echo json_encode($_SESSION['subId']) ?>;
            var authCode = <?php echo json_encode($_SESSION['initialToken']) ?>;
            console.log(authCode);
            console.log(subId);

            $.get("http://koumbaras.knowledgedesire.com/api/getAccounts.php?authCode=" + authCode + "&subId=" + subId, function(data) {
                    data.forEach(function(account) {
                        if (account.accountId == 351012345673) {
                            account.accountName = 'KOUMBARAS';
                        }
                        $('#source-acount').append('<option value="' + account.accountId + '">' + account.accountName + '</option>');
                        $('#destination-acount').append('<option value="' + account.accountId + '">' + account.accountName + '</option>');
                    });
                })
                .done(function() {
                    console.log('Authentication Done');
                })
                .fail(function(error) {
                    console.log('Authentication Error');
                });

            $('#source-acount').on('change', function() {
                if (this.value == $('#destination-acount').val()) {
                    $('#create-plan').addClass('disabled-btn');
                } else {
                    $('#create-plan').removeClass('disabled-btn');
                }
            });

            $('#destination-acount').on('change', function() {
                if (this.value == $('#source-acount').val()) {
                    $('#create-plan').addClass('disabled-btn');
                } else {
                    $('#create-plan').removeClass('disabled-btn');
                }
            });

            $('#saving-goal').on('change', function() {
                $('#daily-savings').val((parseInt(this.value) / daysDifference).toFixed(2));
            });
        });

    </script>

</body>

</html>
