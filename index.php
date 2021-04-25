<!--home page in english-->
<?php
session_start();
include('bd/connexionDB.php');


//Message cookie
if (isset($_COOKIE['accept_cookie'])) {
    $showcookie = false;
} else {
    $showcookie = true;
}






$req_cat = $DB->query("SELECT * FROM cars WHERE country = 'en-GB' ORDER by 'ASC' LIMIT 3 "); //request to select cars
$_SESSION['lang'] = 'en-GB'; //recording in the default language session (English)
?>
<!DOCTYPE html>
<html>

<head>
    <!--Title, Logo and Description of the page for SEO-->
    <title>JMC Performance</title>
    <link rel="icon" type="image/png" href="src/logo.png" />
    <meta name="description" content="Based in London, JMC Performance is a sports car specialist offering a constant stock of hand-picked quality right hand drive models. With more than 10 years' experience in exporting vehicles to France and the E.U., we are also able to provide a specific research /purchase & delivery service if you are looking for something unique..">
    <!--page style sheet-->
    <html lang="en-GB">

    <meta charset="utf-8">
    <link rel="stylesheet" href="css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3pro.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
    <!--Import Google Icon Font-->
    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css" media="screen,projection" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bricklayer/0.4.2/bricklayer.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/bricklayer/0.4.2/bricklayer.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <!---------------------------------bollstrap------------------------>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/profil.css" media="screen" type="text/css" />
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ fontstyle ---------->
    <link href="https://fr.allfont.net/allfont.css?fonts=comic-sans-ms" rel="stylesheet" type="text/css" />
    <!--Navbar-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script type="text/javascript">
        //Navigation
        function openPage(pageUrl) {
            window.open(pageUrl);
            window.close();
        };

        function cookieok() {
            $showcookie = false;
            if ($showcookie == false) {
                document.getElementById('cookie_alert').style.display = "none";

            } else {
                document.getElementById('cookie_alert').removeAttribute('style');
            }

        };
        //(back-end) Popup Choice of language
        function popup_content(hideOrshow) {
            if (hideOrshow == 'en-GB') document.getElementById('popup_content_wrap').style.display = "none"
            <?php $_SESSION['lang'] = 'en-GB' ?>;
            if (hideOrshow == 'fr') openPage('php/homeFr.php?lang=fr');
            if (hideOrshow != 'en-GB' && hideOrshow != 'fr') document.getElementById('popup_content_wrap').removeAttribute('style');


        };
        window.onload = function() {
            setTimeout(function() {
                popup_content('show');
            }, 100);
        };




        //NavBar
        $(document).ready(function() {
            $(".menu-icon").on("click", function() {
                $("nav ul").toggleClass("showing");
            });
        });

        // Scrolling Effect

        $(window).on("scroll", function() {
            if ($(window).scrollTop()) {
                $('nav').addClass('black');
            } else {
                $('nav').removeClass('black');
            }
        })



        //NavBar
        $(document).ready(function() {
            $(".menu-icon").on("click", function() {
                $("nav div div .ul2").toggleClass("showing");

            });
        });

        // Scrolling Effect

        $(window).on("scroll", function() {
            if ($(window).scrollTop()) {
                $('nav').addClass('black');
            } else {
                $('nav').removeClass('black');
            }
        })
    </script>



</head>

