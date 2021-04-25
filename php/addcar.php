<?php
session_start();
include('../bd/connexionDB.php');

$db = mysqli_connect("", "", "", "");

if (isset($_POST['upload'])) {
    extract($_POST);
    $valid = true;

    $car_brands = $_POST['car_brands'];
    $title = $_POST['title'];
    $bet_circulation = $_POST['dpd1'];
    $color = $_POST['color'];
    $description = $_POST['description'];
    $country = $_POST['country'];
    $price = $_POST['price'];
    $picture1 = $_POST['picture1'];
    $picture2 = $_POST['picture2'];
    $picture3 = $_POST['picture3'];
    $picture4 = $_POST['picture4'];
    $mileage = $_POST['mileage'];


    $user = $_SESSION['id'];
    $name = $_FILES["picture1"]["name"];
    $chemin = "../images/";
    $imgbd = $_FILES['picture1']['name'];
    $imgbd2 = $_FILES['picture2']['name'];
    $imgbd3 = $_FILES['picture3']['name'];
    $imgbd4 = $_FILES['picture4']['name'];
    if (empty($title)) {
        $valid = false;
        if ($_SESSION['lang'] == 'fr') {
            $er = "Il faut mettre un titre";
        }
        if ($_SESSION['lang'] == 'en-GB') {
            $er = "You must put an title";
        }
    }
    if (empty($description)) {
        $valid = false;
        if ($_SESSION['lang'] == 'fr') {
            $er = "Il faut mettre une description";
        }
        if ($_SESSION['lang'] == 'en-GB') {
            $er = "You must put an description";
        }
    }
    if (empty($country)) {
        $valid = false;
        if ($_SESSION['lang'] == 'fr') {
            $er = "Il faut mettre un pays";
        }
        if ($_SESSION['lang'] == 'en-GB') {
            $er = "You must put an country";
        }
    }
    if (empty($picture1)) {
        $valid = false;
        if ($_SESSION['lang'] == 'fr') {
            $er = "Il faut mettre une photo";
        }
        if ($_SESSION['lang'] == 'en-GB') {
            $er = "You must put a picture";
        }
    }
    if (empty($mileage)) {
        $valid = false;
        if ($_SESSION['lang'] == 'fr') {
            $er = "Il faut choisir une marque";
        }
        if ($_SESSION['lang'] == 'en-GB') {
            $er = "You must choose a mileage";
        }
    }
    if ($valid) {

        if (!is_dir($chemin) || !is_writable($chemin)) {
            $er =  "<br>Error: The path << $chemin>> does not exist or does not have the necessary rights <br>";
        } else {
            $uploadfile = $chemin . basename($_FILES['picture1']['name']);
            $uploadfile2 = $chemin . basename($_FILES['picture2']['name']);
            $uploadfile3 = $chemin . basename($_FILES['picture3']['name']);
            $uploadfile4 = $chemin . basename($_FILES['picture4']['name']);


            $fileToMove = !empty($_FILES['picture1']['tmp_name']) ? $_FILES['picture1']['tmp_name'] : NULL;
            $fileToMove2 = !empty($_FILES['picture2']['tmp_name']) ? $_FILES['picture2']['tmp_name'] : NULL;
            $fileToMove3 = !empty($_FILES['picture3']['tmp_name']) ? $_FILES['picture3']['tmp_name'] : NULL;
            $fileToMove4 = !empty($_FILES['picture4']['tmp_name']) ? $_FILES['picture4']['tmp_name'] : NULL;

            if ($fileToMove) {
                $result = move_uploaded_file($fileToMove, $uploadfile);
                $result2 = move_uploaded_file($fileToMove2, $uploadfile2);
                $result3 = move_uploaded_file($fileToMove3, $uploadfile3);
                $result4 = move_uploaded_file($fileToMove4, $uploadfile4);

                $date_creation = date('Y-m-d H:i:s');

                $sql = "INSERT INTO cars (user_id,title,description,country,price,id_marques_voitures,picture1,picture2,picture3,picture4,date_creation,color,bet_circulation,mileage,state) VALUES ('$user','$title','$description','$country','$price','$car_brands','$imgbd','$imgbd2','$imgbd3','$imgbd4','$date_creation','$color','$bet_circulation','$mileage','0')";

                if (!mysqli_query($db, $sql)) {
                    $er = '  ajout dans la db :  error';
                } else {
                    header('location: profil.php');
                    exit;
                }
            } else {
                $er = "<br> Error, no image file to move!";
            }
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Add Car</title>
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
                        <h1 style="text-align: center;">Publier Voiture</h1>

                    <?php
                    } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                        <h1 style="text-align: center;">Publish Car</h1>


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
                                <label style="text-align: center; width:100%" for="title">Quel est le titre de l’annonce ?</label>

                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                <label style="text-align: center; width:100%" for="title">What is the title of the ad?</label>


                            <?php
                            } ?>
                            <div class="input-group">
                                <span style="background-color: #201f22;" class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input style="border-color:black;" class="form-control" maxlength="25" placeholder="Titre" type="text" name="title">
                            </div>
                        </div>
                        <div class="form-group">

                        </div>
                        <div class="form-group">
                            <?php
                            if ($_SESSION['lang'] == 'fr') { ?>
                                <label style="text-align: center; width:100%" for="description">Description</label>

                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                <label style="text-align: center; width:100%" for="description">Description</label>


                            <?php
                            } ?>
                            <div class="input-group">
                                <span style="background-color: #201f22;" class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                <input class="form-control" maxlength="4000" type=" text" placeholder="Description du véhicule  " name=" description"><br>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php
                            if ($_SESSION['lang'] == 'fr') { ?>
                                <label style="text-align: center; width:100%" for="country">Pays (choisir un seul pays) </label>

                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                <label style="text-align: center; width:100%" for="country">Country (choose a single country) </label>



                            <?php
                            } ?>

                            <div style="text-align: center; width:100%" class="input-group">
                                <div class="btn-group" data-toggle="checkbox">
                                    <label>France</label>
                                    <input value="fr" type="checkbox" name="country" id="option2" chacked>
                                    <label>England</label>
                                    <input value="en-GB" type="checkbox" name="country" id="option1" autocomplete="off">


                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php
                            if ($_SESSION['lang'] == 'fr') { ?>
                                <label style="text-align: center; width:100%" for="price">Prix</label>

                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                <label style="text-align: center; width:100%" for="price">Price</label>



                            <?php
                            } ?>
                            <div class="input-group">
                                <span style="background-color: #201f22;" class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input placeholder="price" class="form-control" type="text" name="price" />
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div style="height:290px;width:20%;margin-left:3%" class="span2">
                                    <a style="background-color: #201f22;" href="#" class="thumbnail">
                                        <img alt="addcar" src="../src/addcar.jpg">
                                    </a>
                                    <input style="width: 25%;" type="hidden" name="size" value="1000000"><input type="file" name="picture1">

                                </div>
                                <div style="height:20%;width:20%;margin-left:3%" class="span2">
                                    <a style="background-color: #201f22;" href="#" class="thumbnail">
                                        <img alt="addcar" src="../src/addcar.jpg">
                                    </a>
                                    <input style="width: 25%;" type="hidden" name="size" value="1000000">
                                    <input type="file" name="picture2">

                                </div>
                                <div style="height:20%;width:20%;margin-left:3%" class="span2">
                                    <a style="background-color: #201f22;" href="#" class="thumbnail">
                                        <img alt="addcar" src="../src/addcar.jpg">
                                    </a>
                                    <input style="width: 25%;" type="hidden" name="size" value="1000000">
                                    <input type="file" name="picture3">

                                </div>
                                <div style="height:20%;width:20%;margin-left:3%" class="span2">
                                    <a style="background-color: #201f22;" href="#" class="thumbnail">
                                        <img alt="addcar" src="../src/addcar.jpg">
                                    </a>
                                    <input style="width: 25%;" type="hidden" name="size" value="1000000">
                                    <input type="file" name="picture4">

                                </div>

                            </div>
                        </div>


                        <div class="form-group">
                            <?php
                            if ($_SESSION['lang'] == 'fr') { ?>
                                <label style="text-align: center; width:100%" for="color">Marque de la voiture</label>

                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                <label style="text-align: center; width:100%" for="color">Car brand</label>



                            <?php
                            } ?>

                            <?php
                            if (empty($car_brands)) {
                            ?>
                                <select name="car_brands" class="form-control form-control-lg" id="inputGroupSelect01">
                                    <?php
                                    if ($_SESSION['lang'] == 'fr') { ?>
                                        <option selected>Sélectionner la marque de la voiture</option>

                                    <?php
                                    } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                        <option selected>Select the car brand</option>



                                    <?php
                                    } ?>
                                <?php
                            } else {
                                ?>
                                    <option value="<?= $car_brands ?>"><?= $verif_cat['nom'] ?></option>
                                <?php
                            }

                            $req_cat = $DB->query("SELECT * 
                            FROM marques_voitures ORDER by 'ASC'");
                            $req_cat = $req_cat->fetchALL();

                            foreach ($req_cat as $rc) {
                                ?>
                                    <option value="<?= $rc['id'] ?>"><?= $rc['nom'] ?></option>
                                <?php
                            }
                                ?>
                                </select>
                        </div>

                        <div class="form-group">
                            <?php
                            if ($_SESSION['lang'] == 'fr') { ?>
                                <label style="text-align: center; width:100%" for="color">Couleur</label>
                                <select name="color" class="form-control form-control-lg" id="inputGroupSelect02">
                                    <option selected>Sélectionner la couleur de la voiture</option>
                                    <option style="background-color: black; color:white;" value="black">Noire</option>
                                    <option style="background-color: grey; color:white;" value="grey">Gris</option>
                                    <option style="background-color: white;" value="white">Blanc</option>
                                    <option style="background-color: blue; color:white;" value="blue">Bleu</option>
                                    <option style="background-color: yellow; color:white;" value="yellow">Jaune</option>
                                    <option style="background-color: red; color:white;" value="red">Rouge</option>




                                </select>
                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                <label style="text-align: center; width:100%" for="color">Color</label>
                                <select name="color" class="form-control form-control-lg" id="inputGroupSelect02">
                                    <option selected>Select car color</option>
                                    <option style="background-color: black; color:white;" value="black">Black</option>
                                    <option style="background-color: grey; color:white;" value="grey">Grey</option>
                                    <option style="background-color: white;" value="white">White</option>
                                    <option style="background-color: blue; color:white;" value="blue">Blue</option>
                                    <option style="background-color: yellow; color:white;" value="yellow">Yellow</option>
                                    <option style="background-color: red; color:white;" value="red">Red</option>




                                </select>



                            <?php
                            } ?>

                        </div>
                        <div class="form-group">
                            <?php
                            if ($_SESSION['lang'] == 'fr') { ?>
                                <label style="text-align: center; width:100%" for="date">Date de mise en circulation (Years-Month-Day)</label>

                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                <label style="text-align: center; width:100%" for="date">Date of circulation (Years-Month-Day)</label>



                            <?php
                            } ?>
                            <div class="input-group">
                                <span style="background-color: #201f22;" class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input name="dpd1" class="form-control" placeholder="Years-Month-Day" type="text" class="span2">

                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                            if ($_SESSION['lang'] == 'fr') { ?>
                                <label style="text-align: center; width:100%" for="mileage">kilométrage</label>

                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                <label style="text-align: center; width:100%" for="mileage">mileage</label>



                            <?php
                            } ?>
                            <div class="input-group">
                                <span style="background-color: #201f22;" class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input name="mileage" class="form-control" placeholder="kilométrage" type="number">

                            </div>
                        </div>


                </div>
                <div style="padding-left: 40%;padding-right: 40%; margin-top:5%">
                    <?php
                    if ($_SESSION['lang'] == 'fr') { ?>
                        <input style="color: #201f22;width:100%;" class="btn" type="submit" name="upload" value="Publier">

                    <?php
                    } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                        <input style="color: #201f22;width:100%" class="btn" type="submit" name="upload" value="Publish">



                    <?php
                    } ?>
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