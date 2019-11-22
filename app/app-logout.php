<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-05-29
 * Time: 16:26
 */

session_start(); // BEGIN SESSION

// BEGIN SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
if(isset($_SESSION['login']) || isset($_SESSION['level'])) :

    // JE DETUITS LA SESSION
    unset($_SESSION['login']);
    unset($_SESSION['level']);
    unset($_SESSION['type']);

    // JE REDIRIGE
    header('location: ../index.php');

// END SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
else :
// RETURN TO INDEX
    header('location: ../index.php');
// END SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
endif;
?>
