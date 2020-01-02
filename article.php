<?php
/**
 * Created by PhpStorm.
 * User: Nemzag aka Gazmen Arifi.
 * Date: 2018-05-17
 * Time: 14:09
 */

require 'library/connection.php';

require 'inc/header.inc.php';

$dbh = connect();

require 'inc/request.inc.php';
?>
<br>
<section id="sites-list" class="container">

    <article class="jumbotron">
        <?php while ($row = $result->fetch(PDO::FETCH_OBJ)) : ?>

        <h1 class="display-4"><?= $row->title ?></h1>
        <p></p>
        <p class="lead">
            <time datetime="<?= $row->created ?>"><?= $row->created ?></time>
            ‒ Auteur : <a href="profil.php?id=<?= $row->id ?>"><?= $row->lastName ?> <?= $row->firstName ?></a> ‒ Contact : <a
                    href="mailto:<?= $row->mail ?>?Subject=Blog"><?= $row->mail ?></a></p>
        <img src="assets/img/<?= $row->image ?>" alt="..." class="img-thumbnail" style="height: 250px;">

        <hr class="my-4">

        <p><?= nl2br($row->content) ?></p>

        <!-- Programme adaptif de redirection des Liens. -->
        <a class="btn btn-primary btn-lg" href="index.php?<?= (isset($_SESSION['login']) && ($_GET['type'] == 'articles')) ? 'type=articles' : ''; ?><?= (isset($_SESSION['login']) && ($_GET['type'] == 'administration')) ? 'type=administration' : ''; ?>" role="button">Retour</a>

    </article>
    <?php endwhile; ?>
</section>

<?php

require 'inc/footer.inc.php';

?>