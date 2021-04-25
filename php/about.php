<?php
session_start();
include('../bd/connexionDB.php');
$nameuser = $_SESSION['first_name'];

$numveropi = $DB->query("SELECT AVG(rating) FROM rating  GROUP BY id");
$numveropi->execute();
$numveropi = $numveropi->fetchColumn();
$numveropi = round($numveropi, 0.5, PHP_ROUND_HALF_UP);


$carsold = $DB->query("SELECT COUNT(*) FROM cars WHERE state = 1");
$carsold->execute();
$carsold = $carsold->fetchColumn();
$carsold = round($carsold);





$numberuser = $DB->query("SELECT COUNT(*) FROM membres");
$numberuser->execute();
$numberuser = $numberuser->fetchColumn();


$req_comment = $DB->query("SELECT * FROM rating  ORDER by 'ASC' LIMIT 5 "); //request to select cars



if (isset($_POST['comments'])) {
    extract($_POST);
    $valid = true;

    $comment = $_POST['comment'];
    $rating = $_POST['rating'];
    $name = $_POST['name'];




    if (empty($name)) {
        $valid = false;
        if ($_SESSION['lang'] == 'fr') {
            $er = "Il faut mettre votre nom";
        }
        if ($_SESSION['lang'] == 'en-GB') {
            $er = "You must put your name";
        }
    } elseif ($valid) {

        $date = date('Y-m-d H:i:s');

        $sql = $DB->query("INSERT INTO rating (rating,name,date,comment) VALUES ('$rating','$name','$date','$comment')");
    }
}


?>

<!DOCTYPE html>
<html lang="$_SESSION['country']">
<meta name="description" content="Based in London, JMC Performance is a sports car specialist offering a constant stock of hand-picked quality right hand drive models. With more than 10 years' experience in exporting vehicles to France and the E.U., we are also able to provide a specific research /purchase & delivery service if you are looking for something unique..">

<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
if ($_SESSION['lang'] == 'fr') { ?>
    <title>à propos</title>

<?php
} elseif ($_SESSION['lang'] == 'en-GB') { ?>
    <title>About</title>



<?php
} ?>

<link rel="stylesheet" href="../css/about.css">
<link rel="icon" type="image/png" href="../src/logo.png" />
<!--Boolstrap-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css'>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>
<link rel="stylesheet" href="../css/profil.css" media="screen" type="text/css" />
<link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css'>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js'></script>
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<!--Card number-->

