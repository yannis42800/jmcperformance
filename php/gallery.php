<?php
session_start();
include('../bd/connexionDB.php');
if ($_SESSION['lang'] == 'fr') {
    $req_cat = $DB->query("SELECT * FROM cars WHERE country = 'fr' ORDER by 'ASC'");
} elseif ($_SESSION['lang'] == 'en-GB') {
    $req_cat = $DB->query("SELECT * FROM cars WHERE country = 'en-GB' ORDER by 'ASC'");
}
?>

<!DOCTYPE html>
<html>

<head>
    <?php
    if ($_SESSION['lang'] == 'fr') { ?>
        <title>Vitrine</title>
    <?php
    } elseif ($_SESSION['lang'] == 'en-GB') { ?>
        <title>Showcase</title>

    <?php
    }
    ?>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/gallery.css">
    <link rel="icon" type="image/png" href="../src/logo.png" />
    <html lang="en-GB">
    <meta name="description" content="Our car stock available for France and England">



    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>


    <script type="text/javascript">
        function openPage(pageUrl) {
            window.open(pageUrl);
            window.close();

        }
        $(document).ready(function() {
            //FANCYBOX
            //https://github.com/fancyapps/fancyBox
            $(".fancybox").fancybox({
                openEffect: "none",
                closeEffect: "none"
            });
        });

        $(document).ready(function() {

            $(".filter-button").click(function() {
                var value = $(this).attr('data-filter');

                if (value == "all") {
                    //$('.filter').removeClass('hidden');
                    $('.filter').show('3000');
                } else {
                    //            $('.filter[filter-item="'+value+'"]').removeClass('hidden');
                    //            $(".filter").not('.filter[filter-item="'+value+'"]').addClass('hidden');
                    $(".filter").not('.' + value).hide('3000');
                    $('.filter').filter('.' + value).show('3000');

                }
            });

            if ($(".filter-button").removeClass("active")) {
                $(this).removeClass("active");
            }
            $(this).addClass("active");

        });
    </script>


</head>

<body style="background-color: #121615;">
    <div class="container mt-3">
        <div class="row">


            <div align="center">
                <?php
                if ($_SESSION['lang'] == 'fr') { ?>
                    <button class="btn btn-default filter-button" data-filter="all">Toutes</button>
                    <button class="btn btn-default filter-button" data-filter="nosold">Non Vendu</button>
                    <button class="btn btn-default filter-button" data-filter="sold">Vendu</button>
                <?php
                } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                    <button class="btn btn-default filter-button" data-filter="all">All</button>
                    <button class="btn btn-default filter-button" data-filter="nosold">No Sold</button>
                    <button class="btn btn-default filter-button" data-filter="sold">Sold</button>

                <?php
                }
                ?>

            </div>
            <br />

            <?php
            while ($data = $req_cat->fetch()) { ?>

                <div class="col-lg-3 col-md-6 offset-md-0 offset-sm-1 col-sm-10 offset-sm-1 my-lg-0 my-2">

                    <div class="filter nosold" data-status="nosold">
                        <?php if ($data['state'] == 0) { ?>

                            <div onclick="openPage('cars.php?id=<?php echo $data['id']; ?>&title=<?php echo $data['title']; ?>&page=gallery.php')" class="box card" style="background-color: #121615">
                                <div class="box cardImg">
                                    <img alt="<?php echo $data['title']; ?>" class="card-img-top" src="../images/<?php echo $data['picture1']; ?>">
                                </div>
                                <div class="info">
                                    <h3 style="color: white;"><?php echo $data['title']; ?></h3>
                                    <?php
                                    if ($_SESSION['lang'] == 'fr') { ?>
                                        <p>€ <span><?php echo $data['price']; ?></span> </p>
                                        <button onclick="openPage('cars.php?id=<?php echo $data['id']; ?>&title=<?php echo $data['title']; ?>')" class="btn">Plus d'info</button>
                                    <?php
                                    } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                        <p>£ <span><?php echo $data['price']; ?></span> </p>
                                        <button onclick="openPage('cars.php?id=<?php echo $data['id']; ?>&title=<?php echo $data['title']; ?>')" class="btn">More info</button>

                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>


                        <?php } ?>
                    </div>



                    <div class=" filter sold" data-status="sold">
                        <?php if ($data['state'] == 1 || $data['state'] == 2) { ?>

                            <div onclick="openPage('cars.php?id=<?php echo $data['id']; ?>&title=<?php echo $data['title']; ?>&page=gallery.php')" class="box card" style="background-color: #121615">
                                <div class="box cardImg">
                                    <img alt="<?php echo $data['title']; ?>" class="card-img-top" src="../images/<?php echo $data['picture1']; ?>">
                                </div>
                                <div class="info">
                                    <h3 style="color: white;"><?php echo $data['title']; ?></h3>
                                    <?php
                                    if ($_SESSION['lang'] == 'fr') { ?>
                                        <p>€ <span><?php echo $data['price']; ?></span> </p>

                                        <button onclick="openPage('cars.php?id=<?php echo $data['id']; ?>&title=<?php echo $data['title']; ?>')" class="btn">Plus d'info</button>
                                    <?php
                                    } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                        <p> £ <span><?php echo $data['price']; ?></span></p>

                                        <button onclick="openPage('cars.php?id=<?php echo $data['id']; ?>&title=<?php echo $data['title']; ?>')" class="btn">More info</button>

                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                        <?php } ?>
                    </div>
                </div>

            <?php
            }


            ?>







        </div>


    </div>


    <!--footer-->
    <?php
    if ($_SESSION['lang'] == 'fr') {
    ?>

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
                                <li onclick="openPage('../index.php')">Accueil</li>
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
    <?php
    } elseif ($_SESSION['lang'] == 'en-GB') {

    ?>
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
                                <li onclick="openPage('../index.php')">Home</li>
                                <li onclick="openPage('contact.php')">Contact</li>
                                <li onclick="openPage('login.php')">Login</li>
                                <li onclick="openPage('register.php')">Register</li>
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
                                <li onclick="openPage('about.php')">About Us</li>
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

    <?php }
    ?>
</body>




</html>