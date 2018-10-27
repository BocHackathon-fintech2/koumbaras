<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GReFORM - Sign In</title>

    <!-- CSS & CUSTOM FONTS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500" rel="stylesheet">

</head>

<body>

    <a href="" class="scroll-top"><i class="fas fa-chevron-up icon"></i></a>

    <div class="mobile-top-nav">
        <a href="index.php" id="mobile-logo"></a>
        <div class="mobile-menu-container">
            <span class="mobile-menu-icon"></span>
        </div>
    </div>

    <!--START OF TOP NAV-->
    <div class="top-nav">
        <div class="container">
            <ul>
                <li><a id="logo" href="index.php"></a></li>
                <li><a href="index.php"><i class="fas fa-home top-nav-icon"></i>Home</a></li>
                <li><a href="recent-highlights.php"><i class="far fa-star top-nav-icon"></i>Recent Highlights</a></li>
                <li><a href="public-deliverables.php"><i class="fas fa-cubes top-nav-icon"></i>Public Deliverables</a></li>
                <li><a href="team.php"><i class="fas fa-users top-nav-icon"></i>Team</a></li>
                <li><a href="gallery.php"><i class="fas fa-camera-retro top-nav-icon"></i>Gallery </a></li>
                <li><a href="contact.php"><i class="far fa-envelope top-nav-icon"></i> Contact Us</a></li>
                <li><a id="active-link" href="sign_in.php"><i class="fas fa-sign-in-alt top-nav-icon"></i>Sign In</a></li>
                <li><a id="platform-link" target="_blank" title="Go to the e-Platform" href="http://213.149.185.137:8080/moodle/"><i class="fas fa-external-link-alt top-nav-icon"></i>e-Platform</a></li>
            </ul>
        </div>
        <span id="mobile-menu-close">&#10006;</span>
    </div>
    <!--END OF TOP NAV-->



    <div class="container-fluid contact-us-holder">
        <div class="full-bg">
            <div class="sign-in-form-container">
                <form id="sign-in-form" action="sign_in_check.php" method="post">
                    <input id="username" name="username" type="text" placeholder="Username">

                    <i id="form-icon-user" class="fa fa-user" aria-hidden="true"></i>
                    <input id="password" name="password" type="password" placeholder="Password">
                    <i id="form-icon-password" class="fa fa-unlock-alt" aria-hidden="true"></i>

                    <input id="submit-btn" name="submit-btn" type="submit" value="Log In">
                </form>
            </div>
        </div>
    </div>

    <div class="container-fluid footer">
        <div class="container">
            <div class="row main-holder">

                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 flex">


                    <div id="twitter-btn">
                        <div class="twitter-holder">
                            <a class="twitter-timeline" data-chrome=nofooter noborders transparent data-width="260" data-height="375" href="https://twitter.com/greformeu?ref_src=twsrc%5Etfw">Tweets by greformeu</a>
                        </div>
                    </div>
                    <div id="fb-btn">
                        <div class="fb-holder">
                            <div class="fb-page" data-href="https://www.facebook.com/greform/" data-tabs="timeline" data-width="260" data-height="375" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="false">
                                <blockquote cite="https://www.facebook.com/greform/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/greform/">Good Governance enhancement through e-Learning for Sport Volunteer</a></blockquote>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <h2>QUICK LINKS</h2>
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Recent Highlights</a></li>
                        <li><a href="#">Public Deliverables</a></li>
                        <li><a href="#">Team</a></li>
                        <li><a href="#">Gallery</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Sign In</a></li>
                    </ul>
                </div>

                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4">
                    <h2>CONTACT US</h2>
                    <ul>
                        <li><span><i class="fas fa-envelope  footer-icon"></i> info@greform.eu</span></li>
                        <li><span><i class="fas fa-map-marker-alt footer-icon"></i> Cyprus Sport Organisation,
                        Makario Athletic Centre Avenue,
                        2400 Nicosia, Cyprus </span></li>
                        <li><span><i class="fas fa-phone footer-icon"></i>+357 22897237 / +357 22897204</span></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>


    <!-- JAVASCRIPT -->
    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>

    <script>
        $(document).ready(function() {

            $(window).scroll(function() {
                var scroll = $(window).scrollTop();
                if (scroll > 50) {
                    //$(".top-nav").addClass("fixednav");
                    $('.scroll-top').fadeIn();
                } else {
                    //$(".top-nav").removeClass("fixednav");
                    $('.scroll-top').fadeOut();
                }
            })


            $('.scroll-top').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 800);
                return false;
            });


            $(".mobile-menu-container").on("click", function() {
                $(".top-nav").addClass("open");
                $("body").addClass("overflow-hidden");

            });

            $(" .top-nav #mobile-menu-close").on("click", function() {
                $(".top-nav").removeClass("open");
                $("body").removeClass("overflow-hidden");
            });

            $(".top-nav #logo").on("click", function() {
                $(".top-nav").removeClass("open");
                $("body").removeClass("overflow-hidden");
            });


            $("#twitter-btn").mouseenter(function() {
                $(".twitter-holder").fadeIn("slow");
            });

            $("#twitter-btn").mouseleave(function() {
                $(".twitter-holder").fadeOut("fast");
            });

            $("#fb-btn").mouseenter(function() {
                $(".fb-holder").fadeIn("slow");
            });

            $("#fb-btn").mouseleave(function() {
                $(".fb-holder").fadeOut("fast");
            });


            (function(d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id)) return;
                js = d.createElement(s);
                js.id = id;
                js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.12&appId=194450684644835&autoLogAppEvents=1';
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));

        });

    </script>

</body>

</html>
