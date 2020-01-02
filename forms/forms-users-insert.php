<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-05-30
 * Time: 15:43
 */

// BEGIN SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
if(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') :

// TRY AND CATCH
try {
    $sql = "SELECT *
            FROM 2018_blog.users
            GROUP BY 2018_blog.users.level
            ORDER BY 2018_blog.users.level";

    $resultInsertUsers = $dbh->prepare($sql);

    $resultInsertUsers->execute();
} catch (PDOException $e) {
    die('Error : ' . $e->getMessage());
}
?>

<form action="app/app-users-insert.php" method="post" enctype="multipart/form-data">

    <!-- Level -->
    <div class="form-group">
        <select class="form-control" id="level" name="level" title="level" required>
            <?php while ($row = $resultInsertUsers->fetch(PDO::FETCH_OBJ)) : ?>
                <option value="<?= $row->level ?>" selected><?= $row->level ?></option>
            <?php endwhile; ?>
        </select>
    </div>

    <!-- FirstName -->
    <div class="form-group">
        <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Inséré le prénom." required>
    </div>

    <!-- LastName -->
    <div class="form-group">
        <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Inséré le nom." required>
    </div>

    <!-- Mail -->
    <div class="form-group">
        <input type="email" class="form-control" id="mail" name="mail" placeholder="Inséré l'email." required>
    </div>

    <!-- Login -->
    <div class="form-group">
        <input type="text" class="form-control" id="login" name="login" placeholder="Inséré le login.">
    </div>

    <!-- Login -->
    <div class="form-group">
        <input type="password" class="form-control" id="login" name="password" placeholder="Inséré le password.">
    </div>

    <button type="submit" class="btn btn-primary">Envoyer</button>
    <br>
    <br>
    <a class="btn btn-primary btn-lg" href="index.php?type=users" role="button">Retour</a>

</form>

<!-- Level -->
<?php elseif($_SESSION['tmp'] == 'user' && !isset($_SESSION['login'])) :

// TRY AND CATCH
    try {
        $sql = "SELECT *
                FROM 2018_blog.users
                GROUP BY 2018_blog.users.level
                ORDER BY 2018_blog.users.level";

        $resultInsertUsers = $dbh->prepare($sql);

        $resultInsertUsers->execute();
    } catch (PDOException $e) {
        die('Error : ' . $e->getMessage());
    }
    ?>
    <form action="app/app-users-insert.php" method="post" enctype="multipart/form-data">

            <div class="form-group">
                <select class="form-control" id="level" name="level" title="level" readonly>
                        <option value="user" selected>Utilisateur</option>
                </select>
            </div>

        <!-- FirstName -->
        <div class="form-group">
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Inséré le prénom." required>
        </div>

        <!-- LastName -->
        <div class="form-group">
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Inséré le nom." required>
        </div>

        <!-- Mail -->
        <div class="form-group">
            <input type="email" class="form-control" id="mail" name="mail" placeholder="Inséré l'email." required>
        </div>

        <!-- Login -->
        <div class="form-group">
            <input type="text" class="form-control" id="login" name="login" placeholder="Inséré le login." required>
        </div>

        <!-- Login -->
        <div class="form-group">
            <input type="password" class="form-control" id="login" name="password" placeholder="Inséré le password." required>
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
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
