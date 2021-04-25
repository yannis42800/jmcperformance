<?php
session_start();
include('../bd/connexionDB.php');
if (!isset($_SESSION['id'])) {
    header('location: login.php'); // Ici il faut mettre la page sur lequel l'utilisateur sera redirigé.
    exit;
}
$firstname = $_SESSION['first_name'];
$name = $_SESSION['name'];
$email = $_SESSION['mail'];
$title = $_GET['title_car'];
/*
	********************************************************************************************
	CONFIGURATION
	********************************************************************************************
*/
// expéditeur du dormulaire. Pour des raisons de sécurité, de plus en plus d'hébergeurs imposent que ce soit une adresse sur votre hébergement/nom de domaine.
// Par exemple si vous mettez ce script sur votre site "test-site.com", mettez votre email @test-site.com comme expéditeur (par exemple contact@test-site.com)
// Si vous ne changez pas cette variable, vous risquez de ne pas recevoir de formulaire.
$email_expediteur = $email;
$nom_expediteur = $name;

// destinataire est votre adresse mail (cela peut être la même que cl'expéditeur ci-dessus). Pour envoyer à plusieurs destinataires à la fois, séparez-les par un point-virgule
$destinataire = 'info@jmcperformance.co.uk';

// copie ? (envoie une copie au visiteur)
$copie = 'non'; // 'oui' ou 'non'

if ($_SESSION['lang'] == 'fr') {
    $message_envoye = "Votre message nous est bien parvenu !";
    $message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer .";
    $message_erreur_formulaire = "Vous devez d'abord <a href=\"contact.php\">envoyer le formulaire</a>.";
    $message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreur.";
} elseif ($_SESSION['lang'] == 'en-GB') {
    $message_envoye = "Your message has reached us!";
    $message_non_envoye = "Failed to send email, please try again.";
    $message_erreur_formulaire = "You must first <a href=\"contact.php\"> submit the form </a>.";
    $message_formulaire_invalide = "Check that all the fields are filled in correctly and that the email is error-free.";
}





/*
	********************************************************************************************
	FIN DE LA CONFIGURATION
	********************************************************************************************
*/

// on teste si le formulaire a été soumis
if (isset($_POST['envoi'])) {


    function Rec($text)
    {
        $text = htmlspecialchars(trim($text), ENT_QUOTES);


        $text = nl2br($text);
        return $text;
    };

    /*
	 * Cette fonction sert à vérifier la syntaxe d'un email
	 */
    function IsEmail($email)
    {
        $value = preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $email);
        return (($value === 0) || ($value === false)) ? false : true;
    }

    // formulaire envoyé, on récupère tous les champs.
    $object   = (isset($_POST['object']))   ? Rec($_POST['object'])   : '';
    $message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';

    // On va vérifier les variables et l'email ...
    $email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré

    if (($name != '') && ($email != '') && ($object != '') && ($message != '')) {
        // les 4 variables sont remplies, on génère puis envoie le mail
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'From:' . $nom_expediteur . ' <' . $email_expediteur . '>' . "\r\n" .
            'Reply-To:' . $email . "\r\n" .
            'Content-Type: text/plain; charset="utf-8"; DelSp="Yes"; format=flowed ' . "\r\n" .
            'Content-Disposition: inline' . "\r\n" .
            'Content-Transfer-Encoding: 7bit' . " \r\n" .
            'X-Mailer:PHP/' . phpversion();

        // envoyer une copie au visiteur ?
        if ($copie == 'oui') {
            $cible = $destinataire . ';' . $email;
        } else {
            $cible = $destinataire;
        };

        // Remplacement de certains caractères spéciaux
        $caracteres_speciaux     = array('&#039;', '&#8217;', '&quot;', '<br>', '<br />', '&lt;', '&gt;', '&amp;', '…',   '&rsquo;', '&lsquo;');
        $caracteres_remplacement = array("'",      "'",        '"',      '',    '',       '<',    '>',    '&',     '...', '>>',      '<<');

        $object = html_entity_decode($object);
        $object = str_replace($caracteres_speciaux, $caracteres_remplacement, $object);

        $message = html_entity_decode($message);
        $message = str_replace($caracteres_speciaux, $caracteres_remplacement, $message);

        // Envoi du mail
        $cible = str_replace(',', ';', $cible); // antibug : j'ai vu plein de forums où ce script était mis, les gens ne font pas attention à ce détail parfois
        $num_emails = 0;
        $tmp = explode(';', $cible);
        foreach ($tmp as $email_destinataire) {
            if (mail($email_destinataire, $object, $message, $headers))
                $num_emails++;
        }

        if ((($copie == 'oui') && ($num_emails == 2)) || (($copie == 'non') && ($num_emails == 1))) {
            $er = '<p>' . $message_envoye . '</p>';
        } else {
            $er = '<p>' . $message_non_envoye . '</p>';
        };
    };
} else {
    $er = '<p>' . $message_erreur_formulaire . '</p>' . "\n";
}; // fin du if (!isset($_POST['envoi']))
?>





