<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-05-29
 * Time: 17:09
 */

// BEGIN SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
if(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') :

// TRY AND CATCH
try {

    $sql = "SELECT 2018_blog.posts.idCategory, 2018_blog.categories.category
        FROM 2018_blog.categories
        LEFT JOIN 2018_blog.posts
        ON 2018_blog.posts.idCategory = 2018_blog.categories.id
        GROUP BY category
        ORDER BY category";

    $resultCategory = $dbh->prepare($sql);
    $resultCategory->bindValue('id', $_GET['id'], PDO::PARAM_INT);
    $resultCategory->execute();

    $sql = "SELECT 2018_blog.posts.id,
                   2018_blog.posts.title,
                   2018_blog.posts.content,
                   2018_blog.posts.created,
                   2018_blog.posts.image,
                   2018_blog.posts.idCategory,
                   2018_blog.posts.idUser,
                   2018_blog.posts.visibility,
                   2018_blog.users.firstName,
                   2018_blog.users.lastName
            FROM 2018_blog.posts
            LEFT JOIN 2018_blog.users ON 2018_blog.posts.idUser = 2018_blog.users.id
            WHERE 2018_blog.posts.id = :id";

    $resultUpdate = $dbh->prepare($sql);

    $resultUpdate->bindValue('id', $_GET['id'], PDO::PARAM_INT);

    $resultUpdate->execute();
}
catch (PDOException $e) {
    die('Error : '.$e->getMessage());
}
?>

<form action="app/app-articles-update.php" method="post" enctype="multipart/form-data">

    <!-- FirstName -->
    <div class="form-group">
        <?php while ($row = $resultUpdate->fetch(PDO::FETCH_OBJ)) : ?>
        <input type="text" class="form-control" id="firstName"  placeholder="Inséré votre prénom." title="Inséré votre prénom." value="<?= $row->firstName ?>" disabled>
    </div>

    <!-- LastName -->
    <div class="form-group">
        <input type="text" class="form-control" id="lastName" placeholder="Inséré votre nom." title="Inséré votre nom." value="<?= $row->lastName ?>" disabled>
    </div>

    <!-- idUser -->
    <div class="form-group">
        <input type="hidden" class="form-control" id="idUser" name="idUser" value="<?= $row->id ?>" placeholder="" readonly>
    </div>

    <!-- Date -->
    <div class="form-group">
        <input type="date" class="form-control" id="created" name="created" title="" value="<?= $row->created ?>">
    </div>

    <!-- Visibility -->
    <div class="form-group">
        <select class="form-control" id="visibility" name="visibility" title="visibility" required>
            <option value="1" <?= ($row->visibility == 1) ? 'selected' : ''; ?>>Article visible</option>
            <option value="0" <?= ($row->visibility == 0) ? 'selected' : ''; ?>>Article invisible</option>
        </select>
    </div>

    <!-- Title -->
    <div class="form-group">
        <input type="text" class="form-control" id="title" name="title" placeholder="Inséré le titre." title="Inséré le titre." value="<?= $row->title ?>" required>
    </div>

    <!-- Content -->
    <div class="form-group">
        <textarea class="form-control" id="content" name="content" placeholder="Inséré le contenue." title="Inséré le contenue." rows="5" required><?= $row->content ?></textarea>
    </div>

    <!-- Image -->
    <div class="form-group">
        <input type="file" class="form-control" id="image" name="image" placeholder="Inséré votre image." value="Inséré votre image.">
        <figure class="form-control">
            <p><?= $row->image ?></p>
            <img src="assets/img/<?= $row->image ?>" alt="" style="height: 100px;">
        </figure>
    </div>

    <div class="form-group">
        <input type="hidden" class="form-control" id="image-original" name="image-original" value="<?= $row->image ?>">
    </div>

    <!-- Category -->
    <div class="form-group">
        <select class="form-control" id="idCategory" name="idCategory" title="" required>
            <?php while ($rowCat = $resultCategory->fetch(PDO::FETCH_OBJ)) : ?>
                <option value="<?= $rowCat->idCategory ?>" <?= $rowCat->idCategory == $row->idCategory ? 'selected' : '' ?>><?= $rowCat->category ?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <!-- IdPosts -->
    <div class="form-group">
        <input type="hidden" id="idPosts" name="idPosts" value="<?= $row->id ?>">
    </div>

    <!-- End While -->
    <?php endwhile; ?>

    <button type="submit" class="btn btn-primary">Envoyer</button><br>
    <br>
    <br>
    <a class="btn btn-primary btn-lg" href="index.php?type=articles" role="button">Retour</a>

</form>
<?php
else :
// RETURN TO INDEX
    header('location: ../index.php');
// END SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
endif; ?>
