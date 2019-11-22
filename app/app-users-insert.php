<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-05-30
 * Time: 15:50
 */

session_start(); // BEGIN SESSION

// BEGIN SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
if(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') :

require '../library/connection.php';

$dbh = connect();

try {
$sql = "INSERT INTO blog.users (firstName, lastName, mail, login, password, level) 
        VALUES (:firstName, :lastName, :mail, :login, :password, :level)";

$result = $dbh->prepare($sql);

$result->bindValue('level', $_POST['level'], PDO::PARAM_STR);
$result->bindValue('firstName', $_POST['firstName'], PDO::PARAM_STR);
$result->bindValue('lastName', $_POST['lastName'], PDO::PARAM_STR);
$result->bindValue('mail', $_POST['mail'], PDO::PARAM_STR);
$result->bindValue('login', $_POST['login'], PDO::PARAM_STR);
    $result->bindValue('password', ($_SESSION['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT)), PDO::PARAM_STR);

        $result->execute();
}
catch (PDOException $e) {
    die ('Erreur : '.$e->getMessage());
}

// REDIRECTION
   header('location: ../index.php?type=users');

elseif(!isset($_SESSION['login']) && $_SESSION['tmp'] == 'user') :

    // DESTRUCTION DE LA VARIABLE SESSION TEMPORAIRE
    unset($_SESSION['tmp']);

    $_SESSION['level'] = 'user';

    require '../library/connection.php';

    $dbh = connect();

    try {
        $sql = "INSERT INTO blog.users (firstName, lastName, mail, login, password, level) 
        VALUES (:firstName, :lastName, :mail, :login, :password, :level)";

        $result = $dbh->prepare($sql);

        $result->bindValue('level', $_POST['level'], PDO::PARAM_STR);
        $result->bindValue('firstName', $_POST['firstName'], PDO::PARAM_STR);
        $result->bindValue('lastName', $_POST['lastName'], PDO::PARAM_STR);
        $result->bindValue('mail', $_POST['mail'], PDO::PARAM_STR);
        $result->bindValue('login', ($_SESSION['login'] = $_POST['login']), PDO::PARAM_STR);
        $result->bindValue('password', ($_SESSION['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT)), PDO::PARAM_STR);

        $result->execute();
    }
    catch (PDOException $e) {
        die ('Erreur : '.$e->getMessage());
    }

// REDIRECTION
   header('location: app-login.php');

else :
// RETURN TO INDEX
   header('location: ../index.php');
// END SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
endif; ?>
