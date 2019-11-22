<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-05-17
 * Time: 20:31
 */

$title = $titles ?? null;
?>
<?php // var_dump($_GET['type']); ?>
<?php // var_dump($_SESSION['type']); ?>

<!-- DISPLAY TYPE NONE, LEVEL ADMINISTRATOR -->
<?php if (isset($_GET['themes']) && isset($_SESSION['login']) && (!isset($_GET['type'])) && (!isset($_SESSION['type'])) && $_SESSION['level'] == 'administrator') : ?>
    <h1 class="display-4">Administration</h1>
    <h2><span class="badge badge-info"><?= $numberSite ?></span>
        <?php var_dump($_SESSION); ?>
        <?php echo ($numberSite <= 1) ? 'site' : 'sites' ?></h2>
    <!-- Ternaire pour Site ou Sites, un detail. -->

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col"><a href="?type=administration&amp;field=title&amp;order=<?= $_GET['order'] ?>">Image&nbsp;<i
                            class="fas fa-sort"></i></a>
            </th>
            <th scope="col"><a href="?type=administration&amp;field=title&amp;order=<?= $_GET['order'] ?>">Titre&nbsp;<i
                            class="fas fa-sort"></i></a>
            </th>
            <th scope="col"><a
                        href="?type=administration&amp;field=created&amp;order=<?= $_GET['order'] ?>">Créé&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a href="?type=administration&amp;field=category&amp;order=<?= $_GET['order'] ?>">Categorie&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?type=administration&amp;field=firstName&amp;order=<?= $_GET['order'] ?>">Prénom&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?type=administration&amp;field=lastName&amp;order=<?= $_GET['order'] ?>">Nom&nbsp;<i
                            class="fas fa-sort"></i></a></th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch(PDO::FETCH_OBJ)) : ?>
            <tr>
                <td><img src="assets/img/<?= $row->image ?>" alt="<?= $row->image ?>" style="height: 3em; width: 4em;">
                </td>
                <td scope="row"><a href="article.php?type=administration&amp;id=<?= $row->id ?>"><?= $row->title ?></a>
                </td>
                <td style="white-space: nowrap;"><?= $row->created ?></td>
                <td><?= $row->category ?></td>
                <td><?= $row->firstName ?></td>
                <td><?= $row->lastName ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php endif; ?>

<!-- DISPLAY TYPE ADMINISTRATION LEVEL ADMINISTRATOR -->
<?php if (isset($_SESSION['login']) && $_GET['type'] == 'administration' && $_SESSION['level'] == 'administrator') : ?>
    <h1 class="display-4">Administration</h1>

    <?php require 'inc/pagination.inc.php'; ?>

    <h2><span class="badge badge-info"><?= $numberSite ?></span>
        <?php echo ($numberSite <= 1) ? 'site' : 'sites' ?></h2>
    <!-- Ternaire pour Site ou Sites, un detail. -->

    <?php // var_dump($_SESSION['type']); ?>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col"><a
                        href="?type=administration&amp;field=title&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Images&nbsp;<i
                            class="fas fa-sort"></i></a>
            </th>
            <th scope="col"><a
                        href="?type=administration&amp;field=title&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Titre&nbsp;<i
                            class="fas fa-sort"></i></a>
            </th>
            <th scope="col"><a
                        href="?type=administration&amp;field=created&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Créé&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?type=administration&amp;field=category&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Categorie&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?type=administration&amp;field=firstName&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Prénom&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?type=administration&amp;field=lastName&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Nom&nbsp;<i
                            class="fas fa-sort"></i></a></th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch(PDO::FETCH_OBJ)) : ?>
            <tr>
                <td><img src="assets/img/<?= $row->image ?>" alt="<?= $row->image ?>" style="height: 3em; width: 4em;">
                </td>
                <td scope="row"><a href="article.php?type=administration&amp;id=<?= $row->id ?>"><?= $row->title ?></a>
                </td>
                <td style="white-space: nowrap;"><?= $row->created ?></td>
                <td><?= $row->category ?></td>
                <td><?= $row->firstName ?></td>
                <td><?= $row->lastName ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php endif; ?>

