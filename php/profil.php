<?php
session_start();
include('../bd/connexionDB.php');
if (!isset($_SESSION['id'])) {
    header('location: login.php'); // Ici il faut mettre la page sur lequel l'utilisateur sera redirigé.
    exit;
}
if ($_SESSION['root'] == 0) {
    $status = "client";
} elseif ($_SESSION['root'] == 1) {
    $status = "Admin";
}
$id = $_SESSION['id'];

$req_cat = $DB->query("SELECT * FROM likes INNER JOIN cars ON likes.id_cars = cars.id"); //request to select cars


?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Profil</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="icon" type="image/png" href="../src/logo.png" />
    <meta name="description" content="your user profile for the jmc performance site">


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/profil.css" media="screen" type="text/css" />
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->


    <script type="text/javascript">
        function openPage(pageUrl) {
            window.open(pageUrl);
            window.close();

        }


        /*slider*/
        $(document).ready(function() {
            var itemsMainDiv = ('.MultiCarousel');
            var itemsDiv = ('.MultiCarousel-inner');
            var itemWidth = "";

            $('.leftLst, .rightLst').click(function() {
                var condition = $(this).hasClass("leftLst");
                if (condition)
                    click(0, this);
                else
                    click(1, this)
            });

            ResCarouselSize();




            $(window).resize(function() {
                ResCarouselSize();
            });

            //this function define the size of the items
            function ResCarouselSize() {
                var incno = 0;
                var dataItems = ("data-items");
                var itemClass = ('.item');
                var id = 0;
                var btnParentSb = '';
                var itemsSplit = '';
                var sampwidth = $(itemsMainDiv).width();
                var bodyWidth = $('body').width();
                $(itemsDiv).each(function() {
                    id = id + 1;
                    var itemNumbers = $(this).find(itemClass).length;
                    btnParentSb = $(this).parent().attr(dataItems);
                    itemsSplit = btnParentSb.split(',');
                    $(this).parent().attr("id", "MultiCarousel" + id);


                    if (bodyWidth >= 1200) {
                        incno = itemsSplit[3];
                        itemWidth = sampwidth / incno;
                    } else if (bodyWidth >= 992) {
                        incno = itemsSplit[2];
                        itemWidth = sampwidth / incno;
                    } else if (bodyWidth >= 768) {
                        incno = itemsSplit[1];
                        itemWidth = sampwidth / incno;
                    } else {
                        incno = itemsSplit[0];
                        itemWidth = sampwidth / incno;
                    }
                    $(this).css({
                        'transform': 'translateX(0px)',
                        'width': itemWidth * itemNumbers
                    });
                    $(this).find(itemClass).each(function() {
                        $(this).outerWidth(itemWidth);
                    });

                    $(".leftLst").addClass("over");
                    $(".rightLst").removeClass("over");

                });
            }


            //this function used to move the items
            function ResCarousel(e, el, s) {
                var leftBtn = ('.leftLst');
                var rightBtn = ('.rightLst');
                var translateXval = '';
                var divStyle = $(el + ' ' + itemsDiv).css('transform');
                var values = divStyle.match(/-?[\d\.]+/g);
                var xds = Math.abs(values[4]);
                if (e == 0) {
                    translateXval = parseInt(xds) - parseInt(itemWidth * s);
                    $(el + ' ' + rightBtn).removeClass("over");

                    if (translateXval <= itemWidth / 2) {
                        translateXval = 0;
                        $(el + ' ' + leftBtn).addClass("over");
                    }
                } else if (e == 1) {
                    var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
                    translateXval = parseInt(xds) + parseInt(itemWidth * s);
                    $(el + ' ' + leftBtn).removeClass("over");

                    if (translateXval >= itemsCondition - itemWidth / 2) {
                        translateXval = itemsCondition;
                        $(el + ' ' + rightBtn).addClass("over");
                    }
                }
                $(el + ' ' + itemsDiv).css('transform', 'translateX(' + -translateXval + 'px)');
            }

            //It is used to get some elements from btn
            function click(ell, ee) {
                var Parent = "#" + $(ee).parent().attr("id");
                var slide = $(Parent).attr("data-slide");
                ResCarousel(ell, Parent, slide);
            }

        });
    </script>
    <html lang="en-GB">

