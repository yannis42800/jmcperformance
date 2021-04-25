	<?php
    session_start();
    include('../bd/connexionDB.php');
    $db = mysqli_connect("", "", "", "");

    if (isset($_GET['user'], $_GET['id']) and !empty($_GET['user']) and !empty($_GET['id'])) {
        $getid = (int) $_GET['id'];
        $gett = (int) $_GET['user'];
        $title = $_GET['title'];
        $page = $_GET['page'];
        $sessionid = $gett;
        $check = $db->prepare('SELECT id FROM likes WHERE id = ?');
        $check->execute(array($getid));
        $check_like = $DB->query("SELECT COUNT(*) FROM likes WHERE user_id ='$gett' AND id_cars = '$getid'");
        $check_like->execute();
        $check_like = $check_like->fetchColumn();


        if ($check_like == 1) {
            header('Location: cars.php?id=' . $getid);
        } else {
            $sql = "INSERT INTO likes (id_cars, user_id) VALUES ('$getid','$gett')";
            if (!mysqli_query($db, $sql)) {
                echo '  ajout dans la db :  error';
            } else {
                header("location: cars.php?id=$getid&title=$title&page=$page");
                exit;
            }
        }
    } else {
        exit('Erreur fatale2. <a href="../gallery.php">Revenir à l\'accueil</a>');
    }
