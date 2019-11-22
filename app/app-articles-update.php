<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-05-29
 * Time: 21:59
 */

session_start(); // BEGIN SESSION

// BEGIN SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
if(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') :

require '../library/connection.php';

$dbh = connect();

try {
    $sql = "UPDATE blog.posts
            SET posts.title = :title, 
                posts.content = :content,
                posts.created = :created,
                posts.image = :image,
                posts.idCategory = :idCategory,
                posts.visibility = :visibility
            WHERE id = :idPosts";

    $result = $dbh->prepare($sql);

    $result->bindValue('title', $_POST['title'], PDO::PARAM_STR);
    $result->bindValue('content', $_POST['content'], PDO::PARAM_STR);
    $result->bindValue('created', $_POST['created'], PDO::PARAM_STR);
    $result->bindValue('image', !empty($_FILES['image']['name']) ? $_FILES['image']['name'] : $_POST['image-original'], PDO::PARAM_STR);
    $result->bindValue('idCategory', $_POST['idCategory'], PDO::PARAM_INT);
    $result->bindValue('idPosts', $_POST['idPosts'], PDO::PARAM_INT);
    $result->bindValue('visibility', $_POST['visibility'], PDO::PARAM_INT);

    $result->execute();

    if(!empty($_FILES['image'])) {
        move_uploaded_file($_FILES['image']['tmp_name'], '../assets/img/' . $_FILES['image']['name']);
        /*
        ICI IL Y A UN PROBLEME, SI JE L'ACTIVE ET QUE JE NE CHANGE PAS L'IMAGE, IL L'EFFACE QUAND MEME...
*/
        if($_FILES['image']['name'] == $_POST['image-original']) {
            // NOTHING HAPPEN
        } elseif ($_FILES['image']['name'] == $_POST['image']) {
            // NOTHING HAPPEN
        } elseif ($_FILES['image']['name'] != $_POST['image-original']) {
            unlink('../assets/img/' . $_POST['image-original']);
        } /*
          else {
            unlink('../assets/img/' . $_POST['image-original']); // $_POST dans ce cas
        } */

        echo '<h3>Transfert réussi</h3>';
        header('location: ../index.php?type=articles');
    } else {
        echo '<h3>Erreur lors du transfert</h3>';
    }
}
catch (PDOException $e) {
    die('Error : '.$e->getMessage());
}

else :
// RETURN TO INDEX
    header('location: ../index.php');
// END SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
endif;

