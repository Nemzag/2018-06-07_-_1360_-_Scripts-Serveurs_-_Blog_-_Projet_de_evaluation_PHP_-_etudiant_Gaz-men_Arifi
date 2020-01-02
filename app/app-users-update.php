<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-06-05
 * Time: 14:44
 */


session_start(); // BEGIN SESSION

// BEGIN SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
if(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') :

    require '../library/connection.php';

    $dbh = connect();

    try {
        $sql = "UPDATE 2018_blog.users
                SET users.firstName = :firstName, 
                    users.lastName = :lastName,
                    users.mail = :mail,
                    users.login = :login,
                    users.password = :password,
                    users.level = :level
                WHERE id = :id";

        $result = $dbh->prepare($sql);

        $result->bindValue('firstName', $_POST['firstName'], PDO::PARAM_STR);
        $result->bindValue('lastName', $_POST['lastName'], PDO::PARAM_STR);
        $result->bindValue('mail', $_POST['mail'], PDO::PARAM_STR);
        $result->bindValue('login', $_POST['login'], PDO::PARAM_STR);
        $result->bindValue('password', password_hash($_POST['password'], PASSWORD_DEFAULT), PDO::PARAM_STR);
        $result->bindValue('level', $_POST['level'], PDO::PARAM_STR);
        $result->bindValue('id', $_POST['id'], PDO::PARAM_INT);

        $result->execute();

    }
    catch (PDOException $e) {
        die('Error : '.$e->getMessage());
    }
    header('location: ../index.php?type=users');

else :
// RETURN TO INDEX
    header('location: ../index.php');
// END SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
endif;