<!-- DISPLAY, TYPE ARTICLES, LEVEL ADMINISTRATOR -->
<?php if (isset($_SESSION['login']) && ($_SESSION['type']) == 'articles' && $_SESSION['level'] == 'administrator') : ?>
    <h1 class="display-4">Administration des articles</h1>

    <p class="lead">
        <a class="btn btn-primary btn-lg" href="?action=insert&type=articles" role="button">Inséré Articles</a>
        <!--action-->
    </p>

    <?php require 'inc/pagination.inc.php'; ?>

    <h2><span class="badge badge-info"><?= $numberSite ?></span>
        <?php echo ($numberSite <= 1) ? 'site' : 'sites' ?></h2>
    <!-- Ternaire pour Site ou Sites, un detail. -->

    <table class="table table-striped table-hover">
        <thead>
        <tr style="white-space: nowrap">
            <th scope="col"><a
                        href="?type=articles&amp;field=title&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Image&nbsp;<i
                            class="fas fa-sort"></i></a>
            </th>
            <th scope="col"><a
                        href="?type=articles&amp;field=title&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Titre&nbsp;<i
                            class="fas fa-sort"></i></a>
            </th>
            <th scope="col"><a
                        href="?type=articles&amp;field=created&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Créé&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?type=articles&amp;field=category&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Categorie&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?type=articles&amp;field=firstName&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Prénom&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?type=articles&amp;field=lastName&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Nom&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th>Suppression</th>
            <th>Mise à jour</th>
            <th scope="col"><a
                        href="?type=articles&amp;field=visibility&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Visibilitée
                    <i class="fas fa-sort"></th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch(PDO::FETCH_OBJ)) : ?>
            <tr>
                <td><img src="assets/img/<?= $row->image ?>" alt="<?= $row->image ?>"
                         style="height: 3em; width: 4em;"></td>
                <td scope="row"><a href="article.php?type=articles&amp;id=<?= $row->id ?>"><?= $row->title ?></a>
                </td>
                <td style="white-space: nowrap;"><?= $row->created ?></td>
                <td><?= $row->category ?></td>
                <td><?= $row->firstName ?></td>
                <td><?= $row->lastName ?></td>
                <td><a href="app/app-articles-delete.php?id=<?= $row->id ?>&amp;image=<?= $row->image ?>"><i
                                class="fas fa-times"></i></a>
                </td> <!--On le place sous la forme d'un parametre.-->
                <td>
                    <a href="?action=update&amp;type=articles&amp;id=<?= $row->id ?>&amp;image=<?= $row->image ?>"><i
                                class="fas fa-pencil-alt"></i></a></td>
                <td>
                    <a href="app/app-visibility.php?type=articles&amp;id=<?= $row->id ?>&amp;visibility=<?= $row->visibility == 1 ? 0 : 1 ?>"><?= ($row->visibility == 1) ? '<i style="color: #1B5E20;" class="fas fa-eye"></i>' : '<i style="color: #b71c1c;" class="fas fa-eye-slash"></i>'; ?></a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php endif; ?>