<body style="background-color: #121615;">


    <div class="wrapper">
        <div class="profile">
            <div class="overlay">
                <div class="about d-flex flex-column">
                    <?php
                    if ($_SESSION['lang'] == 'fr') { ?>
                        <h4>Qui sommes nous?</h4> <span>Basé à Londres,Jmc Performance a été créé en 2009 par Jeremy Cox. Passionné de voitures de sport comme BMW, Nissan 370Z ...</span>

                    <?php
                    } elseif ($_SESSION['lang'] == 'en-GB') { ?>

                        <h4>Who are we ?</h4> <span>London based Jmc Performance was premiered in 2009 by Jeremy Cox. passionate about sports cars like BMW, Nissan 370Z... </span>


                    <?php
                    } ?>
                </div>

            </div>
        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-lg-4 d-flex justify-content-center">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-img pt-2 pb-3"> <img src="../src/people.png" alt="people"> </div>
                        <div class="name h1"><?php echo $numberuser ?></div>
                        <?php
                        if ($_SESSION['lang'] == 'fr') { ?>
                            <div class="testimonial"> Vous êtes <?php echo $numberuser ?> à utiliser le site ! Merci! </div>

                        <?php
                        } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                            <div class="testimonial"> you are <?php echo $numberuser ?> to use the site! Thank you ! </div>



                        <?php
                        } ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex justify-content-center">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-img pt-2 pb-3"> <img src="../src/rating.png" alt="rating"> </div>
                        <div class="name h1"><?php echo $numveropi ?></div>
                        <?php
                        if ($_SESSION['lang'] == 'fr') { ?>
                            <div class="testimonial"> Vous êtes nombreux à donner votre avis. Et vous nous avez donné la note de <?php echo $numveropi ?>/5.</div>

                        <?php
                        } elseif ($_SESSION['lang'] == 'en-GB') { ?>

                            <div class="testimonial"> Many of you are giving your opinion. And you gave us the rating of <?php echo $numveropi ?>/5.</div>


                        <?php
                        } ?>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 d-flex justify-content-center">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="card-img pt-2 pb-3"> <img alt="car sold" src="../src/roue.png" /> </div>
                        <div class="name h1"><?php echo $carsold ?> </div>
                        <?php
                        if ($_SESSION['lang'] == 'fr') { ?>
                            <div class="testimonial"> <?php echo $carsold ?> est le nombre de voitures vendues sur le site</div>

                        <?php
                        } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                            <div class="testimonial"> <?php echo $carsold ?> is the number of cars sold on the site</div>



                        <?php
                        } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="container justify-content-center mt-5 border-left border-right">
        <?php
        if ($_SESSION['lang'] == 'fr') { ?>
            <h4 style="color: white;">Dites-nous tout:</h4>
            <div class="d-flex justify-content-center pt-3 pb-2"> <button type="button" class="addtxt" data-toggle="modal" data-target="#form"> Commenter </button>
            </div>
        <?php
        } elseif ($_SESSION['lang'] == 'en-GB') { ?>
            <h4 style="color: white;">Tell us everything :</h4>
            <div class="d-flex justify-content-center pt-3 pb-2"> <button type="button" class="addtxt" data-toggle="modal" data-target="#form"> Comment </button>
            </div>


        <?php
        } ?>


        <?php
        while ($data = $req_comment->fetch()) { //car display query
        ?>

            <div class="d-flex justify-content-center py-2">
                <div class="second py-2 px-2"> <img alt="comment" src="https://i.imgur.com/AgAC1Is.jpg" width="18"><span class="text2"><?php echo $data['name']; ?></span>
                    <div class="d-flex justify-content-between py-1 pt-2">
                        <div><span class="text1"><?php echo $data['comment']; ?></span></div>
                        <div><span class="thumbup"><i class="fa fa-thumbs-o-up"></i></span><span class="text4"><?php echo $data['rating']; ?>/5</span></div>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="text-right cross"> <i class="fa fa-times mr-2"></i> </div>
                <div class="card-body text-center"> <img alt="comment" src=" https://i.imgur.com/d2dKtI7.png" height="100" width="100">
                    <div class="comment-box text-center">
                        <?php
                        if ($_SESSION['lang'] == 'fr') { ?>
                            <h4>Ajouter un commentaire</h4>

                        <?php
                        } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                            <h4>Add a comment</h4>


                        <?php
                        } ?>
                        <form enctype="multipart/form-data" action="" method="post">
                            <?php
                            if (isset($er)) {
                            ?>
                                <div style="color: red;font-size:30px"><?= $er ?></div>
                            <?php
                            }
                            ?>
                            <div class="rating"> <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label> <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label> </div>
                            <?php
                            if ($_SESSION['lang'] == 'fr') { ?>
                                <textarea name="name" class="form-control" placeholder="<?php if (isset($nameuser)) {
                                                                                            echo $nameuser;
                                                                                        } else {
                                                                                            echo "Veuillez entrer votre Prénom";
                                                                                        } ?>" value="<?php if (isset($nameuser)) {
                                                                                                            echo $nameuser;
                                                                                                        }  ?>" rows="1"></textarea>
                                <div class="comment-area"> <textarea name="comment" class="form-control" placeholder="quelle est votre opinion?" rows="4"></textarea> </div>
                                <div class="text-center mt-4"> <input class="btn" type="submit" name="comments">
                                </div>
                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                <textarea name="name" class="form-control" placeholder="<?php if (isset($nameuser)) {
                                                                                            echo $nameuser;
                                                                                        } else {
                                                                                            echo "Please enter your Firstname";
                                                                                        } ?>" value="<?php if (isset($nameuser)) {
                                                                                                            echo $nameuser;
                                                                                                        }  ?>" rows="1"></textarea>
                                <div class="comment-area"> <textarea name="comment" class="form-control" placeholder="what is your view?" rows="4"></textarea> </div>
                                <div class="text-center mt-4"> <input class="btn" type="submit" name="comments">
                                </div>
                            <?php
                            } ?>



                        </form>
                    </div>
                </div>
            </div>
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