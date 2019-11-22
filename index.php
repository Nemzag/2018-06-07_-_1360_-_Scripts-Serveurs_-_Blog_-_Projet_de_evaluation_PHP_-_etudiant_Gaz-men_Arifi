<?php
/**
 * Created by PhpStorm.
 * User: Nemzag aka Gazmen Arifi.
 * Date: 2018-05-17
 * Time: 13:41
 */

require 'library/connection.php';

require 'inc/header.inc.php';

// LOGIQUE DE LA REQUETE

$dbh = connect();

require 'inc/request.inc.php';

// Triage des données.
?>
    <section id="sites-list" class="container">
        <div class="row">
            <div class="col">

                <?php
                if($_GET['search']) {
                    require 'inc/table-search.inc.php';
                }

                // FORMULAIRE D'INSERTION DE NOUVELLE UTILISATEUR
                elseif($_GET['tmp'] == 'user') {
                    $_SESSION['tmp'] = 'user';
                    require('forms/forms-users-insert.php');
                }

                elseif($_SESSION['level'] == 'user') {
                    require 'inc/table-list.inc.php';
                }

                // TYPE ARTICLE & ACTION
                elseif(isset($_GET['action']) && ($_GET['type'] == 'articles') && isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') { // si existe, message d'erreur si la verification absent.
                    if($_GET['action'] == 'insert')
                    {
                        require('forms/forms-articles-insert.php'); // Affiche ceci.
                    }
                    elseif($_GET['action'] == 'update')
                    {
                        require('forms/forms-articles-update.php'); // Affiche cela.
                    }
                    elseif(($_SESSION['type'] OR $_GET['type']) == 'articles')
                    {
                        require 'inc/table-list.inc.php';
                    }
                }

                // TYPE ADMINISTRATION
                elseif($_SESSION['type'] == 'administration' && isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') {
                    // var_dump($_SESSION);exit;
                    require 'inc/table-list.inc.php';
                }

                // TYPE USER & ACTION
                elseif(isset($_GET['action']) && ($_GET['type'] == 'users') && isset($_SESSION['login'])  && $_SESSION['level'] == 'administrator') {

                    if($_GET['action'] == 'insert') {
                        require('forms/forms-users-insert.php'); // Affiche ceci.
                    }
                    elseif($_GET['action'] = 'update') {
                        require('forms/forms-users-update.php'); // Affiche cela.
                    }
                    elseif(($_SESSION['type'] OR $_GET['type']) == 'articles') {
                        require 'inc/table-list.inc.php';
                    }
                }
                elseif(($_GET['type'] == 'users') && isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') {
                    require 'inc/table-list.inc.php';
                }
                else {
                    require 'inc/table-list.inc.php';
                }
                ?>

            </div>
        </div>
    </section>

<?php

require 'inc/footer.inc.php';

?>