<body style="background-color: #121615">

    <!--title section-->
    <nav>
        <div class="menu-icon">
            <i class="fa fa-bars fa-2x"></i>
        </div>

        <div class="row">
            <div class="col-3">
                <img alt="JmcPerformance" class="img" src="src/logo.png">
            </div>
            <div class="col-8">
                <div class="row">
                    <ul class="ul1">
                        <li><a href="index.php">
                                <div class="dividernav"></div>
                                Home
                            </a></li>
                        <li><a href="php/gallery.php">
                                <div class="dividernav"></div>
                                Stock
                            </a></li>
                        <li><a href="php/login.php">
                                <div class="dividernav"></div>
                                Login
                            </a></li>
                        <li><a href="php/about.php">
                                <div class="dividernav"></div>
                                About
                            </a></li>
                        <li><a href="php/contact.php">
                                <div class="dividernav"></div>
                                Contact
                            </a></li>

                    </ul>

                    <ul class="ulcontact">
                        <li class="callul"> CALL US: <a style="color: #d9524a; margin-left:2%; padding-bottom:0;  padding-top:0" href=" #"> 07885 910 592</a>
                        </li>

                        <li class="writeul"> WRITE US: <a style="color: #d9524a; margin-left:2%; padding-bottom:0;  padding-top:0" href="php/contact.php"> info@jmcperformance.co.uk</a>

                        </li>

                    </ul>

                    <ul class="ul2">
                        <li>
                            <div class="dividernav2"></div>
                            <a href="php/gallery.php">
                                Stock-list
                            </a>
                        </li>
                        <li>
                            <div class="dividernav2"></div>
                            <a href="#">
                                Finance Options
                            </a>
                        </li>
                        <li>
                            <div class="dividernav2"></div>
                            <a href="#">
                                Warrenty Options </a>
                        </li>


                    </ul>
                </div>

            </div>
        </div>
    </nav>
    <section class="section1" id="section1">


        <img alt="BMW M3" class="imgback" id="imgback" src="src/imgfond2.jpg">


    </section>




    <!--Presentation part-->
    <div style="background-color: #121615">
        <h1 class="divresentation" style="font-family: 'Comic Sans MS', arial; text-align: center;background-color: #121615;color:white" onclick="openPage('php/about.php')"> WHO ARE WE ?</h1>
        <p style="text-align: center;background-color: #121615">Based in London, JMC Performance is a sports car specialist offering a constant stock of hand-picked quality right hand drive models. With more than 10 years' experience in exporting vehicles to France and the E.U., we are also able to provide a specific research /purchase & delivery service if you are looking for something unique..</p>
        <p style="text-align: end; margin-right:2%" onclick="openPage('php/about.php')">Find Out More</p>

    </div>



    <div class="col-lg-12">
        <!--(Front-end) Popup Choice of language-->
    </div>



    <!--Popup-->
    <div class="popup_content_wrap" id="popup_content_wrap">
        <div class="popup_content" id="popup_content">
            <center>
                <h1 class="poptitle"> Where are you from ? D'où venez-vous?</h1>
                <hr>
                <hr>
                <img alt="England" class="ukflag" src="src/ang.png" value="en-GB" onClick="popup_content('en-GB')" />
                <img alt="France" class="frenshflag" src="src/fr.png" value="fr" onClick="popup_content('fr')" />

            </center>
        </div>
    </div>


    <!--profile button-->
    <img href="php/login.php" alt="login" onclick="openPage('php/login.php')" id="loginicon" class="material-icons" src="src/account_circle.svg"></img>


    <!--horizontal scroll list-->
    <div class="bricklayer" style="width: auto;height:min-content;background-color: #121615">

        <?php
        while ($data = $req_cat->fetch()) { //car display query
        ?>



            <!--car card-->



            <div onclick="openPage('php/cars.php?id=<?php echo $data['id']; ?>&title=<?php echo $data['title'];  ?>&page=index.php')" style="background-color: #121615;" class="box card">

                <div class="box cardImg">
                    <?php if ($data['state'] == 1) { ?>
                        <div class="reserve">Sold</div>
                    <?php }
                    if ($data['state'] == 2) { ?>
                        <div class="reserve">Reserve</div>
                    <?php }
                    if ($data['state'] == 0) { ?>
                        <div class="nosold" style="margin-top:2%; height:15%">Available</div>
                    <?php } ?>
                    <img alt="<?php echo $data['title'];  ?>" class="card-img-top" src="images/<?php echo $data['picture1']; ?>">
                </div>
                <div class="info">
                    <h4 style="color:white"><?php echo $data['title']; ?></h4>
                    <p>£<span><?php echo $data['price']; ?></span> </p>
                    <button class="btn">more info</button>
                </div>


            </div>


        <?php
        }
        ?>

    </div>
    <!--gallery button -->
    <p style="margin-bottom:10%; " class="seen" onclick="openPage('php/gallery.php')">See Entire Stock List</p>

    <!--Message Cookie-->
    <?php if ($showcookie) { ?>
        <div style="text-align: center;" id="cookie_alert" class="cookie-alert">
            By continuing to use this site, you accept the terms of use and the privacy policy. You also agree to the potential use of cookies relating to the use of the site. For more information consult legal notice and cookie.<br />
            <div style="width: 100%; text-align:center;">
                <button onclick="cookieok()">OK</button>
                <button onclick="openPage('php/rgpd.php')">legal notice and cookie </button>
            </div>

        </div>
    <?php } ?>

    <!--Footer-->
    <footer>


        <div class="divider2"> </div>
        <div class="container-fluid">

            <div class="cardfooter">

                <div class="row mb-4 ">
                    <div class="col-md-4 col-sm-11 col-xs-11">
                        <div class="footer-text pull-left">
                            <div class="d-flex">
                                <h1 class="font-weight-bold mr-2 px-3" style="color:#16151a; background-color:#d9524a"> JMC </h1>
                                <h1 style="color: #d9524a">Performance</h1>
                            </div>
                            <p class="card-text">Welcome to Jmc Performance. You will find everything you need here. Follow us also on the networks</p>
                            <div class="social mt-2 mb-3"> <i onclick="openPage('https://www.facebook.com/gukimport/')" class=" fa fa-facebook-official fa-lg"></i> <i onclick="openPage('https://www.instagram.com/jmcperformance/')" class="fa fa-instagram fa-lg"></i> <i onclick="openPage('mailto:jezg60@hotmail.com')" class=" fa fa-envelope fa-lg"></i> </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-1 col-xs-1 mb-2"></div>
                    <div class="col-md-2 col-sm-4 col-xs-4">
                        <h5 class="heading">Menu</h5>
                        <ul>
                            <li onclick="openPage('php/gallery.php')">Cars</li>
                            <li onclick="openPage('php/contact.php')">Contact</li>
                            <li onclick="openPage('php/login.php')">Login</li>
                            <li onclick="openPage('php/register.php')">Register</li>
                        </ul>
                    </div>
                    <div class=" col-md-2 col-sm-4 col-xs-4">
                        <h5 class="heading">Website</h5>
                        <ul class="card-text">
                            <li onclick="openPage('https://www.instagram.com/lecyclone.dev/')">Developer</li>
                            <li onclick="openPage('https://icones8.fr')">Icon</li>
                            <li onclick="openPage('https://getbootstrap.com/')">Boolstrap</li>
                            <li onclick="openPage('https://www.ovh.com/')">Host</li>
                        </ul>
                    </div>
                    <div class="col-md-2 col-sm-4 col-xs-4">
                        <h5 class="heading">Company</h5>
                        <ul class="card-text">
                            <li onclick="openPage('php/about.php')">About Us</li>
                            <li onclick="openPage('php/contact.php')">Contact</li>
                        </ul>
                    </div>
                </div>
                <div class="divider mb-4"> </div>
                <div class="row" style="font-size:10px;">
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="pull-left">
                            <p><i class="fa fa-copyright"></i>JmcPerformance 2021. All Rights Reserved </p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-6">
                        <div class="pull-right mr-4 d-flex policy">
                            <div onclick="openPage('php/rgpd.php#termofuse')">Terms of Use</div>
                            <div onclick="openPage('php/rgpd.php#privacypolicy')">Privacy Policy</div>
                            <div onclick="openPage('php/rgpd.php#cookiepolicy')">Cookie Policy</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

</body>




</html>