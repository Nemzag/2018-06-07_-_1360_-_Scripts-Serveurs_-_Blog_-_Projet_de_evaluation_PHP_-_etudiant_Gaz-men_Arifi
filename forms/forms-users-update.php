<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-05-30
 * Time: 15:24
 */

// BEGIN SECURISATION BY INVISIBLE CONTENT WITHOUT LOGIN
if (isset($_SESSION['login']) && $_SESSION['level'] == 'administrator') :

// TRY AND CATCH
    try {
        $sql = "SELECT 2018_blog.users.id,
                       2018_blog.users.firstName,
                       2018_blog.users.lastName,
                       2018_blog.users.mail,
                       2018_blog.users.login,
                       2018_blog.users.password,
                       2018_blog.users.level
                FROM 2018_blog.users
                WHERE 2018_blog.users.id = :id";

        $resultUpdate = $dbh->prepare($sql);

        $resultUpdate->bindValue('id', $_GET['id'], PDO::PARAM_INT);

        $resultUpdate->execute();

        $rowUsers = $resultUpdate->fetch(PDO::FETCH_OBJ);
        $resultUpdate->execute();

    } catch (PDOException $e) {
        die('Error : ' . $e->getMessage());
    }

    ?>

    <form action="app/app-users-update.php" method="post">

        <!-- Level -->
        <div class="form-group">
            <select class="form-control" id="level" name="level" title="level" required>
                    <option value="administrator" <?= $rowUsers->level == 'administrator' ? 'selected' : '' ?>>Administrateur</option>
                    <option value="user" <?= $rowUsers->level == 'user' ? 'selected' : '' ?>>Utilisateur</option>
            </select>
        </div>

        <!-- idUser -->
        <div class="form-group">
            <input type="hidden" class="form-control" id="id" name="id" value="<?= $rowUsers->id ?>" placeholder=""
                   readonly>
        </div>

        <!-- FirstName -->
        <div class="form-group">
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Inséré le prénom." value="<?= $rowUsers->firstName ?>"
                   required>
        </div>

        <!-- LastName -->
        <div class="form-group">
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Inséré le nom." value="<?= $rowUsers->lastName ?>" required>
        </div>

        <!-- Mail -->
        <div class="form-group">
            <input type="email" class="form-control" id="mail" name="mail" placeholder="Inséré l'email." value="<?= $rowUsers->mail ?>" required>
        </div>

        <!-- Login -->
        <div class="form-group">
            <input type="text" class="form-control" id="login" name="login" placeholder="Inséré le login." value="<?= $rowUsers->login ?>">
        </div>

        <!-- Login -->
        <div class="form-group">
            <input type="password" class="form-control" id="login" name="password" placeholder="Inséré le password." value="<?= $rowUsers->firstName ?>">
        </div>

        <button type="submit" class="btn btn-primary">Envoyer</button>
        <br>
        <br>
        <a class="btn btn-primary btn-lg" href="index.php?type=users" role="button">Retour</a>

    </form>

<?php endif; ?>