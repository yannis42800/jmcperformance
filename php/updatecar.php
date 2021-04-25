<?php
session_start();
include('../bd/connexionDB.php');
$db = mysqli_connect("", "", "", "");

$user_id = $_SESSION['id'];
$id = $_GET['id'];
$page = $_GET['page'];


$car = $DB->query(
    "SELECT * FROM cars WHERE id = ?",
    array($id)
);

$car = $car->fetch();
$title = $car['title'];




if (!empty($_POST)) {
    extract($_POST);
    $valid = true;

    if (isset($_POST)) {
        $title = $_POST['title'];
        $bet_circulation = $_POST['dpd1'];
        $description = $_POST['description'];
        $price = $_POST['price'];
        $picture1 =  $_POST['picture1'];
        $picture2 = $_POST['picture2'];
        $picture3 = $_POST['picture3'];
        $picture4 = $_POST['picture4'];
        $mileage = $_POST['mileage'];

        $user = $_SESSION['id'];
        $name = $_FILES["picture1"]["name"];
        $chemin = "../images/";
        $imgbd = $_POST['picture1'];
        $imgbd2 = $_POST['picture2'];
        $imgbd3 = $_POST['picture3'];
        $imgbd4 = $_POST['picture4'];

        $creation_date = $car['date_creation'];
        $country = $car['country'];
        $color = $car['color'];
        $car_brands = $car['id_marques_voitures'];



        if (empty($title)) {
            $valid = false;
            $er = "You have to put a title";
        } elseif (empty($description)) {
            $valid = false;
            $er = "It is necessary to put a description";
        } elseif (empty($price)) {
            $valid = false;
            $er = "It is necessary to put a price";
        } elseif ($valid) {

            if (empty($picture1 | $picture2 | $picture3 | $picture4)) {
                $imgbd = $car['picture1'];
                $imgbd2 = $car['picture2'];
                $imgbd3 = $car['picture3'];
                $imgbd4 = $car['picture4'];
            } else {
                if (!is_dir($chemin) || !is_writable($chemin)) {
                    echo "<br>Erreur: <br>Le chemin << $chemin >> n'existe pas ou ne dispose pas des droits necessaires";
                } else {
                    $uploadfile = $chemin . basename($_FILES['picture1']['name']);
                    $uploadfile2 = $chemin . basename($_FILES['picture2']['name']);
                    $uploadfile3 = $chemin . basename($_FILES['picture3']['name']);
                    $uploadfile4 = $chemin . basename($_FILES['picture4']['name']);
                    if (empty($imgbd)) {
                        $er = "It is necessary to put a picture";
                    }

                    $fileToMove = !empty($_FILES['picture1']['tmp_name']) ? $_FILES['picture1']['tmp_name'] : NULL;
                    $fileToMove2 = !empty($_FILES['picture2']['tmp_name']) ? $_FILES['picture2']['tmp_name'] : NULL;
                    $fileToMove3 = !empty($_FILES['picture3']['tmp_name']) ? $_FILES['picture3']['tmp_name'] : NULL;
                    $fileToMove4 = !empty($_FILES['picture4']['tmp_name']) ? $_FILES['picture4']['tmp_name'] : NULL;
                    $result = move_uploaded_file($fileToMove, $uploadfile);
                    $result2 = move_uploaded_file($fileToMove2, $uploadfile2);
                    $result3 = move_uploaded_file($fileToMove3, $uploadfile3);
                    $result4 = move_uploaded_file($fileToMove4, $uploadfile4);
                }
            }
            $DB->insert(
                "UPDATE cars SET title = '$title', description = '$description', price = '$price', picture1 = '$imgbd', picture2 = '$imgbd2', picture3 = '$imgbd3', picture4 = '$imgbd4' WHERE id = '$id'"
            );
            header("location: cars.php?id=$id&title=$title&page=$page");
            exit;
        } else {
            $er =  '  ajout dans la db :  error .Contacter le developpeur ';
        }
    }
}




?>





<!DOCTYPE html>
<html lang="fr">
   

<head>
    <title>Update Car</title>
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



    <meta charset="utf-8">
           
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
           
    <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript">
        function back() {
            window.open('cars.php?id=<?php echo $id ?>&title=<?php echo $car['title']; ?>&page=<?php echo $page; ?>');
            window.close();
        }

        function openPage(pageUrl) {

        }
    </script>
