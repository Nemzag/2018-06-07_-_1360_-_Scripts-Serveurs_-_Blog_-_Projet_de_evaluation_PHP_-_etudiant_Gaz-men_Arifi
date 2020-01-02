<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-06-05
 * Time: 06:53
 */

session_start();

// SECURISATION CONTRE LES HACKERS, CODE INVISIBLE
if(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') {

    require '../library/connection.php';

    $dbh = connect();

    try {
        $sql = "UPDATE 2018_blog.posts
                SET 2018_blog.visibility = :visibility      
                WHERE 2018_blog.posts.id = :id";

        $result = $dbh->prepare($sql);

        $result->bindValue('id', $_GET['id'], PDO::PARAM_INT);
        $result->bindValue('visibility', $_GET['visibility'], PDO::PARAM_INT);

        $result->execute();
    }
    catch (PDOException $e) {
        die('Error SQL : '.$e->getMessage());
    }

    if(isset($_GET['search'])) {
        header('location: ../index.php?type=articles&search='.$_GET['search'].'');
    } else {
        header('location: ../index.php?type=articles');
    }
} else {
    header('location: ../index.php');
}