<?php
session_start();
include('../bd/connexionDB.php');
$user_id = $_SESSION['id'];
$root = $_SESSION['root'];
$id = $_GET['id'];
$title = $_GET['title'];
$page = $_GET['page'];


$likeetat = $DB->query("SELECT COUNT(*) FROM likes WHERE user_id ='$user_id' AND id_cars = '$id'");
$likeetat->execute();
$likeetat = $likeetat->fetchColumn();


$req_cat = $DB->query("SELECT * FROM cars WHERE id ='$id'");
$count = $DB->query("SELECT COUNT(*) FROM likes WHERE id_cars ='$id'");
$count->execute();
$count = $count->fetchColumn();
$likeetatnext = $likeetat;














?>


<!DOCTYPE html>
<html lang="$_SESSION['country']">

<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title ?></title>
<meta name="description" content="all the information on the purchase of the <?php echo $title ?> and on its maintenance">
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<link rel="stylesheet" href="../css/cars.css">
<script type="text/javascript">
    function openPage(pageUrl) {
        window.open(pageUrl);
        window.close();

    };

    function change(val) {
        window.open(val);
        window.close();

    };
</script>
<html lang="en-GB">


</head>

<body style="background-color: #121615;">


    <?php if ($page == "index.php") { ?>

        <img alt="back" style="width: 40px;margin-top:2%; margin-left:2%" onclick="openPage('../index.php')" src="../src/arrowback.png">
    <?php } else {
    ?>
        <img alt="back" style="width: 40px;margin-top:2%; margin-left:2%" onclick="openPage('<?php echo $page ?>')" src="../src/arrowback.png">

    <?php
    } ?>


    <div style="background-color: #121615;" class="container">


        <div class="card" style="background-color: #28282a;">
            <h1><?php echo $title ?></h1>
            <div class="container-fliud">
                <?php
                while ($data = $req_cat->fetch()) { ?>
                    <div class="modal fade" id="image1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                        <?php if ($data['picture1'] != "") { ?>
                            <img alt="<?php echo $title; ?>" style="width: 90%;height:100%;" src="../images/<?php echo $data['picture1']; ?>" />
                        <?php } ?>

                    </div>
                    <div class="modal fade" id="image2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                        <?php if ($data['picture2'] != "") { ?>
                            <img alt="<?php echo $title; ?>" style="width: 90%;height:100%;" src="../images/<?php echo $data['picture2']; ?>" />
                        <?php } ?>

                    </div>
                    <div class="modal fade" id="image3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                        <?php if ($data['picture3'] != "") { ?>
                            <img alt="<?php echo $title; ?>" style="width: 90%;height:100%;" src="../images/<?php echo $data['picture3']; ?>" />
                        <?php } ?>

                    </div>
                    <div class="modal fade" id="image4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                        <?php if ($data['picture4'] != "") { ?>
                            <img alt="<?php echo $title; ?>" style="width: 90%;height:100%;" src="../images/<?php echo $data['picture4']; ?>" />
                        <?php } ?>

                    </div>
                    <div class="modal fade" id="image5" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

                        <?php if ($data['picture5'] != "") { ?>
                            <img alt="<?php echo $title; ?>" style="width: 90%;height:100%;" src="../images/<?php echo $data['picture5']; ?>" />
                        <?php } ?>

                    </div>
                    <div class="wrapper row">

                        <div class="preview col-md-6">

                            <div class="preview-pic tab-content">
                                <?php if ($data['picture1'] != "") { ?>
                                    <a class="tab-pane active" id="pic-1" data-image="../images/<?php echo $data['picture1']; ?>" data-toggle="modal" data-target="#image1">
                                        <img alt="<?php echo $title; ?>" src="../images/<?php echo $data['picture1']; ?>" /> </a>
                                <?php } ?>

                                <?php if ($data['picture2'] != "") { ?>

                                    <a class="tab-pane" id="pic-2" data-image="../images/<?php echo $data['picture2']; ?>" data-toggle="modal" data-target="#image2"><img alt="<?php echo $title; ?>" src="../images/<?php echo $data['picture2']; ?>" />
                                    </a>
                                <?php } ?>

                                <?php if ($data['picture3'] != "") { ?>

                                    <a class="tab-pane" id="pic-3" data-image="../images/<?php echo $data['picture3']; ?>" data-toggle="modal" data-target="#image3"><img alt="<?php echo $title; ?>" src="../images/<?php echo $data['picture3']; ?>" />
                                    </a>
                                <?php } ?>

                                <?php if ($data['picture4'] != "") { ?>

                                    <a class="tab-pane" id="pic-4" data-image="../images/<?php echo $data['picture4']; ?>" data-toggle="modal" data-target="#image4"><img alt="<?php echo $title; ?>" src="../images/<?php echo $data['picture4']; ?>" />
                                    </a>
                                <?php } ?>

                                <?php if ($data['picture5'] != "") { ?>

                                    <a class="tab-pane" id="pic-5" data-image="../images/<?php echo $data['picture5']; ?>" data-toggle="modal" data-target="#image5"><img alt="<?php echo $title; ?>" src="../images/<?php echo $data['picture5']; ?>" />
                                    </a>
                                <?php } ?>

                            </div>
                            <ul class="preview-thumbnail nav nav-tabs">
                                <?php if ($data['picture1'] != "") { ?>

                                    <li class="active"><a data-target="#pic-1" data-toggle="tab"><img alt="<?php echo $title; ?>" src="../images/<?php echo $data['picture1']; ?>" /></a></li>
                                <?php } ?>
                                <?php if ($data['picture2'] != "") { ?>

                                    <li><a data-target="#pic-2" data-toggle="tab"><img alt="<?php echo $title; ?>" src="../images/<?php echo $data['picture2']; ?>" /></a></li>
                                <?php } ?>

                                <?php if ($data['picture3'] != "") { ?>

                                    <li><a data-target="#pic-3" data-toggle="tab"><img alt="<?php echo $title; ?>" src="../images/<?php echo $data['picture3']; ?>" /></a></li>
                                <?php } ?>

                                <?php if ($data['picture4'] != "") { ?>

                                    <li><a data-target="#pic-4" data-toggle="tab"><img alt="<?php echo $title; ?>" src="../images/<?php echo $data['picture4']; ?>" /></a></li>
                                <?php } ?>

                                <?php if ($data['picture5'] != "") { ?>

                                    <li><a data-target="#pic-5" data-toggle="tab"><img alt="<?php echo $title; ?>" src="../images/<?php echo $data['picture5']; ?>" /></a></li>
                                <?php } ?>



                            </ul>

                        </div>



                        <div class="details col-md-6">
                            <h3 class="product-title"> </h3>
                            <img alt="contact" style="width: 40px;margin-block-end: 90%;writing-mode: vertical-rl;" onclick="openPage('contact.php?title_car=<?php echo $title; ?>')" src="../src/message.png">
                            <div class="rating">
                                <div style="color: grey;" class="stars">
                                    <span style="color: white;" class="fa fa-star checked"></span>
                                    <span class="review-no"> <?php echo $count; ?>
                                    </span>

                                </div>
                            </div>
                            <?php
                            if ($_SESSION['lang'] == 'fr') { ?>
                                <h4 style="color:white" class="price">Prix: <span style="color: grey;">
                                        € <?php echo $data['price']; ?>
                                    </span></h4>
                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                <h4 style="color:white" class="price">Price: <span style="color: grey;">
                                        £ <?php echo $data['price']; ?>
                                    </span></h4>

                            <?php
                            }

                            if ($_SESSION['lang'] == 'fr') { ?>
                                <h4 style="color:white" class="price">Marque: <span style="color: grey;">
                                        <?php
                                        /*On recup l'Id de la marque de la voiture pour avoir le nom*/
                                        $idbrand = $data['id_marques_voitures'];
                                        $brand = $DB->query("SELECT * FROM marques_voitures WHERE id ='$idbrand'");
                                        $brand = $brand->fetchALL();
                                        foreach ($brand as $rc) {
                                            echo $rc['nom'];
                                        } ?> </span></h4>

                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                <h4 style="color:white" class="price">Make & Model: <span style="color: grey;">
                                        <?php
                                        /*On recup l'Id de la marque de la voiture pour avoir le nom*/
                                        $idbrand = $data['id_marques_voitures'];
                                        $brand = $DB->query("SELECT * FROM marques_voitures WHERE id ='$idbrand'");
                                        $brand = $brand->fetchALL();
                                        foreach ($brand as $rc) {
                                            echo $rc['nom'];
                                        } ?> </span></h4>
                                </span></h4>

                            <?php
                            }


                            if ($_SESSION['lang'] == 'fr') { ?>
                                <h4 style="color:white" class="price">Kilométrage: <span style="color: grey;">
                                        <?php echo $data['mileage']; ?> KM
                                    </span></h4>
                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                <h4 style="color:white" class="price">Mileage: <span style="color: grey;">
                                        <?php echo $data['mileage']; ?> MILES
                                    </span></h4>

                            <?php
                            }
                            $date =
                                new DateTime($data['bet_circulation']);
                            if ($_SESSION['lang'] == 'fr') { ?>
                                <h4 style="color:white" class="price">1ST Date of Reg : <span style="color: grey;">
                                        <?php echo $date->format('d/m/Y'); ?>
                                    </span></h4>
                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                <h4 style="color:white" class="price">Bet circulation: <span style="color: grey;">
                                        <?php echo $date->format('d/m/Y'); ?>
                                    </span></h4>

                            <?php
                            }


                            if ($_SESSION['lang'] == 'fr') { ?>
                                <h5 style="color:white" class="colors">couleur:
                                    <?php if ($data['color'] == "green") { ?>
                                        <span class="color green"></span>
                                    <?php } ?>
                                    <?php if ($data['color'] == "red") { ?>
                                        <span class="color red"></span>
                                    <?php } ?>
                                    <?php if ($data['color'] == "black") { ?>
                                        <span class="color black"></span>
                                    <?php } ?>
                                    <?php if ($data['color'] == "yellow") { ?>
                                        <span class="color yellow"></span>
                                    <?php } ?>
                                    <?php if ($data['color'] == "blue") { ?>
                                        <span class="color blue"></span>
                                    <?php } ?>
                                    <?php if ($data['color'] == "orange") { ?>
                                        <span class="color orange"></span>
                                    <?php } ?>
                                    <?php if ($data['color'] == "white") { ?>
                                        <span style="border: 1px solid;" class="color white"></span>
                                    <?php } ?>
                                    <?php if ($data['color'] == "grey") { ?>
                                        <span style="border: 1px solid;" class="color grey"></span>
                                    <?php } ?>
                                </h5>
                                <p style="color: white;" class=" product-description"> <?php echo $data['description']; ?>
                                </p>
                            <?php
                            } elseif ($_SESSION['lang'] == 'en-GB') { ?>

                                <h5 style="color:white" class="colors">color:
                                    <?php if ($data['color'] == "green") { ?>
                                        <span class="color green"></span>
                                    <?php } ?>
                                    <?php if ($data['color'] == "red") { ?>
                                        <span class="color red"></span>
                                    <?php } ?>
                                    <?php if ($data['color'] == "black") { ?>
                                        <span class="color black"></span>
                                    <?php } ?>
                                    <?php if ($data['color'] == "yellow") { ?>
                                        <span class="color yellow"></span>
                                    <?php } ?>
                                    <?php if ($data['color'] == "blue") { ?>
                                        <span class="color blue"></span>
                                    <?php } ?>
                                    <?php if ($data['color'] == "orange") { ?>
                                        <span class="color orange"></span>
                                    <?php } ?>
                                    <?php if ($data['color'] == "white") { ?>
                                        <span style="border: 1px solid;" class="color white"></span>
                                    <?php } ?>
                                    <?php if ($data['color'] == "grey") { ?>
                                        <span style="border: 1px solid;" class="color grey"></span>
                                    <?php } ?>
                                </h5>
                                <p style="color: white;" class=" product-description"> <?php echo $data['description']; ?>
                                </p>
                            <?php } ?>


                            <?php
                            if (isset($_SESSION['id'])) {

                                if ($_SESSION['lang'] == 'fr') { ?>
                                    <form method="post" class="action">
                                        <?php if ($likeetat == 0) {
                                        ?>
                                            <a class="like" href="like.php?user=<?= $user_id ?>&id=<?= $id ?>&title=<?= $title ?>&page=<?php echo $page ?>"><span class="fa fa-heart"></span></a>
                                        <?php
                                        }
                                        ?>


                                        <?php
                                        if ($root == 1) { ?>

                                            <button onclick="openPage('updatecar.php?id=<?php echo $id; ?>&page=<?php echo $page ?>')" class="add-to-cart btn btn-default" type="button">Modifier</button>



                                            <button onclick="openPage('action/delete.php?id=<?php echo $id; ?>')" class="add-to-cart btn btn-default" type="button">Supprimer</button>
                                            <?php if ($data['state'] == 1) {
                                                $state = "sold";
                                            } elseif ($data['state'] == 0) {
                                                $state = "nosold";
                                            } else {
                                                $state = "reserve";
                                            } ?>
                                            <select onChange="change(this.value)" class=" add-to-cart btn btn-default" name="sold" value="<?php $state ?>" id="sold">
                                                <option disabled selected value> --new state-- </option>

                                                <?php if ($data['state'] != "1") { ?>

                                                    <option value="action/sold.php?id=<?php echo $id; ?>&title=<?php echo $title ?>&page=<?php echo $page ?>">Vendu</option>
                                                <?php  }
                                                if ($data['state'] != "2") { ?>
                                                    <option value="action/reserve.php?id=<?php echo $id; ?>&title=<?php echo $title ?>&page=<?php echo $page ?>">Reservé</option>
                                                <?php  }
                                                if ($data['state'] != "0") {
                                                ?>
                                                    <option value="action/nosold.php?id=<?php echo $id; ?>&title=<?php echo $title ?>&page=<?php echo $page ?>">Pas Vendu</option>
                                                <?php } ?>

                                            </select>
                                        <?php } ?>


                                    </form>
                                <?php
                                } elseif ($_SESSION['lang'] == 'en-GB') { ?>
                                    <form method="post" class="action">
                                        <?php if ($likeetat == 0) {
                                        ?>
                                            <a class="like" href="like.php?user=<?= $user_id ?>&id=<?= $id ?>&title=<?= $title ?>&page=<?php echo $page ?>"><span class="fa fa-heart"></span></a>
                                        <?php
                                        }
                                        ?>


                                        <?php
                                        if ($root == 1) { ?>

                                            <button onclick="openPage('updatecar.php?id=<?php echo $id; ?>&page=<?php echo $page ?>')" class="add-to-cart btn btn-default" type="button">Modify</button>
                                            <button onclick="openPage('action/delete.php?id=<?php echo $id; ?>')" class="add-to-cart btn btn-default" type="button">Delete</button>
                                            <?php if ($data['state'] == 1) {
                                                $state = "sold";
                                            } elseif ($data['state'] == 0) {
                                                $state = "nosold";
                                            } else {
                                                $state = "reserve";
                                            } ?>
                                            <select onChange="change(this.value)" class="add-to-cart btn btn-default" name="sold" value="<?php echo $state ?>" id="sold">
                                                <option disabled selected value> --new state-- </option>
                                                <?php if ($data['state'] !== "1") { ?>
                                                    <option value="action/sold.php?id=<?php echo $id; ?>&title=<?php echo $title ?>&page=<?php echo $page ?>">Sold</option>
                                                <?php  }
                                                if ($data['state'] !== "2") { ?>
                                                    <option value="action/reserve.php?id=<?php echo $id; ?>&title=<?php echo $title ?>&page=<?php echo $page ?>">Reserved</option>
                                                <?php  }
                                                if ($data['state'] !== "0") {
                                                ?>
                                                    <option value="action/nosold.php?id=<?php echo $id; ?>&title=<?php echo $title ?>&page=<?php echo $page ?>">Available</option>
                                                <?php } ?>
                                            </select>
                                        <?php } ?>


                                    </form>
                                <?php
                                } ?>

                            <?php

                            }
                            ?>
                        </div>
                    <?php
                }
                    ?>

                    </div>
            </div>


        </div>



</body>




</html>