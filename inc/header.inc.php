<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-05-17
 * Time: 14:15
 */

// Start Session
session_start();

// Start Themes
require 'library/themes_selector.php';
require 'app/app-pagination.php';
themesSelector();

echo '<br>';

$_SESSION['level'] = $_SESSION['level'] ?? null;
$_SESSION['login'] = $_SESSION['login'] ?? null;
$_SESSION['type'] = $_SESSION['type'] ?? null;
$_GET['type'] = $_GET['type'] ?? $_SESSION['type'];
$_GET['level'] = $_GET['level'] ?? $_SESSION['level'];
$_GET['tmp'] = $_GET['tmp'] ?? null;

$perPage = $perPage ?? null;;
$firstOfPage = $firstOfPage ?? null;
// var_dump($_GET);echo '<br>';
// var_dump($_SESSION);echo '<br>';

// TEST CONDITIONNEL SI LOGIN & LEVEL SET
if(isset($_SESSION['login']) && ($_SESSION['level'] == 'administrator')) {

    if($_GET['type'] == 'administration' && $_SESSION['level'] == 'administrator') {
        $_SESSION['type'] = 'administration';

    } elseif ($_GET['type'] == 'articles' && $_SESSION['level'] == 'administrator') {
        $_SESSION['type'] =  'articles';

    } elseif ($_GET['type'] == 'users' && $_SESSION['level'] == 'administrator') {
        $_SESSION['type'] = 'users';

    } else {
    $_SESSION['type'] = null;
    }
}
// Start Login & Password
/*
require 'library/login_password.php';
login_password();
*/

?>
<!doctype html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog de Arifi Gazmen</title>
    <!--
    <link rel="stylesheet" href="css/bootstrap.min.css">
    -->
    <link rel="stylesheet" href="css/<?= $themes ?>">
    <link rel="stylesheet" href="css/style.css">
    <script defer src="https://use.fontawesome.com/releases/v5.0.10/js/all.js" integrity="sha384-slN8GvtUJGnv6ca26v8EzVaR9DC58QEwsIk9q1QXdCU8Yu8ck/tL/5szYlBbqmS+" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Blog de Arifi Gazmen</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?<?= (isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') ? 'type=administration' : ''; ?>">Page d'accueil<span class="sr-only">(current)</span></a>
                </li>
                <!--
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                -->

                <?php if(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') : ?>
                <!-- Begin Menu Admin Modification -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Modi‑fication
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                        <a class="dropdown-item" href="index.php?type=articles">Modifier article</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php?type=users&field=none">Modifier utilisateur</a>
                    <!-- End Menu Admin Modification -->
                    </div>
                </li>

                <?php elseif(isset($_SESSION['login']) && $_SESSION['level'] == 'user') : ?>
                    <!-- Begin Menu Profile -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Pro‑fil
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                            <a class="dropdown-item" href="#">Configurer profile<br><i>(Lien pour l'exemple)<br>(Non fonctionnel)<br>(Non requis dans le readme.)</i></a>
                            <!-- End Menu Admin -->
                        </div>
                    </li>
                <?php endif; ?>

                <!--
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
                -->
            </ul>

            <!-- MENU LOG-IN -->
            <?php if(empty($_SESSION['login']) && empty($_SESSION['level'])) : ?>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Log‑in
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <!-- Begin Form -->
                        <form class="px-4 py-3" action="app/app-login.php?" method="post" style="width: 16em;">
                            <div class="form-group" >
                                <label for="login">Login (Pat ou Utilisateur)</label>
                                <input type="text" class="form-control" id="login" name="login" placeholder="Inséré votre login." required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password (Pat ou Utilisateur)</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Inséré votre password" required>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" title="remember-me" id="remember-me" name="remember-me">
                                <label class="form-check-label" for="dropdownCheck">
                                    Ce souvenir de moi
                                </label>
                            </div>
                            <button type="submit" class="btn btn-primary">Accédé</button>

                            <div class="dropdown-divider"></div>

                            <!-- Inscription au Site en tant que User -->
                            <div class="form-group" >
                                <a href="index.php?tmp=user">Inscription comme User...</a>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
            <?php endif; ?>
            <!-- End Form -->

            <!-- Begin Menu LogOut -->
            <?php if(isset($_SESSION['login']) || isset($_SESSION['level'])) : ?>
            <ul class="navbar-nav">
                <li class="nav-item dropdown">

                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Log‑Out
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="app/app-logout.php" >Déconnexion de <?= $_SESSION['login'] ?>...</a>
                    </div>
                </li>
            </ul>

            <?php elseif($_SESSION['level'] == 'user' && !isset($_SESSION['level'])) : ?>
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <!-- Begin Menu LogOut -->
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Log‑Out
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="app/app-logout.php" >Déconnexion de <?= $_SESSION['login'] ?>...</a>
                        </div>
                    </li>
                </ul>
            <?php endif; ?>

            <form class="form-inline my-2 my-lg-0" action="index.php?" method="get">
                <select class="form-control mr-sm-2" placeholder="Themes" id="themes" aria-label="Themes" name="themes" onchange="this.form.submit()">
                    <option value="0">Themes</option>
                        <option value="bootstrap.min.css">Default</option>
                        <option value="bootstrap.cyborg.min.css">Cyborg</option>
                        <option value="bootstrap.darkly.min.css">Darkly</option>
                        <option value="bootstrap.flatly.min.css">Flatly</option>
                        <option value="bootstrap.journal.min.css">Journal</option>
                        <option value="bootstrap.lux.min.css">Lux</option>
                        <option value="bootstrap.material.min.css">Material</option>
                        <option value="bootstrap.minty.min.css">Minty</option>
                        <option value="bootstrap.slate.min.css">Slate</option>
                        <option value="bootstrap.solar.min.css">Solar</option>
                        <option value="bootstrap.united.min.css">United</option>
                        <option value="bootstrap.yeti.min.css">Yeti</option>
                </select>
            </form>

            <form class="form-inline my-2 my-lg-0"
                <?php

                $_SESSION['type'] = $_SESSION['type'] ?? null;

                if($_SESSION['type'] == 'administration') {
                    echo 'action="app/app-search.php?type=administration"';
                } elseif($_SESSION['type'] == 'articles') {
                    echo 'action="app/app-search.php?type=articles"';
                } elseif($_SESSION['type'] == 'users') {
                    echo 'action="app/app-search.php?type=users"';
                } else {
                    echo 'action="app/app-search.php"';
                }?> method="get">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</header>
<main>