<!-- DISPLAY, TYPE USERS, LEVEL ADMINISTRATOR -->
<?php if (isset($_SESSION['login']) && ($_SESSION['type']) == 'users' && $_SESSION['level'] == 'administrator') : ?>
    <h1 class="display-4">Administration des Utilisateurs</h1>
    <p class="lead">
        <a class="btn btn-primary btn-lg" href="?action=insert&type=users" role="button">Inséré utilisateur</a>
        <!--action-->
    </p>

    <?php require 'inc/pagination.inc.php'; ?>

    <h2><span class="badge badge-info"><?= $numberUsers ?></span>
        <?php echo ($numberUsers <= 1) ? 'personne' : 'personnes' ?></h2>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col"><a
                        href="?type=users&amp;field=firstname&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Prénom&nbsp;<i
                            class="fas fa-sort"></i></a>
            </th>
            <th scope="col"><a
                        href="?type=users&amp;field=lastname&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Nom
                    :&nbsp;<i class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?type=users&amp;field=mail&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Mail&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?type=users&amp;field=login&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Login&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?type=users&amp;field=password&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Password
                    &nbsp;<i class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?type=users&amp;field=level&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Level
                    &nbsp;<i class="fas fa-sort"></i></a></th>
            <th>Suppression</th>
            <th>Mise à jour</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $resultUsers->fetch(PDO::FETCH_OBJ)) : ?>
            <tr>
                <th><?= $row->firstName ?></a></th>
                <td><?= $row->lastName ?></td>
                <td><a href="mailto:<?= $row->mail ?>?subject=Blog"><?= $row->mail ?></a></td>
                <td><?= $row->login ?></td>
                <td><?= strrchr('$2y$10$', $row->password) ?>...</td>
                <td><?= $row->level ?>...</td>
                <td><a href="app/app-users-delete.php?id=<?= $row->id ?>"><i class="fas fa-times"></i></a>
                </td> <!--On le place sous la forme d'un parametre.-->
                <td><a href="?action=update&amp;type=users&amp;id=<?= $row->id ?>"><i class="fas fa-pencil-alt"></i></a>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php endif; ?>

<!-- DISPLAY, TYPE NULL, LEVEL VISITOR -->
<?php if ($_GET['type'] == null && !isset($_SESSION['login'])) : ?>
    <?php require 'users-title.php'; ?>
    <?php require 'pagination.inc.php'; ?>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col"><a
                        href="?field=title&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Image&nbsp;<i
                            class="fas fa-sort"></i></a>
            </th>
            <th scope="col"><a
                        href="?field=title&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Titre&nbsp;<i
                            class="fas fa-sort"></i></a>
            </th>
            <th scope="col"><a
                        href="?field=created&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Créé&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?field=category&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Categorie&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?field=firstName&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Prénom&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?field=lastName&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Nom&nbsp;<i
                            class="fas fa-sort"></i></a></th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch(PDO::FETCH_OBJ)) : ?>
            <tr>
                <td><img src="assets/img/<?= $row->image ?>" alt="<?= $row->image ?>"
                         style="height: 3em; width: 4em;"></td>
                <td scope="row"><a href="article.php?id=<?= $row->id ?>"><?= $row->title ?></a></td>
                <td style="white-space: nowrap;"><?= $row->created ?></td>
                <td><?= $row->category ?></td>
                <td><?= $row->firstName ?></td>
                <td><?= $row->lastName ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php endif; ?>

<!-- AFFICHAGE STANDARD USER LOGGED -->
<?php if ($_GET['type'] == null && isset($_SESSION['login']) && $_SESSION['level'] == 'user') : ?>
    <?php require 'users-title.php'; ?>
    <?php require 'pagination.inc.php'; ?>

    <table class="table table-striped table-hover">
        <thead>
        <tr>
            <th scope="col"><a
                        href="?field=title&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Image&nbsp;<i
                            class="fas fa-sort"></i></a>
            </th>
            <th scope="col"><a
                        href="?field=title&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Titre&nbsp;<i
                            class="fas fa-sort"></i></a>
            </th>
            <th scope="col"><a
                        href="?field=created&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Créé&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?field=category&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Categorie&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?field=firstName&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Prénom&nbsp;<i
                            class="fas fa-sort"></i></a></th>
            <th scope="col"><a
                        href="?field=lastName&amp;order=<?= $_GET['order'] ?>&amp;page=<?= $_GET['page'] ?>&amp;perpage=<?= $_GET['perpage'] ?>">Nom&nbsp;<i
                            class="fas fa-sort"></i></a></th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch(PDO::FETCH_OBJ)) : ?>
            <tr>
                <td><img src="assets/img/<?= $row->image ?>" alt="<?= $row->image ?>"
                         style="height: 3em; width: 4em;"></td>
                <td scope="row"><a href="article.php?id=<?= $row->id ?>"><?= $row->title ?></a></td>
                <td style="white-space: nowrap;"><?= $row->created ?></td>
                <td><?= $row->category ?></td>
                <td><?= $row->firstName ?></td>
                <td><?= $row->lastName ?></td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
<?php endif; ?>

