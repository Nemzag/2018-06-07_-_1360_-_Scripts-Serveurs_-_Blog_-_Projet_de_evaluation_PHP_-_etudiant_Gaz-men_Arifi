<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-05-30
 * Time: 13:06
 */

session_start(); // BEGIN SESSION

// BEGIN SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
if(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') {

    $_GET['type'] = $_GET['type'] ?? null;

    if (isset($_SESSION['login']) && $_GET['search'] && ($_SESSION['type'] == 'administration')) {
        header('location: ../index.php?type=administration&search=' . $_GET['search'] . '');
    } elseif (isset($_SESSION['login']) && $_GET['search'] && ($_SESSION['type'] == 'articles')) {
        header('location: ../index.php?type=articles&search=' . $_GET['search'] . '');
    } elseif (isset($_SESSION['login']) && $_GET['search'] && ($_SESSION['type'] == 'users')) {
        header('location: ../index.php?type=users&search=' . $_GET['search'] . '');
    } elseif (isset($_SESSION['login']) && $_GET['search'] && (isset($_SESSION['themes']))) {
        header('location: ../index.php?type=administration&search=' . $_GET['search'] . '');
    }
}
elseif(isset($_SESSION['login']) && $_SESSION['level'] == 'user' && ($_GET['search'])) {
    header('location: ../index.php?search='.$_GET['search'].'');
} else {
    if (!isset($_SESSION['login']) && ($_GET['search'])) {
        header('location: ../index.php?search=' . $_GET['search'] . '');
    }
}

// END SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN