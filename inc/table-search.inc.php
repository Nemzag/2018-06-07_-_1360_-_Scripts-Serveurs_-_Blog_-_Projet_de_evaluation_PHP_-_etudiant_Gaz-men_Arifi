<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-05-17
 * Time: 20:33
 */

require 'users-title.php';
?>
<?php $_GET['type'] = $_GET['type'] ?? null ?>

<!-- BEGIN, SEARCH, TYPE ARTICLES -->
<?php if(isset($_SESSION['login']) && $_GET['type'] == 'articles' && isset($_GET['search'])) : ?>
    <table class="table table-striped table-hover">
        <thead>
        <tr style="white-space: nowrap">
            <th scope="col"><a href="?type=articles&amp;field=title&amp;order=<?= $_GET['order'] ?>&amp;search=<?= $_GET['search']?>">Image&nbsp;<i class="fas fa-sort"></i></a>
            </th>
            <th scope="col"><a href="?type=articles&amp;field=title&amp;order=<?= $_GET['order'] ?>&amp;search=<?= $_GET['search']?>">Titre&nbsp;<i class="fas fa-sort"></i></a>
            </th>
            <th scope="col"><a href="?type=articles&amp;field=created&amp;order=<?= $_GET['order'] ?>&amp;search=<?= $_GET['search']?>">Créé&nbsp;<i class="fas fa-sort"></i></a></th>
            <th scope="col"><a href="?type=articles&amp;field=category&amp;order=<?= $_GET['order'] ?>&amp;search=<?= $_GET['search']?>">Categorie&nbsp;<i class="fas fa-sort"></i></a></th>
            <th scope="col"><a href="?type=articles&amp;field=firstName&amp;order=<?= $_GET['order'] ?>&amp;search=<?= $_GET['search']?>">Prénom&nbsp;<i class="fas fa-sort"></i></a></th>
            <th scope="col"><a href="?type=articles&amp;field=lastName&amp;order=<?= $_GET['order'] ?>&amp;search=<?= $_GET['search']?>">Nom&nbsp;<i class="fas fa-sort"></i></a></th>

            <th>Mise à jour</th>

            <th>Suppression</th>

            <th scope="col"><a href="?type=articles&amp;field=visibility&amp;order=<?= $_GET['order'] ?>&amp;search=<?= $_GET['search']?>">Visibilitée <i class="fas fa-sort"></th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch(PDO::FETCH_OBJ)) : ?>
        <tr>
            <td><img src="assets/img/<?= $row->image ?>" alt="<?= $row->image ?>" style="height: 3em; width: 4em;"></td>
            <td scope="row"><a href="article.php?type=articles&amp;id=<?= $row->id ?>"><?= $row->title ?></a></td>
            <td style="white-space: nowrap;"><?= $row->created ?></td>
            <td><?= $row->category ?></td>
            <td><?= $row->firstName ?></td>
            <td><?= $row->lastName ?></td>

            <td><a href="?action=update&amp;type=articles&amp;id=<?= $row->id ?>&amp;image=<?= $row->image ?>"><i class="fas fa-pencil-alt" style="color: green;"></i></a></td>

            <td><a href="app/app-articles-delete.php?id=<?= $row->id ?>&amp;image=<?= $row->image ?>"><i class="fas fa-times"  style="color: red;"></i></a>
            </td> <!--On le place sous la forme d'un parametre.-->

            <td><a href="app/app-visibility.php?type=articles&amp;id=<?= $row->id ?>&amp;visibility=<?= $row->visibility == 1 ? 0 : 1 ?>&amp;search=<?= $_GET['search']?>"><?= ($row->visibility == 1) ? '<i style="color: #1B5E20;" class="fas fa-eye">' : '<i style="color: #b71c1c;" class="fas fa-eye-slash"></i>'; ?></a></td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <a class="btn btn-primary btn-lg" href="index.php?type=articles" role="button">Retour</a>