</head>

<body style="background-color: #121615;">

    <div style="width:auto;" class="container">
        <div class="row">
            <div style="background: #28282a;" class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-4 col-xs-12 col-sm-6 col-lg-4">
                        <img alt="User" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive">


                    </div>
                    <div class="col-md-8 col-xs-12 col-sm-6 col-lg-8">
                        <div class="container">
                            <h2 style="color: white;"><?= $_SESSION['first_name']; ?> <?= $_SESSION['name']; ?></h2>
                            <p style="color: white;"><b> <?= $status ?> </b></p>


                        </div>
                        <hr>
                        <p style="color: white;"><span class="glyphicon glyphicon-user one" style="width:50px;"></span><?= $_SESSION['account_creation_date'] ?></p>
                        <p style="color: white;"><span class="glyphicon glyphicon-envelope one" style="width:50px;"></span><?= $_SESSION['mail'] ?></p>
                        <hr>
                        <img alt="home" style="width: 40px; margin-right:2%" onclick="openPage('../index.php')" src="../src/home.png">
                        <?php if ($_SESSION['root'] == 1) { ?>

                            <?php if ($_SESSION['lang'] == 'fr') { ?>

                                <a class="btn btn-secondary" name="addcar" href="addcar.php" role="button">Ajouter une voiture</a>
                                <a class="btn btn-secondary" name="addcar" href="brand.php" role="button">Ajouter une marque de voiture</a>

                            <?php }
                            if ($_SESSION['lang'] == 'en-GB') { ?>
                                <a class="btn btn-secondary" name="addcar" href="addcar.php" role="button">Add a car</a>
                                <a class="btn btn-secondary" name="addcar" href="brand.php" role="button">Add a car brand</a>


                            <?php } ?>


                        <?php }  ?>




                        <?php if ($_SESSION['lang'] == 'fr') { ?>
                            <a class="btn btn-outline-secondary" href="logout.php" role="button">Deconnexion</a>

                        <?php }
                        if ($_SESSION['lang'] == 'en-GB') { ?>
                            <a class="btn btn-outline-secondary" href="logout.php" role="button">Logout</a>

                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bricklayer" style="width: auto;height:min-content;background-color: #121615">


    </div>


    <div class="container">
        <div class="row">
            <?php if ($_SESSION['lang'] == 'en-GB') { ?>
                <h4 style="color: white;">Your favorites</h4>

            <?php }
            if ($_SESSION['lang'] == 'fr') { ?>
                <h4 style="color: white;">Vos favorites</h4>

            <?php } ?>
            <div class="MultiCarousel" data-items="1,2,3,4,5" data-slide="1" id="MultiCarousel" data-interval="1000">
                <div class="MultiCarousel-inner">
                    <?php
                    while ($data = $req_cat->fetch()) { //car display query
                    ?>
                        <!--car card-->

                        <div onclick="openPage('cars.php?id=<?php echo $data['id']; ?>&title=<?php echo $data['title']; ?>&page=profil.php')" style="background-color: #121615;" class="box card item">

                            <div class="box cardImg">
                                <?php if ($data['state'] == 1) { ?>
                                    <div class="sold">Sold</div>
                                <?php }
                                if ($data['state'] == 2) { ?>
                                    <div class="reserve">Reserve</div>
                                <?php }
                                if ($data['state'] == 0) { ?>
                                    <div style="margin-top:2%; height:15%"></div>
                                <?php } ?>
                                <img alt="<?php echo $data['title']; ?>" class="card-img-top" src="../images/<?php echo $data['picture1']; ?>">
                            </div>
                            <div class="info">
                                <h4 style="color:white"><?php echo $data['title']; ?></h4>
                                <p><span><?php echo $data['price']; ?></span> <?php if ($data['country'] == "en-GB") { ?>
                                        £ <?php } ?></span> <?php if ($data['country'] == "fr") { ?>
                                        € <?php } ?></p>
                                <button class="btn">more info</button>
                            </div>


                        </div>


                    <?php
                    }
                    ?>

                </div>
                <button class="btn leftLst">
                    < </button>
                        <button class="btn rightLst">></button>
            </div>
        </div>

    </div>

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