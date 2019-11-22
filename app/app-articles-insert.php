<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-05-29
 * Time: 20:15
 */

session_start(); // BEGIN SESSION

// BEGIN SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
if(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') :

require '../library/connection.php';

$dbh = connect();

try {
$sql = "INSERT INTO blog.posts (title, content, created, image, idCategory, idUser, visibility) 
        VALUES (:title, :content, :created, :image, :idCategory, :idUser, :visibility)";

$result = $dbh->prepare($sql);

/*
var_dump($_POST['title']); echo '<br>';
var_dump($_POST['content']);echo '<br>';
var_dump($_POST['created']);echo '<br>';
var_dump($_FILES['image']);echo '<br>';
var_dump($_POST['idCategory']);echo '<br>';
var_dump($_POST['idUser']);echo '<br>';
var_dump($_POST['visibility']);echo '<br>';
*/
$result->bindValue('title', $_POST['title'], PDO::PARAM_STR);
$result->bindValue('content', $_POST['content'], PDO::PARAM_STR);
$result->bindValue('created', $_POST['created'], PDO::PARAM_STR);
$result->bindValue('image', $_FILES['image']['name'], PDO::PARAM_STR);
$result->bindValue('idCategory', $_POST['idCategory'], PDO::PARAM_INT);
$result->bindValue('idUser', $_POST['idUser'], PDO::PARAM_INT);
$result->bindValue('visibility', $_POST['visibility'], PDO::PARAM_INT);

$result->execute();
}
catch (PDOException $e) {
    die ('Erreur : '.$e->getMessage());
}

// TRANSFERT DU FICHIER

if(move_uploaded_file($_FILES['image']['tmp_name'], '../assets/img/'.$_FILES['image']['name'])) {
    echo 'Reussite';
    header('location: ../index.php?type=articles');
} else {
    echo 'Echec';
    header('location: ../index.php?type=articles');
}
    header('location: ../index.php?type=articles');

else :
// RETURN TO INDEX
    header('location: ../index.php');
// END SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
endif; ?>