<!-- BEGIN, SEARCH, TYPE USER -->
<?php elseif(isset($_SESSION['login']) && $_SESSION['type'] == 'users' && $_SESSION['level'] == 'administrator' && $_GET['search']) : ?>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col"><a href="?type=users&amp;field=firstname&amp;order=<?= $_GET['order'] ?>">Prénom&nbsp;<i class="fas fa-sort"></i></a>
            </th>
            <th scope="col"><a href="?type=users&amp;field=lastname&amp;order=<?= $_GET['order'] ?>">Nom :&nbsp;<i class="fas fa-sort"></i></a></th>
            <th scope="col"><a href="?type=users&amp;field=mail&amp;order=<?= $_GET['order'] ?>">Mail&nbsp;<i class="fas fa-sort"></i></a></th>
            <th scope="col"><a href="?type=users&amp;field=login&amp;order=<?= $_GET['order'] ?>">Login&nbsp;<i class="fas fa-sort"></i></a></th>
            <th scope="col"><a href="?type=users&amp;field=password&amp;order=<?= $_GET['order'] ?>">Password &nbsp;<i class="fas fa-sort"></i></a></th>
            <th scope="col"><a href="?type=users&amp;field=level&amp;order=<?= $_GET['order'] ?>">Level &nbsp;<i class="fas fa-sort"></i></a></th>

            <th>Mise à jour</th>

            <th>Suppression</th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = $resultUsers->fetch(PDO::FETCH_OBJ)) : ?>
        <tr>
            <th><?= $row->firstName ?></a></th>
            <td><?= $row->lastName ?></td>
            <td><a href="mailto:<?= $row->mail ?>?subject=Blog"><?= $row->mail ?></a></td>
            <td><?= $row->login ?></td>
            <td><?= strrchr('$2y$10$', $row->password) ?>...</td>
            <td><?= $row->level ?>...</td>

            <td><a href="?action=update&amp;type=users&amp;id=<?= $row->id ?>&amp;image=<?= $row->image ?>"><i class="fas fa-pencil-alt" style="color: green;"></i></a></td>

            <td><a href="app/app-users-delete.php?id=<?= $row->id ?>"><i class="fas fa-times" style="color: red;"></i></a>
            </td> <!--On le place sous la forme d'un parametre.-->

        </tr>
        <?php endwhile; ?>
    </tbody>
</table>
<a class="btn btn-primary btn-lg" href="index.php?type=users" role="button">Retour</a>

<?php else : ?>
    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col"><a href="?field=title&amp;order=<?= $_GET['order'] ?>&amp;search=<?= $_GET['search']?>">Image&nbsp;<i class="fas fa-sort"></i></a>
            </th>
            <th scope="col"><a href="?field=title&amp;order=<?= $_GET['order'] ?>&amp;search=<?= $_GET['search']?>">Titre&nbsp;<i class="fas fa-sort"></i></a>
            </th>
            <th scope="col"><a href="?field=created&amp;order=<?= $_GET['order'] ?>&amp;search=<?= $_GET['search']?>">Créé&nbsp;<i class="fas fa-sort"></i></a></th>
            <th scope="col"><a href="?field=category&amp;order=<?= $_GET['order'] ?>&amp;search=<?= $_GET['search']?>">Categorie&nbsp;<i class="fas fa-sort"></i></a></th>
            <th scope="col"><a href="?field=firstName&amp;order=<?= $_GET['order'] ?>&amp;search=<?= $_GET['search']?>">Prénom&nbsp;<i class="fas fa-sort"></i></a></th>
            <th scope="col"><a href="?field=lastName&amp;order=<?= $_GET['order'] ?>&amp;search=<?= $_GET['search']?>">Nom&nbsp;<i class="fas fa-sort"></i></a></th>
        </tr>
        </thead>
        <tbody>
        <?php while($row = $result->fetch(PDO::FETCH_OBJ)) : ?>
            <tr>
                <td><img src="assets/img/<?= $row->image ?>" alt="<?= $row->image ?>" style="height: 3em; width: 4em;"></td>
                <th scope="row"><a href="article.php?id=<?= $row->id ?>"><?= $row->title ?></a></th>
                <td style="white-space: nowrap;"><?= $row->created ?></td>
                <td><?= $row->category ?></td>
                <td><?= $row->firstName ?></td>
                <td><?= $row->lastName ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
    <a class="btn btn-primary btn-lg" href="index.php#" role="button">Retour</a>

<?php endif; ?>