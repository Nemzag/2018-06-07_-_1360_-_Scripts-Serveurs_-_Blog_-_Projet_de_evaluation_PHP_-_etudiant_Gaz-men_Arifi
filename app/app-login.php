<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-05-29
 * Time: 14:32
 */

session_start(); // BEGIN SESSION

require '../library/connection.php';

// ACCES CLASSIQUE

$dbh = connect();

if($_SESSION['level'] == 'user') {
    echo 'test';
    // ON TEST D'ABORD LE LOGIN

    // QUERY POUR VERIFIER LA PRESENCE DU LOGIN

    try {
        $sql = "SELECT blog.users.login, 
                       blog.users.password,
                       blog.users.level
                FROM blog.users
                WHERE users.login = :login";

        $result = $dbh->prepare($sql);

        $result->bindValue('login', $_SESSION['login'], PDO::PARAM_STR);

        $result->execute();

        $row = $result->fetchObject(); // fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die('Erreur requete : ' . $e->getMessage());
    }

    $row = $result->fetchObject(); // fetch(PDO::FETCH_OBJ);

// TEST SI NOMBRE DE LIGNE DU RESULT EST == 1 ALORS VERIFIER LE PASSWORD

    if ($result->rowCount()) {

        // SI PASSWORD OK REDIRECTION
        if (password_verify($_SESSION['password'], $row->password) == $_POST['password']) {
            // IL VA RETOURNER LE PASS DU FORMULAIRE, QUI SERA COMPARER AVEC L'ENCRYPTION DU PASS.

            // REMEMBER ME OR NOT ON LOGIN
            $_POST['remember-me'] = $_POST['remember-me'] ?? null;

            if ($_POST['remember-me'] == true) {
                setcookie('remember-me', 'remember-me', time() + 3600000, '/');
            } elseif ($_POST['remember-me'] == NULL) {
                setcookie('remember-me', 'remember-me', 0, '/');
            }
            // REDIRECTION
            header('location: ../index.php');
        } else {
            // REDIRECTION
            header('location: ../index.php');
            // LE LOGIN EST BON MAIS PAS LE PASSWORD
        }
    } else {
        // REDIRECTION
        header('location: ../index.php');
        // LE LOGIN EST MAUVAIS
    }

// LOGIN ALTERNATIF
} elseif(!empty($_POST['login'])) {
    // ON TEST D'ABORD LE LOGIN

    // QUERY POUR VERIFIER LA PRESENCE DU LOGIN

    try {
        $sql = "SELECT blog.users.login,
                       blog.users.password,
                       blog.users.level
                FROM blog.users
                WHERE users.login = :login";

        $result = $dbh->prepare($sql);

        $result->bindValue('login', $_POST['login'], PDO::PARAM_STR);

        $result->execute();

        // var_dump($result);echo '<br>';

        $row = $result->fetchObject(); // fetch(PDO::FETCH_OBJ);
    } catch (PDOException $e) {
        die('Erreur requete : ' . $e->getMessage());
    }

    // var_dump($row);echo '<br>';

// TEST SI NOMBRE DE LIGNE DU RESULT EST == 1 ALORS VERIFIER LE PASSWORD

    if ($result->rowCount()) {

        // SI PASSWORD OK REDIRECTION
        if (password_verify($_POST['password'], $row->password) == $_POST['password']) {
            // IL VA RETOURNER LE PASS DU FORMULAIRE, QUI SERA COMPARER AVEC L'ENCRYPTION DU PASS

            $_SESSION['login'] = $_POST['login']; // CREATION DU $_SESSION.
            $_SESSION['level'] = $row->level;

            // var_dump(($_SESSION));

            // REMEMBER ME OR NOT ON LOGIN
            $_POST['remember-me'] = $_POST['remember-me'] ?? null;

            if ($_POST['remember-me'] == true) {
                setcookie('remember-me', 'remember-me', time() + 3600000, '/');
            } elseif ($_POST['remember-me'] == NULL) {
                setcookie('remember-me', 'remember-me', 0, '/');
            }

            // REDIRECTION
            if($_SESSION['level'] == 'administrator') {
                $_SESSION['type'] = 'administration';
                header('location: ../index.php?type=administration');
            } elseif($_SESSION['level'] == 'user') {
                header('location: ../index.php');
            }
        } else {
            // REDIRECTION
            header('location: ../index.php');
            // LE LOGIN EST BON MAIS PAS LE PASSWORD
        }
    } else {
        // REDIRECTION
        header('location: ../index.php');
        // LE LOGIN EST MAUVAIS
    }
}