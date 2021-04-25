<?php
session_start();
include('../bd/connexionDB.php');

$db = mysqli_connect("", "", "", "");

if (isset($_POST['upload'])) {
    extract($_POST);
    $valid = true;

    $title = $_POST['brand'];


    if (empty($title)) {
        $valid = false;
        if ($_SESSION['lang'] == 'fr') {
            $er = "Il faut mettre un nom";
        }
        if ($_SESSION['lang'] == 'en-GB') {
            $er = "You must put an name";
        }
    }

    if ($valid) {




        $sql = "INSERT INTO marques_voitures (nom) VALUES ('$title')";

        if (!mysqli_query($db, $sql)) {
            $er = '  ajout dans la db :  error';
        } else {
            header('location: profil.php');
            exit;
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Brand</title>
    <meta charset="utf-8">
    <html lang="en-GB">


    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="icon" type="image/png" href="../src/logo.png" />
    <link rel="stylesheet" type="text/css" href="../css/addcar.css">

    <!------ boolstrap ---------->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

    <script type="text/javascript">
        function back() {
            window.open('profil.php');
            window.close();
        }

        function openPage(pageUrl) {

        }
    </script>




</head>

<body style="background: #201f22;padding: 1%;">
    <div style="background-color: #28282a; color:white" class="card">
        <img alt="back" onclick="back()" style="width: 30px;margin-left:1%;margin-top:1%" src="../src/arrowback.png">
        <div class="container">
            <div class="main">
                <div class="main-center">
                    <?php
                    if ($_SESSION['lang'] == 'fr') { ?>
                        <h1 style="text-align: center;">Ajouter une marque de voiture</h1>

                    <?php
                    } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                        <h1 style="text-align: center;">Add a car brand</h1>


                    <?php
                    } ?>

                    <?php
                    if (isset($er)) {
                    ?>
                        <label style="color: red;font-size:15px"><?= $er ?></label>
                    <?php
                    }
                    ?>
                    <form enctype="multipart/form-data" action="" method="post">
                        <div style="margin-top: 2%;" class="form-group">
                            <?php
                            if ($_SESSION['lang'] == 'fr') { ?>
                                <label style="text-align: center; width:100%" for="title">Quelle est la marque ?</label>

                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                <label style="text-align: center; width:100%" for="title"> What is the brand?</label>


                            <?php
                            } ?>
                            <div class="input-group">
                                <span style="background-color: #201f22;" class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input style=" color:white; border-color:black;" class="form-control" maxlength="25" placeholder="Brand" type="text" name="brand">
                            </div>
                        </div>

                    </form>
                </div>
                <!--main-center"-->
            </div>
            <!--main-->
        </div>
        <!--container-->
    </div>
    <!--cards-->


</body>

</html>