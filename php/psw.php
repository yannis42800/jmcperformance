<?php
session_start();
include('../bd/connexionDB.php');
define('PREFIX_SALT', '');
define('SUFFIX_SALT', '');
if (isset($_SESSION['id'])) {
    header('Location: ../index.php');
    exit;
}
function genererChaineAleatoire($longueur = 10)
{
    $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $longueurMax = strlen($caracteres);
    $chaineAleatoire = '';
    for ($i = 0; $i < $longueur; $i++) {
        $chaineAleatoire .= $caracteres[rand(0, $longueurMax - 1)];
    }
    return $chaineAleatoire;
}
if (!empty($_POST)) {
    extract($_POST);
    $valid = true;

    if (isset($_POST['oublie'])) {
        $mail = htmlentities(strtolower(trim($mail)));

        if (empty($mail)) {
            $valid = false;
            $er_mail = "You have to put an email";
        }
        $req_mail = $DB->query(
            "SELECT mail FROM membres WHERE mail = ?",
            array($mail)

        );
        $req_mail = $req_mail->fetch();
        if (!$req_mail['mail'] <> "") {
            $valid = false;
            if ($_SESSION['lang'] == 'fr') {
                $er_mail = "Ce mail n'appartient à aucun utilisateur";
            }
            if ($_SESSION['lang'] == 'en-GB') {
                $er_mail = "This email does not belong to any user";
            }
        }
        if ($valid) {

            $verification_mail = $DB->query(
                "SELECT id,name,first_name,mail,root,account_creation_date FROM membres WHERE mail = ?",
                array($mail)
            );
            $verification_mail = $verification_mail->fetch();

            if (isset($verification_mail['mail'])) {
                $new_pass = genererChaineAleatoire(20);
                $new_pass_crypt = md5(PREFIX_SALT . $new_pass . SUFFIX_SALT);



                $objet = 'Nouveau mot de passe';
                $to = $verification_mail['mail'];
                $header = "From: JMC Performance <no-reply@jmcperformance.co.uk>\n"; //<no-reply@jmcperformance.co.uk>
                $header .= "Reply-To: " . $to . "\n";
                $header .= "MIME-version: 1.0\n";
                $header .= "Content-type: text/html; charset=utf-8\n";
                $header .= "Content-Transfer-Encoding: 8bit";

                $contenu =
                    "<html>" .
                    "<body>" .
                    "<p style='font-size: 18px'><b>Hello Miss, Sir  " . $verification_mail['name'] . "</b>,</p><br/>" .
                    "<p style='text-align: justify'><i><b>Here is your new password : </b></i>" . $new_pass . " <b>don't give it to anyone</b></p><br/>" .
                    "</body>" .
                    "</html>";
                mail($to, $objet, $contenu, $header);
                $DB->insert(
                    "UPDATE membres SET pswd = ? WHERE mail = ?",
                    array($new_pass_crypt, $verification_mail['mail'])
                );
            }
            header('Location: login.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
   

<head>
           
    <meta charset="utf-8">
    <html lang="en-GB">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
           
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="icon" type="image/png" href="../src/logo.png" />

    <!--Css Form-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

           
    <link rel="stylesheet" href="../css/login.css" />        
    <title>Forgot your password</title>
       
</head>
   

<body>

    <div class="card" style="text-align: center;">

                <div style="color: white;">
            <h1>Forgot your password</h1>
        </div>
                <form method="post">
            <?php
            if (isset($er_mail)) {
            ?>
                <label style="color: red;font-size:15px"><?= $er_mail ?>
                </label>
            <?php
            }
            ?>
            <div class="containerdiv">

                            <input type="email" placeholder="Email" name="mail" value="<?php if (isset($mail)) {
                                                                                            echo $mail;
                                                                                        } ?>" required>
            </div>
                        <button style="margin-bottom: 18%;margin-top: 10%;" class="btn" type="submit" name="oublie">To send</button>
                   
        </form>
    </div>

</body>

</html>