<!DOCTYPE html>
<html lang="$_SESSION['country']">
<meta name="viewport" content="width=device-width, initial-scale=1">
<html lang="en-GB">
<meta name="description" content="for more information Contact the jmc performance team">


<title>Contact</title>
<link rel="stylesheet" href="../css/contact.css">
<link rel="icon" type="image/png" href="../src/logo.png" />
<!--Boolstrap-->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.bundle.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>


<body style="background-color: #121615;">


    <div class="container">
        <div class=" text-center mt-5 ">
            <?php
            if ($_SESSION['lang'] == 'fr') { ?>
                <h1 style="color: white;">Écrivez-nous !</h1>
            <?php
            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                <h1 style="color: white;">Write U.S !</h1>

            <?php
            }
            ?>
        </div>
        <div class="row ">

            <div class="col-lg-7 mx-auto">
                <div class="card mt-2 mx-auto p-4 bg-light">
                    <div class="card-body bg-light">
                        <div class="container ">
                            <label style="color: red;font-size:15px"><?= $er ?></label>

                            <form method="post" id="contact-form" role="form">
                                <div class="controls">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php
                                            if ($_SESSION['lang'] == 'fr') { ?>
                                                <div class="form-group"> <label for="form_name">Prénom *</label> <input id="form_name" type="text" name="name" class="form-control" placeholder="<?php if (isset($firstname)) {
                                                                                                                                                                                                        echo $firstname;
                                                                                                                                                                                                    } else {
                                                                                                                                                                                                        echo "Entrez votre prénom s'il vous plait";
                                                                                                                                                                                                    } ?>" value="<?php if (isset($firstname)) {
                                                                                                                                                                                                                        echo $firstname;
                                                                                                                                                                                                                    }  ?>" required="required" data-error="Le prénom est requis."> </div> <?php
                                                                                                                                                                                                                                                                                        } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                                <div class="form-group"> <label for="form_name">Firstname *</label> <input id="form_name" type="text" name="name" class="form-control" placeholder="<?php if (isset($firstname)) {
                                                                                                                                                                                                                                                                                                echo $firstname;
                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                echo "Please enter your firstname";
                                                                                                                                                                                                                                                                                            } ?>" value="<?php if (isset($firstname)) {
                                                                                                                                                                                                                                                                                                                echo $firstname;
                                                                                                                                                                                                                                                                                                            }  ?>" required="required" data-error="Firstname is required."> </div>
                                            <?php
                                                                                                                                                                                                                                                                                        }
                                            ?>

                                        </div>
                                        <div class="col-md-6">

                                            <?php
                                            if ($_SESSION['lang'] == 'fr') { ?>
                                                <div class="form-group"> <label for="form_lastname">Nom de famille *</label> <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="<?php if (isset($name)) {
                                                                                                                                                                                                                        echo $name;
                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                        echo "Veuillez entrer votre nom de famille";
                                                                                                                                                                                                                    } ?>" value="<?php if (isset($name)) {
                                                                                                                                                                                                                                        echo $name;
                                                                                                                                                                                                                                    }  ?>" required="required" data-error="Le nom est obligatoire."> </div> <?php
                                                                                                                                                                                                                                                                                                        } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                                <div class="form-group"> <label for="form_lastname">Lastname *</label> <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="<?php if (isset($name)) {
                                                                                                                                                                                                                                                                                                                echo $name;
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Please enter your lastname";
                                                                                                                                                                                                                                                                                                            } ?>" value="<?php if (isset($name)) {
                                                                                                                                                                                                                                                                                                                                echo $name;
                                                                                                                                                                                                                                                                                                                            }  ?>" required="required" data-error="Lastname is required."> </div>
                                            <?php
                                                                                                                                                                                                                                                                                                        }
                                            ?>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php
                                            if ($_SESSION['lang'] == 'fr') { ?>

                                                <div class="form-group"> <label for="form_email">Email *</label> <input id="form_email" type="email" name="email" class="form-control" placeholder="<?php if (isset($email)) {
                                                                                                                                                                                                        echo $email;
                                                                                                                                                                                                    } else {
                                                                                                                                                                                                        echo "Veuillez saisir votre e-mail";
                                                                                                                                                                                                    } ?>" value="<?php if (isset($email)) {
                                                                                                                                                                                                                        echo $email;
                                                                                                                                                                                                                    }  ?>" required="required" data-error="Une adresse e-mail valide est requise."> </div> <?php
                                                                                                                                                                                                                                                                                                        } elseif ($_SESSION['lang'] == 'en-GB') { ?>

                                                <div class="form-group"> <label for="form_email">Email *</label> <input id="form_email" type="email" name="email" class="form-control" placeholder="<?php if (isset($email)) {
                                                                                                                                                                                                                                                                                                                echo $email;
                                                                                                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                                                                                                echo "Please enter your Email";
                                                                                                                                                                                                                                                                                                            } ?>" value="<?php if (isset($email)) {
                                                                                                                                                                                                                                                                                                                                echo $email;
                                                                                                                                                                                                                                                                                                                            }  ?>" required="required" data-error="Valid email is required."> </div>
                                            <?php
                                                                                                                                                                                                                                                                                                        }
                                            ?>

                                        </div>
                                        <div class="col-md-6">
                                            <?php
                                            if ($_SESSION['lang'] == 'fr') { ?>

                                                <div class="form-group"> <label for="form_email">objet</label> <input id="object" type="text" name="object" class="form-control" placeholder="<?php if (isset($title)) {
                                                                                                                                                                                                    echo $title;
                                                                                                                                                                                                } else {
                                                                                                                                                                                                    echo "Le sujet de votre message";
                                                                                                                                                                                                } ?>" value="<?php if (isset($title)) {
                                                                                                                                                                                                                    echo $title;
                                                                                                                                                                                                                }  ?>" required="required" data-error="L'objet est requis."> </div> <?php
                                                                                                                                                                                                                                                                                } elseif ($_SESSION['lang'] == 'en-GB') { ?>

                                                <div class="form-group"> <label for="form_email">object</label> <input id="object" type="text" name="object" class="form-control" placeholder="<?php if (isset($title)) {
                                                                                                                                                                                                                                                                                        echo $title;
                                                                                                                                                                                                                                                                                    } else {
                                                                                                                                                                                                                                                                                        echo "The subject of your message";
                                                                                                                                                                                                                                                                                    } ?>" value="<?php if (isset($title)) {
                                                                                                                                                                                                                                                                                                        echo $title;
                                                                                                                                                                                                                                                                                                    }  ?>" required="required" data-error="Object is required."> </div>
                                            <?php
                                                                                                                                                                                                                                                                                }
                                            ?>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php
                                            if ($_SESSION['lang'] == 'fr') { ?>

                                                <div class="form-group"> <label for="form_message">Message *</label> <textarea id="form_message" name="message" class="form-control" placeholder="Ecrivez votre message ici." rows="4" required="required" data-error="Merci de nous laisser un message."></textarea> </div>
                                            <?php
                                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>

                                                <div class="form-group"> <label for="form_message">Message *</label> <textarea id="form_message" name="message" class="form-control" placeholder="Write your message here." rows="4" required="required" data-error="Please, leave us a message."></textarea> </div>

                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <?php
                                        if ($_SESSION['lang'] == 'fr') { ?>

                                            <button type="submit" class="btn btn-dark btn-send pt-2 btn-block " name="envoi" id="btnenvoie">envoyer</button><br><br><br>
                                        <?php
                                        } elseif ($_SESSION['lang'] == 'en-GB') { ?>

                                            <button type="submit" class="btn btn-dark btn-send pt-2 btn-block " name="envoi" id="btnenvoie">to send</button><br><br><br>

                                        <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div> <!-- /.8 -->
            </div> <!-- /.row-->
        </div>
    </div>

    <div class="content-center">
        <ul>
            <li><i class="fa fa-facebook-official fa-lg"></i></li>
            <li><i class="fa fa-twitter fa-2x"></i></li>
            <li><i class="fa fa-linkedin fa-2x"></i></li>
            <li><i class="fa fa-instagram fa-2x"></i></li>
        </ul>
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