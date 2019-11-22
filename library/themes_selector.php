<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-05-28
 * Time: 09:44
 */

function themesSelector() {

    /*
    setcookie('themes', '1');
    // ligne permettant de supprimer le cookie.
    // Afin de tester la fonctionnalité du reste.
    setcookie('themes', '1', time()-3600);
    */

    if(!isset($_COOKIE['themes'])) {
        global $themes;
        $themes = ($_GET['themes'] = 'bootstrap.slate.min.css');
    }

    if(isset($_GET['themes'])) {
        global $themes;
        $themes = $_GET['themes'];
        setcookie('themes', $_GET['themes']);
    }
    elseif(!isset($_GET['themes'])) {
        global $themes;
        $themes = ($_GET['themes'] = 'bootstrap.slate.min.css');
        $themes = ($_SESSION['themes'] = $_COOKIE['themes']);
    }
}