</head>
   

<body style="background: #201f22;padding: 1%;">
    <div class="card">
        <img onclick="back()" style="width: 30px;margin-left:1%;margin-top:1%" src="../src/back.png">

        <div class="container">
            <div class="main">
                <div class="main-center">
                    <h1>Update Car</h1>
                    <?php
                    if (isset($er)) {
                    ?>
                        <label style="color: red;font-size:15px"><?= $er ?>
                        </label>
                    <?php
                    }
                    ?>
                    <form method="post">
                        <div class="form-group">
                            <?php
                            if ($_SESSION['lang'] == 'fr') { ?>
                                <label for="title">Quel est le titre de l’annonce ?</label>

                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                <label for="title">What is the title of the ad?</label>


                            <?php
                            }
                            ?>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                                <input class="form-control" value="<?php if (isset($title)) {
                                                                        echo $title;
                                                                    } else {
                                                                        echo $car['title'];
                                                                    } ?>" maxlength="100" type=" text" name="title">
                            </div>
                        </div>
                        <div class="form-group">

                        </div>
                        <div class="form-group">

                            <label for="description">Description</label>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                <input class="form-control" maxlength="4000" type=" text" value="<?php if (isset($description)) {
                                                                                                        echo $description;
                                                                                                    } else {
                                                                                                        echo $car['description'];
                                                                                                    } ?>" name=" description"><br>
                            </div>
                        </div>
                        <div class="form-group">
                            <?php
                            if ($_SESSION['lang'] == 'fr') { ?>
                                <label for="price">prix</label>

                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                <label for="price">price</label>


                            <?php
                            }
                            ?>
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                <input class="form-control" type="text" value="<?php if (isset($price)) {
                                                                                    echo $price;
                                                                                } else {
                                                                                    echo $car['price'];
                                                                                } ?>" name="price" />
                            </div>
                        </div>



                        <div class="form-group">
                            <div class="row">
                                <div style="height:290px;width:20%;margin-left:3%" class="span2">
                                    <a href="#" class="thumbnail">
                                        <?php if ($car['picture1'] != "") { ?>
                                            <img src="../images/<?php echo $car['picture1'] ?>">
                                        <?php } else { ?>
                                            <img src="../src/voiturefond.jpg">




                                        <?php } ?>
                                    </a>
                                    <input style="width: 25%;" type="hidden" name="size"><input type="file" name="picture1">

                                </div>
                                <div style="height:20%;width:20%;margin-left:3%" class="span2">
                                    <a href="#" class="thumbnail">
                                        <?php if ($car['picture2'] != "") { ?>

                                            <img src="../images/<?php echo $car['picture2'] ?>">
                                        <?php } else { ?>
                                            <img src="../src/voiturefond.jpg">




                                        <?php } ?>
                                    </a>
                                    <input style="width: 25%;" type="hidden" name="size" value="1000000">
                                    <input type="file" value="<?php if (isset($picture2)) {
                                                                    echo $picture2;
                                                                } else {
                                                                    echo $car['picture2'];
                                                                } ?>" name="picture2">

                                </div>
                                <div style="height:20%;width:20%;margin-left:3%" class="span2">
                                    <a href="#" class="thumbnail">
                                        <?php if ($car['picture3'] != "") { ?>

                                            <img src="../images/<?php echo $car['picture3'] ?>">
                                        <?php } else { ?>
                                            <img src="../src/voiturefond.jpg">




                                        <?php } ?>
                                    </a>
                                    <input style="width: 25%;" type="hidden" name="size" value="1000000">
                                    <input type="file" name="picture3">

                                </div>
                                <div style="height:20%;width:20%;margin-left:3%" class="span2">
                                    <a href="#" class="thumbnail">
                                        <?php if ($car['picture4'] != "") { ?>

                                            <img src="../images/<?php echo $car['picture4'] ?>">
                                        <?php } else { ?>
                                            <img src="../src/voiturefond.jpg">




                                        <?php } ?>
                                    </a>
                                    <input style="width: 25%;" type="hidden" name="size" value="1000000">
                                    <input type="file" name="picture4">

                                </div>

                            </div>
                        </div>




                </div>

                <input class="btn" type="submit" name="upload" value="Publier">

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