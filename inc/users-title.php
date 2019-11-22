<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-05-29
 * Time: 19:47
 */

// BEGIN SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
if(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') :

    // BEGIN ADMINISTRATION DISPLAY
    if($_SESSION['type'] == 'administration') : ?>
    <h1 class="display-4">Administration</h1>

    <h2><span class="badge badge-info"><?= $numberSite ?></span>
        <?php echo ($numberSite <= 1) ? 'site' : 'sites' ?></h2>

    <!-- Begin Articles Display -->
    <?php elseif($_SESSION['type'] == 'articles') : ?>
        <h1 class="display-4">Administration des articles</h1>

        <p class="lead">
            <a class="btn btn-primary btn-lg" href="?action=insert&type=articles" role="button">Inséré Articles</a>
            <!--action-->
        </p>

        <h2><span class="badge badge-info"><?= $numberSite ?></span>
            <?php echo ($numberSite <= 1) ? 'site' : 'sites' ?></h2>

        <!-- BEGIN USERS DISPLAY -->
    <?php elseif($_SESSION['type'] == 'users') : ?>
        <h1 class="display-4">Administration des utilisateurs</h1>

        <p class="lead">
            <a class="btn btn-primary btn-lg" href="?action=insert&type=users" role="button">Inséré utilisateur</a>
            <!--action-->

        <h2><span class="badge badge-info"><?= $numberSite ?></span>
            <?php echo ($numberSite <= 1) ? 'personne' : 'personnes' ?></h2>


        <!-- BEGIN THEMES DISPLAY -->
    <?php elseif(isset($_GET['themes']) && !isset($_SESSION['type'])) : ?>
        <h1 class="display-4">Administration</h1>

        <h2><span class="badge badge-info"><?= $numberSite ?></span>
            <?php echo ($numberSite <= 1) ? 'site' : 'sites' ?></h2>

    <!-- Begin Blog Display -->
    <?php else : ?>
    <h1 class="display-4">Blog</h1>

    <h2><span class="badge badge-info"><?= $numberSite ?></span>
        <?php echo ($numberSite <= 1) ? 'site' : 'sites' ?></h2>

    <?php endif; ?>

<?php else : ?>
    <h1 class="display-4">Blog</h1>

    <h2><span class="badge badge-info"><?= $numberSite ?></span>
        <?php echo ($numberSite <= 1) ? 'site' : 'sites' ?></h2>
<?php endif; ?>
