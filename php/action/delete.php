	<?php
    session_start();
    include('../bd/connexionDB.php');
    $db = mysqli_connect("", "", "", "");

    if (isset($_GET['id']) and !empty($_GET['id'])) {
        $getid = (int) $_GET['id'];
        $gett = (int) $_GET['user'];
        $title = (int) $_GET['title'];
        $sessionid = $gett;
        $check = $db->prepare('SELECT id FROM cars WHERE id = ?');
        $check->execute(array($getid));



        $sql = "DELETE FROM cars WHERE  id = '$getid'";
        if (!mysqli_query($db, $sql)) {
            echo '  ajout dans la db :  error';
        } else {
            header("location: ../gallery.php");
            exit;
        }
    } else {
        exit('Erreur fatale2. <a href="gallery.php">Revenir à l\'accueil</a>');
    }
