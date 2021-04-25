<?php
session_start();
include('../bd/connexionDB.php');
$lang = $_SESSION['lang'];

define('PREFIX_SALT', '');
define('SUFFIX_SALT', '');
if (isset($_SESSION['id'])) {
    header('Location: profil.php');
    exit;
}


if (!empty($_POST)) {
    extract($_POST);
    $valid = true;

    $pswd = md5(PREFIX_SALT . $pswd . SUFFIX_SALT);
    $req = $DB->query("SELECT id,name,first_name,mail,root,account_creation_date FROM membres WHERE mail = ? AND pswd = ?", array($mail, $pswd));
    $req = $req->fetch();


    if (isset($_POST['connexion'])) {
        $mail = htmlentities(strtolower(trim($mail)));
        $pswd = trim($pswd);

        if (empty($mail)) {
            $valid = false;
            if ($_SESSION['lang'] == 'fr') {
                $er_mail = "Il faut mettre une adresse mail";
            }
            if ($_SESSION['lang'] == 'en-GB') {
                $er_mail = "You must put an email address";
            }
        }
        if (empty($pswd)) {
            $valid = false;
            if ($_SESSION['lang'] == 'fr') {
                $er_pswd = "Il faut mettre un mot de passe";
            }
            if ($_SESSION['lang'] == 'en-GB') {
                $er_pswd = "You must put a password";
            }
        }

        if ($req['id'] == "") {
            $valid = false;
            if ($_SESSION['lang'] == 'fr') {
                $er_mail = "Le mail ou le mot de passe est incorrecte";
            }
            if ($_SESSION['lang'] == 'en-GB') {
                $er_pswd = "The email or password is incorrect";
            }
        }

        if ($valid) {
            $_SESSION['id'] = $req['id'];
            $_SESSION['name'] = $req['name'];
            $_SESSION['first_name'] = $req['first_name'];
            $_SESSION['mail'] = $req['mail'];
            $_SESSION['account_creation_date'] = $req['account_creation_date'];
            $_SESSION['root'] = $req['root'];

            header('Location: profil.php');
            exit;
        }
    }
}
?>




<!DOCTYPE html>
<html lang="<?php $lang ?>">

<head>
    <?php
    if ($_SESSION['lang'] == 'fr') { ?>
        <title>Connexion</title>
    <?php
    }
    if ($_SESSION['lang'] == 'en-GB') { ?>
        <title>Login</title>
    <?php
    } ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="icon" type="image/png" href="../src/logo.png" />
    <meta name="description" content="log into your user account on jmc performance">



    <!--Css Form-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

           
    <link rel="stylesheet" href="../css/login.css" />
    <script type="text/javascript">
        function openPage(pageUrl) {
            window.open(pageUrl);
        }
    </script>
    <script type="text/javascript">
        document.getElementById('email').focus();
    </script>
</head>

<body>
    <div class="card">
        <?php if ($_SESSION['lang'] == 'fr') { ?>

            <h1>Bienvenue</h1>
        <?php }
        if ($_SESSION['lang'] == 'en-GB') { ?>

            <h1>Welcome</h1>
        <?php } ?>



        <form method="post">
            <div id="email" class="form-group">
                <?php
                if (isset($er_mail)) {
                ?>
                    <label style="color: red;font-size:15px"><?= $er_mail ?>
                    </label> <?php
                            }
                                ?>
                <?php if ($_SESSION['lang'] == 'fr') { ?>

                    <div class="containerdiv">
                        <input name="mail" type="email" placeholder="Email" id="email" value="<?php if (isset($mail)) {
                                                                                                    echo $mail;
                                                                                                } ?>" required>
                        <span class="border"></span>
                    </div> <?php }
                        if ($_SESSION['lang'] == 'en-GB') { ?>

                    <div class="containerdiv">
                        <input name="mail" type="email" placeholder="E-mail" id="email" value="<?php if (isset($mail)) {
                                                                                                    echo $mail;
                                                                                                } ?>" required>
                        <span class="border"></span>
                    </div> <?php } ?>


            </div>
            <div id="pswd" class="form-group">
                <?php
                if (isset($er_pswd)) {
                ?>
                    <label style="color: red;font-size:15px"><?= $er_pswd ?></label>
                <?php
                }
                ?>


                <?php if ($_SESSION['lang'] == 'fr') { ?>

                    <div class="containerdiv">



                        <input type="password" placeholder="Mot de passe" id="pswd" name="pswd" value="<?php if (isset($pswd)) {
                                                                                                            echo $pswd;
                                                                                                        } ?>" required>
                        <span class="border"></span>
                    </div> <?php }
                        if ($_SESSION['lang'] == 'en-GB') { ?>

                    <div class="containerdiv">



                        <input type="password" placeholder="Password" id="pswd" name="pswd" value="<?php if (isset($pswd)) {
                                                                                                        echo $pswd;
                                                                                                    } ?>" required>
                        <span class="border"></span>
                    </div> <?php } ?>

            </div>

            <button type="submit" class="btn" name="connexion">Connexion</button>
            <?php if ($_SESSION['lang'] == 'fr') { ?>

                <p class="register"><a href="register.php">Pour vous inscrire, c'est Ici!</a></p>
                <p class="psw"><a href="psw.php">Mot de Passde oublié</a></p>

            <?php }
            if ($_SESSION['lang'] == 'en-GB') { ?>

                <p class="register"><a href="register.php">To register, it's here!</a></p>
                <p class="psw"><a href="psw.php">Forgot your password</a></p>


            <?php } ?>


        </form>
    </div>

</body>

</html>