<?php
session_start();
$db = mysqli_connect("", "", "", "");


$id = $_GET['id'];
$title = $_GET['title'];
$page = $_GET['page'];


$sql = "UPDATE cars SET state = '2' WHERE id = '$id'";
if (mysqli_query($db, $sql)) {
    header("location: ../cars.php?id=$id&title=$title&page=$page");
    exit;
}
