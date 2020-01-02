<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-05-29
 * Time: 17:10
 */

// BEGIN SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
if(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') :

// TRY AND CATCH
try {
    $sql = "SELECT 2018_blog.posts.idCategory, 2018_blog.categories.category
			FROM 2018_blog.categories
			LEFT JOIN 2018_blog.posts
			ON 2018_blog.posts.idCategory = 2018_blog.categories.id
			GROUP BY 2018_blog.categories.category
			ORDER BY 2018_blog.categories.category";

    $resultCategory = $dbh->query($sql);

    $sql = "SELECT *
        FROM 2018_blog.users
        WHERE 2018_blog.users.login = :veriflogin";

    $resultLogin = $dbh->prepare($sql);

    $resultLogin->bindValue(':veriflogin', $_SESSION['login'], PDO::PARAM_STR);

    $resultLogin->execute();
}
catch (PDOException $e) {
    die('Error : '.$e->getMessage());
}
?>

<form action="app/app-articles-insert.php" method="post" enctype="multipart/form-data">

    <!-- FirstName -->
    <div class="form-group">
        <?php while ($row = $resultLogin->fetch(PDO::FETCH_OBJ)) : ?>
        <input type="text" class="form-control" id="firstName"  placeholder="Inséré votre prénom." value="<?= $row->firstName ?>" title="Inséré votre prénom." readonly>
    </div>

    <!-- LastName -->
    <div class="form-group">
        <input type="text" class="form-control" id="lastName" placeholder="Inséré votre nom." value="<?= $row->lastName ?>" readonly>
    </div>

    <!-- idUser -->
    <div class="form-group">
        <input type="hidden" class="form-control" id="idUser" name="idUser" value="<?= $row->id ?>" placeholder="">
    </div>
    <?php endwhile; ?>

    <!-- Date -->
    <div class="form-group">
        <input type="date" class="form-control" id="created" name="created" title="" value="<?php $date = new DateTime(); echo $date->format('Y-m-d'); ?>">
    </div>

    <!-- Visibility -->
    <div class="form-group">
        <select class="form-control" id="visibility" name="visibility" title="visibility" required>
            <option value="1" selected>Article visible</option>
            <option value="0">Article invisible</option>
        </select>
    </div>

    <!-- Title -->
    <div class="form-group">
        <input type="text" class="form-control" id="title" name="title" placeholder="Inséré le titre." title="Inséré le titre." required>
    </div>

    <!-- Content -->
    <div class="form-group">
        <textarea class="form-control" id="content" name="content" placeholder="Inséré le contenue." title="Inséré le contenue." rows="5" required></textarea>
    </div>

    <!-- Image -->
    <div class="form-group">
        <input type="file" class="form-control" id="image" name="image" placeholder="Inséré votre image." value="Inséré votre image.">
    </div>

    <!-- Category -->
    <div class="form-group">
        <select class="form-control" id="idCategory" name="idCategory" title="" required>
            <option value="<?= null ?>">Sélectionnez la catégorie...</option>
            <?php while ($row = $resultCategory->fetch(PDO::FETCH_OBJ)) : ?>
                <option value="<?= $row->idCategory ?>"><?= $row->category ?></option >
            <?php endwhile; ?>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Envoyer</button><br>
    <br>
    <a class="btn btn-primary btn-lg" href="index.php?type=articles" role="button">Retour</a>

</form>


<?php
else :
// RETURN TO INDEX
    header('location: ../index.php');
// END SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
endif; ?>
