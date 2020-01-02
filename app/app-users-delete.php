<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-06-05
 * Time: 09:51
 */

session_start(); // BEGIN SESSION

// BEGIN SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
if(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') :

// ACTION

// 01. Require

    require "../library/connection.php";

// 02. Connect

    $dbh = connect(); // attention $dbh

// 03. SQL

// TRY AND CATCH
    try {
        $sql = "DELETE
        FROM 2018_blog.users
        WHERE 2018_blog.users.id = :id"; // Utiliser :id et pas $_GET car on fait une requete preparé securisé.

// 04. Execution de la requete

        $result = $dbh->prepare($sql);
// Maintenant il faut la BIND.
        $result->bindValue('id', $_GET['id'], PDO::PARAM_INT);
        $result->execute();
    }
    catch (PDOException $e) {
        die('Error : '.$e->getMessage());
    }

// 05. Redirection
// On le fait avec un Entete HTTP.

    header('location:../index.php?type=users');

else :
// RETURN TO INDEX
    header('location: ../index.php');
// END SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
endif;