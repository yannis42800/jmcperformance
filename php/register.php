<?php
session_start();
include('../bd/connexionDB.php');
define('PREFIX_SALT', '');
define('SUFFIX_SALT', '');
if (isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit;
}
// Si la variable "$_Post" contient des informations alors on les traitres
if (!empty($_POST)) {
    extract($_POST);
    $valid = true;
    // On se place sur le bon formulaire grâce au "name" de la balise "input"
    $name = htmlentities(trim($name)); // On récupère le nom
    $first_name = htmlentities(trim($first_name)); // on récupère le prénom
    $mail = htmlentities(strtolower(trim($mail))); // On récupère le mail
    $pswd = trim($pswd); // On récupère le mot de passe 
    $confpswd = trim($confpswd); //  On récupère la confirmation du mot de passe
    $term = trim($term);
    //  Vérification du nom
    if (empty($name)) {
        $valid = false;
        if ($_SESSION['lang'] == 'fr') {
            $er_name = "Le nom ne peut pas être vide";
        }
        if ($_SESSION['lang'] == 'en-GB') {
            $er_name = "name can not be empty";
        }
    }
    if ($term != "true") {
        $valid = false;
        if ($_SESSION['lang'] == 'fr') {
            $er = "Vous devez accepter les conditions d'utilisation";
        }
        if ($_SESSION['lang'] == 'en-GB') {
            $er = "You must accept the terms of use";
        }
    }
    //  Vérification du prénom
    if (empty($first_name)) {
        $valid = false;
        if ($_SESSION['lang'] == 'fr') {
            $er_first_name = "Le prenom ne peut pas être vide";
        }
        if ($_SESSION['lang'] == 'en-GB') {
            $er_first_name = "First name can not be empty";
        }
    }
    // Vérification du mail
    if (empty($mail)) {
        $valid = false;
        if ($_SESSION['lang'] == 'fr') {
            $er_mail = "Le mail ne peut pas être vide";
        }
        if ($_SESSION['lang'] == 'en-GB') {
            $er_mail = "Mail cannot be empty";
        }
        // On vérifit que le mail est dans le bon format
    } elseif (!preg_match("/^[a-z0-9\-_.]+@[a-z]+\.[a-z]{2,3}$/i", $mail)) {
        $valid = false;
        if ($_SESSION['lang'] == 'fr') {
            $er_mail = "Le mail n'est pas valide";
        }
        if ($_SESSION['lang'] == 'en-GB') {
            $er_mail = "Email is not valid";
        }
    } else {
        // On vérifit que le mail est disponible
        $req_mail = $DB->query(
            "SELECT mail FROM membres WHERE mail = ?",
            array($mail)

        );
        $req_mail = $req_mail->fetch();
        if ($req_mail['mail'] <> "") {
            $valid = false;
            if ($_SESSION['lang'] == 'fr') {
                $er_mail = "Ce mail existe déjà";
            }
            if ($_SESSION['lang'] == 'en-GB') {
                $er_mail = "This email already exists";
            }
        }
    }
    // Vérification du mot de passe
    if (empty($pswd)) {
        $valid = false;
        if ($_SESSION['lang'] == 'fr') {
            $er_pswd = "Le mot de passe ne peut pas être vide";
        }
        if ($_SESSION['lang'] == 'en-GB') {
            $er_pswd = "Password cannot be empty";
        }
    } elseif ($pswd != $confpswd) {
        $valid = false;
        if ($_SESSION['lang'] == 'fr') {
            $er_pswd = "La confirmation du mot de passe ne correspond pas";
        }
        if ($_SESSION['lang'] == 'en-GB') {
            $er_pswd = "Password confirmation does not match";
        }
    }
    // Si toutes les conditions sont remplies alors on fait le traitement
    if ($valid) {
        $pswd = md5(PREFIX_SALT . $pswd . SUFFIX_SALT);
        $account_creation_date = date('Y-m-d H:i:s');
        $DB->insert("INSERT INTO membres (name, first_name, mail, pswd, account_creation_date,root) VALUES (?, ?, ?, ?, ?,?)", array($name, $first_name, $mail, $pswd, $account_creation_date, '0'));
        header('Location: login.php');
    }
}
?>
<!DOCTYPE html>

<html>


