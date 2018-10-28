<?php
    session_start();
    include("dblogin.php"); 

if(isset($_GET['code'])) {
    $code = $_GET['code'];
       header("Location:after.php?code=". $code);
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
            <?php
            if(!isset($_SESSION['id'])){ 
            ?>
            <li><a class="active" href="index.php">Home</a></li>
            <?php
            }
            else{
            ?>
            <li><a class="active" href="index.php">Home</a></li>
            <li><a href="dashboard.php">Dashboard</a></li>
            <?php
                        
            }
                    
            ?>

        </ul>
    </div>


    <div class="container-fluid content">
        <div class="container">
            <div class="row">
                <div class="form-box col-md-12">

                    <?php
                    if(!isset($_SESSION['id'])){ 
                        ?>
                    <form action="sign_in_check.php" id="login-form" method="post">
                        <span id="log-in-txt">Log in to your account.</span>
                        <div class="form-group">
                            <label class="label-control">
                                <span class="label-text">User ID</span>
                            </label>
                            <input type="text" name="username" autocomplete="off" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label class="label-control">
                                <span class="label-text">Password</span>
                            </label>
                            <input type="password" name="password" class="form-control" />
                        </div>
                        <input type="submit" value="Login" name="submit-btn" class="btn" />
                    </form>
                    <?php
                    }
                    else{
                        ?>
                    <span id="log-in-txt logged">You are logged in!</span>
                    <?php
                        
                    }
                    
                    ?>


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
            $('.form-group input').on('focus blur', function(e) {
                $(this).parents('.form-group').toggleClass('active', (e.type === 'focus' || this.value.length > 0));
            }).trigger('blur');




            /*var access_token, client_id, client_secret, subscription_id;

            client_id = "d4cdc1e7-1dfc-4467-948e-58e30d3fa811";
            client_secret = "fC2yX7rD4hD1vY3wR7aY2lF6uG1aC0dT8pI3kD7oC4jW4bL8iU";

            //POST Oauth - Client Credential
            var settings = {
                "async": false, //true = faster but cant save the var
                "crossDomain": true,
                "url": "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/token",
                "method": "POST",
                "headers": {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                "data": {
                    "client_id": client_id,
                    "client_secret": client_secret,
                    "grant_type": "client_credentials",
                    "scope": "TPPOAuth2Security"
                }
            }

            $.ajax(settings).done(function(response) {
                access_token = response.access_token;
                console.log(access_token);
            });


            

                        //POST Oauth - Introspect
                        var settings = {
                            "async": false,
                            "crossDomain": true,
                            "url": "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/introspect",
                            "method": "POST",
                            "headers": {
                                "Content-Type": "application/x-www-form-urlencoded"
                            },
                            "data": {
                                "client_id": client_id,
                                "client_secret": client_secret,
                                "token": access_token,
                                "token_type_hint": "access_token"
                            }
                        }

                        $.ajax(settings).done(function(response) {
                            //console.log(response);
                        });




                        //POST CreateSubscription

                        var settings = {
                            "async": false,
                            "crossDomain": true,
                            "url": "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/v1/subscriptions?client_id=" + client_id + "&client_secret=" + client_secret + "",
                            "method": "POST",
                            "headers": {
                                "Authorization": "Bearer " + access_token + "",
                                "Content-Type": "application/json",
                                "APIm-Debug-Trans-Id": "true",
                                "app_name": "myapp",
                                "tppid": "singpaymentdata",
                                "originUserId": "10",
                                "timeStamp": "{{$timestamp}}",
                                "journeyId": "abc"
                            },
                            "processData": false,
                            "data": "{\r\n \"accounts\": {\r\n    \"transactionHistory\": true,\r\n    \"balance\": true,\r\n    \"details\": true,\r\n    \"checkFundsAvailability\": true\r\n  },\r\n  \"payments\": {\r\n    \"limit\": 99999999,\r\n    \"currency\": \"EUR\",\r\n    \"amount\": 999999999\r\n  }\r\n}"
                        }

                        $.ajax(settings).done(function(response) {
                            subscription_id = response.subscriptionId;
                        });

                        //POST Oauth - Authorisation Code
                        var settings = {
                            "async": false,
                            "crossDomain": true,
                            "url": "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/token",
                            "method": "POST",
                            "headers": {
                                "Content-Type": "application/x-www-form-urlencoded"
                            },
                            "data": {
                                "client_id": client_id,
                                "client_secret": client_secret,
                                "grant_type": "authorization_code",
                                "scope": "UserOAuth2Security",
                                "code": access_token //PROVLIMA!!!!!!!!!!(PIANO TO PISO P REDIRECT?)
                            }
                        }

                        $.ajax(settings).done(function(response) {
                            console.log(response);
                        });

                        console.log("Client ID: " + client_id);
                        console.log("Client Secret: " + client_secret);
                        console.log("Access Token: " + access_token);
                        console.log("Subscription ID: " + subscription_id);

                        $('.i-bank-btn').on('click', function() {
                            window.location.href = "https://sandbox-apis.bankofcyprus.com/df-boc-org-sb/sb/psd2/oauth2/authorize?response_type=code&redirect_uri=https://localhost&scope=UserOAuth2Security&client_id=f2e52390-206d-41b3-999a-0f8bb0c6cb09&subscriptionid=Subid000001-1540563366711";

                        });

            */
        });

    </script>

</body>

</html>
