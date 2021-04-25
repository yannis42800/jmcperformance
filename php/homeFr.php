<!--home page in French-->
<?php
session_start();
include('../bd/connexionDB.php');
$_SESSION['lang'] = 'fr'; //recording the language

$req_cat = $DB->query("SELECT * FROM cars WHERE country = 'fr' ORDER by 'ASC' LIMIT 3 "); //request to select cars
?>

<!DOCTYPE html>
<html>

<head>
    <!--Title, Logo and Description of the page for SEO-->
    <title>JMC</title>
    <link rel="icon" type="image/png" href="../src/logo.png" />
    <meta name="description" content="JMC PERFORMANCE est specialisee dans les voitures de sport allemandes et japonaises depuis 2009. Notre particularité : des voitures avec volant à droite, que nous livrons sur Lille et pour lesquelles nous fournissons les papiers necessaires pour l'obtention des plaques françaises.

            Nous avons un stock permanent de vehicules au Royaume-Uni, disponible à la vente à Londre ou pour livraion en France. Merci de regarder nos véhicules disponible et contactez nous pour plus d'informations.">

    <!--page style sheet-->
    <meta charset="utf-8">
    <html lang="en-GB">

    <link rel="stylesheet" href="../css/index.css">
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
    <!------ Include the above in your HEAD tag ---------->


    <!--Css Form-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script type="text/javascript">
        //Navigation

        function openPage(pageUrl) {
            window.open(pageUrl);
            window.close();
        }


        //Popup 
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
                <img alt="Jmcperformance" class="img" src="../src/logo.png">
            </div>
            <div class="col-8">
                <div class="row">
                    <ul class="ul1">
                        <li><a href="../index.php">
                                <div class="dividernav"></div>
                                Accueil
                            </a></li>
                        <li><a href="gallery.php">
                                <div class="dividernav"></div>
                                Stock
                            </a></li>
                        <li><a href="login.php">
                                <div class="dividernav"></div>
                                Connexion
                            </a></li>
                        <li><a href="about.php">
                                <div class="dividernav"></div>
                                À Propos
                            </a></li>
                        <li><a href="contact.php">
                                <div class="dividernav"></div>
                                Contact
                            </a></li>

                    </ul>

                    <ul class="ulcontact">
                        <li style="font-size:x-large; margin-right:1%; padding-bottom:0;  padding-top:1% ;margin-top:0%; margin-bottom: 0;"> Appelez-Nous: <a style="color: #d9524a; margin-left:2%; padding-bottom:0;  padding-top:0" href="#"> 07885 910 592</a>
                        </li>

                        <li style="font-size:x-large; margin-right:1%; padding-bottom:0;  padding-top:0%;"> Écrivez-nous: <a style="color: #d9524a; margin-left:2%; padding-bottom:0;  padding-top:0" href="contact.php"> info@jmcperformance.co.uk</a>

                        </li>

                    </ul>

                    <ul class="ul2">
                        <li>
                            <div class="dividernav2"></div>
                            <a href="gallery.php">
                                Stock
                            </a>
                        </li>
                        <li>
                            <div class="dividernav2"></div>
                            <a href="#">
                                Options de financement </a>
                        </li>
                        <li>
                            <div class="dividernav2"></div>
                            <a href="#">
                                Garantie </a>
                        </li>


                    </ul>
                </div>

            </div>
        </div>
    </nav>
    <section class="section1" id="section1">


        <img alt="BMW M3" class="imgback" id="imgback" src="../src/imgfond2.jpg">


    </section>


    <!--Presentation part-->

    <div>
        <h1 lang="fr" style="font-family: 'Comic Sans MS', arial;text-align: center;color:white;background-color: #121615" onclick="openPage('about.php')"> QUI SOMMES NOUS ?</h1>

        <p style="text-align: center;background-color: #121615">Basé au Royaume Uni et avec plus de 10 ans d'activité, Spécialiste de l'import RHD, JMC vous propose son stock de véhicules a Londres ainsi que recherches personnalisée...</p>
        <p style="text-align: end; margin-right:2%" onclick="openPage('about.php')">En savoir plus</p>

    </div>
    <div class="col-lg-12">

    </div>



    <!--Popup-->
    <div class="popup_content_wrap" id="popup_content_wrap">
        <div class="popup_content" id="popup_content">
            <center>
                <h1 class="poptitle"> Service Indisponible..</h1>
                <p>Suite au Brexit les imports en France sont temporairement suspendus.
                </p>

            </center>
            <a class="btn btn-dark next">
                <h1 style="padding-top:10%">À très vite</h1>
            </a>





        </div>
    </div>



    <div>
        <!--profile button-->
        <img alt=" login" href="../php/login.php" onclick="openPage('../php/login.php')" id="loginicon" class="material-icons" src="../src/account_circle.svg"></img>
        <!--horizontal scroll list-->
        <div class="bricklayer" style="width: auto;height:min-content;">

            <?php
            while ($data = $req_cat->fetch()) { //car display query
            ?>



                <!--car card-->



                <div onclick="openPage('cars.php?id=<?php echo $data['id']; ?>&title=<?php echo $data['title']; ?>&page=homeFr.php')" class="box card" style="background-color: #121615">

                    <div class="box cardImg">
                        <?php if ($data['state'] == 1) { ?>
                            <div class="reserve">Vendu</div>
                        <?php }
                        if ($data['state'] == 2) { ?>
                            <div class="reserve">Reservé</div>
                        <?php }
                        if ($data['state'] == 0) { ?>
                            <div class="nosold" style="margin-top:2%; height:15%">Disponible</div>
                        <?php } ?>
                        <img alt="<?php echo $data['title']; ?>" class="card-img-top" src="../images/<?php echo $data['picture1']; ?>">
                    </div>
                    <div class="info">
                        <h4 style="color:white"><?php echo $data['title']; ?></h4>
                        <p>€<span><?php echo $data['price']; ?></span> </p>
                        <button class="btn ">Plus d'info</button>
                    </div>


                </div>


            <?php
            }
            ?>

        </div>
        <!--gallery button -->
        <p style="margin-bottom:10%; " class="seen" onclick="openPage('gallery.php')">Voir la liste des stocks</p>

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
                                <p class="card-text">Bienvenue sur Jmc Performance. Vous trouverez tout ce dont vous avez besoin ici. Suivez-nous aussi sur les réseaux</p>
                                <div class="social mt-2 mb-3"> <i onclick="openPage('https://www.facebook.com/gukimport/')" class=" fa fa-facebook-official fa-lg"></i> <i onclick="openPage('https://www.instagram.com/jmcperformance/')" class="fa fa-instagram fa-lg"></i> <i onclick="openPage('mailto:jezg60@hotmail.com')" class=" fa fa-envelope fa-lg"></i> </div>
                            </div>
                        </div>
                        <div class="col-md-2 col-sm-1 col-xs-1 mb-2"></div>
                        <div class="col-md-2 col-sm-4 col-xs-4">
                            <h5 class="heading">Menu</h5>
                            <ul>
                                <li onclick="openPage('gallery.php')">Voitures</li>
                                <li onclick="openPage('contact.php')">Contact</li>
                                <li onclick="openPage('connexion.php')">Login</li>
                                <li onclick="openPage('register.php')">S'inscrire</li>
                            </ul>
                        </div>
                        <div class=" col-md-2 col-sm-4 col-xs-4">
                            <h5 class="heading">Site Web</h5>
                            <ul class="card-text">
                                <li onclick="openPage('https://www.instagram.com/lecyclone.dev/')">Développeur</li>
                                <li onclick="openPage('https://icones8.fr')">Icon</li>
                                <li onclick="openPage('https://getbootstrap.com/')">Boolstrap</li>
                                <li onclick="openPage('https://www.ovh.com/')">Hébergeur</li>
                            </ul>
                        </div>
                        <div class="col-md-2 col-sm-4 col-xs-4">
                            <h5 class="heading">Entreprise</h5>
                            <ul class="card-text">
                                <li onclick="openPage('about.php')">À propos</li>
                                <li onclick="openPage('contact.php')">Contact</li>
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
                                <div onclick="openPage('rgpd.php#termofuse')">Terms of Use</div>
                                <div onclick="openPage('rgpd.php#privacypolicy')">Privacy Policy</div>
                                <div onclick="openPage('rgpd.php#cookiepolicy')">Cookie Policy</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
</body>




</html>