<head>
    <?php
    if ($_SESSION['lang'] == 'fr') { ?>
        <title>Inscription</title>
    <?php
    }
    if ($_SESSION['lang'] == 'en-GB') { ?>
        <title>Registration</title>
    <?php
    } ?>


    <meta charset="utf-8">
    <html lang="en-GB">
    <meta name="description" content="Register to join our community and access all the features of the site.">
    <link rel="stylesheet" href="../css/register.css" />
    <link rel="icon" type="image/png" href="../src/logo.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">






    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <!-- Website Font style -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <!-- Google Fonts -->
    <link href='https://fonts.googleapis.com/css?family=Passion+One' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Oxygen' rel='stylesheet' type='text/css'>





    <script type="text/javascript">
        function openPage(pageUrl) {
            window.open(pageUrl);
        }
    </script>
    <script type="text/javascript">
        document.getElementById('email').focus();
    </script>
</head>

<body style="background: #201f22;">
    <div class="container main-center">
        <div class="row main">
            <div class="panel-heading">
                <div class="panel-title text-center">
                    <?php
                    if ($_SESSION['lang'] == 'fr') { ?>
                        <h1 style="color: white;">Inscription</h1>
                    <?php
                    }
                    if ($_SESSION['lang'] == 'en-GB') { ?>
                        <h1 style="color: white;">Registration</h1>
                        <?php
                    } ?> 
                        <hr />
                </div>
            </div>


            <form method="post" action="#">
                <label style="color: red;font-size:15px"><?= $er ?>
                </label>

                <div style="padding-left: 20%;" class="form-group">
                    <?php
                    if (isset($er_name)) {
                    ?>
                        <label style="color: red;font-size:15px"><?= $er_name ?>
                        </label>
                    <?php
                    }
                    ?>
                    <?php if ($_SESSION['lang'] == 'en-GB') { ?>
                        <?php
                        if (!isset($er_name)) {
                        ?>
                            <label for="name" class="cols-sm-2 control-label">Your Name</label>
                        <?php
                        }
                        ?>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" placeholder="name" name="name" value="<?php if (isset($name)) {
                                                                                                echo $name;
                                                                                            } ?>" required>
                            </div>
                        </div>
                    <?php
                    }

                    if ($_SESSION['lang'] == 'fr') { ?>
                        <?php
                        if (!isset($er_name)) {
                        ?>
                            <label for="name" class="cols-sm-2 control-label">Votre nom</label>
                        <?php
                        }
                        ?>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input type="text" placeholder="Votre nom" name="name" value="<?php if (isset($name)) {
                                                                                                    echo $name;
                                                                                                } ?>" required>
                            </div>
                        </div>
                        <?php
                    } ?> 
                </div>


                <div style="padding-left: 20%;" class="form-group">
                    <?php
                    if (isset($er_first_name)) {
                    ?>
                        <label style="color: red;font-size:15px"><?= $er_first_name ?>
                        </label> <?php
                                }
                                    ?>
                    <?php
                    if ($_SESSION['lang'] == 'fr') {
                        if (!isset($er_first_name)) {
                    ?>
                            <label for="username" class="cols-sm-2 control-label">Votre prénom</label>
                        <?php
                        }
                        ?>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                <input type="text" placeholder="Votre prénom" name="first_name" value="<?php if (isset($first_name)) {
                                                                                                            echo $first_name;
                                                                                                        } ?>" required>
                            </div>
                        </div>
                        <?php
                    }
                    if ($_SESSION['lang'] == 'en-GB') {
                        if (!isset($er_first_name)) {
                        ?>
                            <label for="username" class="cols-sm-2 control-label">Votre prénom</label>
                        <?php
                        }
                        ?>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-users fa" aria-hidden="true"></i></span>
                                <input type="text" placeholder="First name" name="first_name" value="<?php if (isset($first_name)) {
                                                                                                            echo $first_name;
                                                                                                        } ?>" required> 
                            </div>
                        </div>
                </div>

                <?php
                    } ?> 
                <div style="padding-left: 20%;" class="form-group">
                    <?php
                    if (isset($er_mail)) {
                    ?>
                        <label style="color: red;font-size:15px"><?= $er_mail ?>
                        </label> <?php
                                }
                                    ?>



                    <?php
                    if ($_SESSION['lang'] == 'fr') {
                        if (!isset($er_mail)) {
                    ?>

                            <label for="email" class="cols-sm-2 control-label">Adresse mail</label>
                        <?php
                        }
                        ?>

                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                <input type="email" placeholder="Adresse mail" name="mail" value="<?php if (isset($mail)) {
                                                                                                        echo $mail;
                                                                                                    } ?>" required>
                            </div>
                        </div>
                        <?php
                    }
                    if ($_SESSION['lang'] == 'en-GB') {
                        if (!isset($er_mail)) {
                        ?>

                            <label for="email" class="cols-sm-2 control-label">Your Email</label>
                        <?php
                        }
                        ?>

                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                <input type="email" placeholder="mail address" name="mail" value="<?php if (isset($mail)) {
                                                                                                        echo $mail;
                                                                                                    } ?>" required>
                            </div>
                        </div>

                        <?php
                    } ?> 

                </div>




                <div class="form-group">

                    <?php
                    if (isset($er_pswd)) {
                    ?>
                        <label style="color: red;font-size:15px"><?= $er_pswd ?>
                        </label> <?php
                                }
                                    ?>




                    <?php
                    if ($_SESSION['lang'] == 'fr') {
                        if (!isset($er_pswd)) {
                    ?>

                            <label for="password" class="cols-sm-2 control-label">Mot de passe</label>
                        <?php
                        }
                        ?>

                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input type="password" placeholder="Mot de passe" name="pswd" value="<?php if (isset($pswd)) {
                                                                                                            echo $pswd;
                                                                                                        } ?>" required>
                            <?php
                        }
                        if ($_SESSION['lang'] == 'en-GB') { ?>
                                <div style="padding-left: 20%;">
                                    <?php
                                    if (!isset($er_pswd)) {
                                    ?>

                                        <label for="password" class="cols-sm-2 control-label">Password</label>
                                    <?php
                                    }
                                    ?>

                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                            <input type="password" placeholder="password" name="pswd" value="<?php if (isset($pswd)) {
                                                                                                                    echo $pswd;
                                                                                                                } ?>" required>
                                        </div>
                                    </div>
                                </div>

                            <?php
                        } ?>

                            </div>

                            <?php
                            if ($_SESSION['lang'] == 'fr') { ?>
                                <div class="form-group">

                                    <label for="confirm" class="cols-sm-2 control-label">Confirmer le mot de passe</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                            <input type="password" placeholder="Confirmer le mot de passe" name="confpswd" required>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            }
                            if ($_SESSION['lang'] == 'en-GB') { ?>
                                <div class="form-group" style="padding-left: 20%;">

                                    <label for="confirm" class="cols-sm-2 control-label">Confirm Password</label>
                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                            <input type="password" placeholder="Confirm password" name="confpswd" required>
                                        </div>
                                    </div>
                                </div>

                            <?php
                            } ?>



                            <?php
                            if ($_SESSION['lang'] == 'fr') { ?>
                                <div class="form-group" style="padding-left: 40%;">


                                    <div class="cols-sm-10">
                                        <div style="text-align: center;" class="input-group">
                                            <input value="true" type="checkbox" name="term" id="term" chacked>
                                            <a href="rgpd.php">Conditions d'utilisation</a>


                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                            if ($_SESSION['lang'] == 'en-GB') { ?>
                                <div class="form-group" style="padding-left: 40%;">

                                    <div class="cols-sm-10">
                                        <div class="input-group">
                                            <input value="true" type="checkbox" name="term" id="term" chacked>
                                            <a href="rgpd.php">Terms of use</a>

                                        </div>
                                    </div>
                                </div>


                                <?php
                            } ?> 

                        </div>
                        <?php
                        if ($_SESSION['lang'] == 'fr') { ?>
                            <div class="form-group ">
                                <button style="width: 85%; color:black" type="submit" name="inscription" class="btn btn-primary btn-lg btn-block login-button">S'inscrir</button>
                            </div>
                        <?php
                        }
                        if ($_SESSION['lang'] == 'en-GB') { ?>
                            <div class="form-group " style="padding-left: 20%;">
                                <button style="width: 85%; color:black" type="submit" name="inscription" class="btn btn-primary btn-lg btn-block login-button">Register</button>
                            </div>
                        <?php
                        } ?>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>


</body>

</html>