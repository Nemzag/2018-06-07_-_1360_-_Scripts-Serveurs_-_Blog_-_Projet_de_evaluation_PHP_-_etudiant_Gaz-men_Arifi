<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-05-17
 * Time: 20:45
 */

if($_GET['type'] == 'articles') {
    $_GET['field'] = $_GET['field'] ?? 'created';
} elseif($_GET['type'] == 'users') {
    $_GET['field'] = $_GET['field'] ?? 'firstName';
} else {
    $_GET['field'] = $_GET['field'] ?? 'created';
}
$_GET['order'] = $_GET['order'] ?? 'DESC';
$_GET['search'] = $_GET['search'] ?? null;
$_GET['id'] = $_GET['id'] ?? null;
$_GET['type'] = $_GET['type'] ?? null;
$_GET['administration'] = $_GET['administration'] ?? null;

try {
// FIELD ORDER

    // SORT, SECTION VISITOR & USER, SEARCH
    if ($_GET['search'] && ($_SESSION['level'] != 'administrator')) {
        $sql = "SELECT blog.posts.id,
                       blog.posts.title,
                       blog.posts.created,
                       blog.posts.image,
                       blog.categories.category,
                       blog.users.firstName,
                       blog.users.lastName
                FROM blog.posts
                LEFT JOIN blog.categories ON posts.idCategory = categories.id
                LEFT JOIN blog.users ON posts.idUser = users.id
                WHERE blog.posts.title LIKE :search
                   OR blog.posts.created LIKE :search
                   OR blog.posts.image LIKE :search
                   OR blog.categories.category LIKE :search
                   OR blog.users.firstName LIKE :search
                   OR blog.users.lastName LIKE :search
                ORDER BY {$_GET['field']} {$_GET['order']}";

        $_GET['order'] = ($_GET['order'] == 'ASC') ? 'DESC' : 'ASC';

        $result = $dbh->prepare($sql);
        $result->bindValue('search', '%' . trim($_GET['search']) . '%', PDO::PARAM_STR);

        $result->execute();

        // SORT, SECTION ADMINISTRATION, SEARCH
    } elseif ($_GET['search'] && $_SESSION['level'] == 'administrator' && ($_SESSION['type'] == 'administration')) { // ICI PROBLEME
        $sql = "SELECT blog.posts.id,
                       blog.posts.title,
                       blog.posts.created,
                       blog.categories.category,
                       blog.posts.image,
                       blog.users.firstName,
                       blog.users.lastName,
                       blog.posts.visibility
                FROM blog.posts
                LEFT JOIN blog.categories ON posts.idCategory = categories.id
                LEFT JOIN blog.users ON posts.idUser = users.id
                WHERE (blog.posts.title LIKE :search
                   OR blog.posts.created LIKE :search
                   OR blog.posts.image LIKE :search
                   OR blog.categories.category LIKE :search
                   OR blog.users.firstName LIKE :search
                   OR blog.users.lastName LIKE :search)
                   AND blog.posts.visibility = 1
                ORDER BY {$_GET['field']} {$_GET['order']}"; // ERROR

        $_GET['order'] = ($_GET['order'] == 'ASC') ? 'DESC' : 'ASC';

        $result = $dbh->prepare($sql);
        $result->bindValue('search', '%' . trim($_GET['search']) . '%', PDO::PARAM_STR);

        $result->execute();

        // SORT, SECTION ADMINISTRATION
    } elseif ($_SESSION['level'] == 'administrator' && ($_SESSION['type'] == 'administration')) { // ICI PROBLEME
        $sql = "SELECT blog.posts.id,
                       blog.posts.title,
                       blog.posts.created,
                       blog.categories.category,
                       blog.posts.image,
                       blog.users.firstName,
                       blog.users.lastName,
                       blog.posts.visibility
                FROM blog.posts
                LEFT JOIN blog.categories ON posts.idCategory = categories.id
                LEFT JOIN blog.users ON posts.idUser = users.id
                WHERE blog.posts.visibility = 1
                ORDER BY {$_GET['field']} {$_GET['order']}
                LIMIT $firstOfPage, $perPage"; // ERROR

        $_GET['order'] = ($_GET['order'] == 'ASC') ? 'DESC' : 'ASC';

        $result = $dbh->prepare($sql);
        $result->bindValue('search', '%' . trim($_GET['search']) . '%', PDO::PARAM_STR);

        $result->execute();

    }

    // SORT, SECTION ARTICLES, SEARCHED
    elseif ($_SESSION['type'] == 'articles' && isset($_GET['search']) && !isset($_GET['id'])) {
        $sql = "SELECT blog.posts.id,
                       blog.posts.title,
                       blog.posts.created,
                       blog.posts.image,
                       blog.categories.category,
                       blog.users.firstName,
                       blog.users.lastName,
                       blog.posts.visibility
                FROM blog.posts
                LEFT JOIN blog.categories ON posts.idCategory = categories.id
                LEFT JOIN blog.users ON posts.idUser = users.id
                WHERE blog.posts.title LIKE :search
                   OR blog.posts.created LIKE :search
                   OR blog.posts.image LIKE :search
                   OR blog.categories.category LIKE :search
                   OR blog.users.firstName LIKE :search
                   OR blog.users.lastName LIKE :search
                ORDER BY {$_GET['field']} {$_GET['order']}";

        $_GET['order'] = ($_GET['order'] == 'ASC') ? 'DESC' : 'ASC';

        $result = $dbh->prepare($sql);
        $result->bindValue('search', '%' . trim($_GET['search']) . '%', PDO::PARAM_STR);

        $result->execute();

        // SORT, SECTION ARTICLES
    } elseif ($_GET['type'] == 'articles' && $_SESSION['level'] == 'administrator' && !isset($_GET['id'])) {
        $sql = "SELECT posts.id,
                       posts.title,
                       posts.content,
                       posts.created,
                       posts.image,
                       categories.category,
                       users.firstName,
                       users.lastName,
                       users.mail,
                       posts.visibility
                FROM posts
                LEFT JOIN blog.categories ON posts.idCategory = categories.id
                LEFT JOIN blog.users ON posts.idUser = users.id
                ORDER BY {$_GET['field']} {$_GET['order']}
                LIMIT $firstOfPage, $perPage";

        $_GET['order'] = ($_GET['order'] == 'ASC') ? 'DESC' : 'ASC';

        $result = $dbh->prepare($sql);
        $result->bindValue('id', $_GET['id'], PDO::PARAM_INT);

        $result->execute();

    } // SORT, SECTION USERS, SEARCHED
    elseif ($_SESSION['type'] == 'users' && $_SESSION['level'] == 'administrator' && isset($_GET['search']) && !empty($_GET['field'])) {
        $sql = "SELECT users.id,
                       users.firstName,
                       users.lastName,
                       users.mail,
                       users.login,
                       users.password,
                       users.level
                FROM users
                WHERE users.firstName LIKE :search
                   OR users.lastName LIKE :search
                   OR users.mail LIKE :search
                   OR users.login LIKE :search
                   OR users.level LIKE :search
                
                ORDER BY {$_GET['field']} {$_GET['order']}";

        $_GET['order'] = ($_GET['order'] == 'ASC') ? 'DESC' : 'ASC';

        $resultUsers = $dbh->prepare($sql);

        $resultUsers->bindValue('search', '%' . trim($_GET['search']) . '%', PDO::PARAM_STR);

        $resultUsers->execute();

        // // SORT, SECTION USERS
    } elseif (($_GET['type'] == 'users') && $_GET['field'] == 'none') {
        $sql = "SELECT users.id,
                       users.firstName,
                       users.lastName,
                       users.mail,
                       users.login,
                       users.password,
                       users.level
                FROM users
                ORDER BY users.level ASC, users.firstName DESC
                LIMIT $firstOfPage, $perPage";

        $resultUsers = $dbh->prepare($sql);

        $resultUsers->execute();

        // SORT, SECTION USERS
    } elseif ($_GET['type'] == 'users' && !isset($_GET['id']) && isset($_GET['field']) & isset($_GET['order'])) {
        $sql = "SELECT users.id,
                       users.firstName,
                       users.lastName,
                       users.mail,
                       users.login,
                       users.password,
                       users.level
                FROM users
                ORDER BY {$_GET['field']} {$_GET['order']}
                LIMIT $firstOfPage, $perPage";

        $_GET['order'] = ($_GET['order'] == 'ASC') ? 'DESC' : 'ASC';

        $resultUsers = $dbh->prepare($sql);

        $resultUsers->execute();

        // ID
    } elseif ($_GET['id']) {
        $sql = "SELECT posts.id,
               posts.title,
               posts.content,
               posts.created,
               posts.image,
               categories.category,
               users.firstName,
               users.lastName,
               users.mail
        FROM posts
        LEFT JOIN blog.categories ON posts.idCategory = categories.id
        LEFT JOIN blog.users ON posts.idUser = users.id
        WHERE posts.id = :id
    LIMIT 1";
        $result = $dbh->prepare($sql);
        $result->bindValue('id', $_GET['id'], PDO::PARAM_INT);

        $result->execute();

        // DEFAULT
    } elseif ($_GET['field'] || $_GET['order']) {
        $sql = "SELECT blog.posts.id,
                       blog.posts.title,
                       blog.posts.created,
                       blog.posts.image,
                       blog.categories.category,
                       blog.users.firstName,
                       blog.users.lastName,
                       blog.posts.visibility
            FROM blog.posts
            LEFT JOIN blog.categories ON posts.idCategory = categories.id
            LEFT JOIN blog.users ON posts.idUser = users.id
            WHERE blog.posts.visibility = 1
            ORDER BY {$_GET['field']} {$_GET['order']}
            LIMIT $firstOfPage, $perPage"; // Attention des accolades

        $_GET['order'] = ($_GET['order'] == 'ASC') ? 'DESC' : 'ASC';

        $result = $dbh->prepare($sql);

        $result->execute();
    }

// Nombre d'entrée
    if(isset($result)) {
        $numberSite = $result->rowCount();
    }
    if(isset($resultUsers)) {
        $numberUsers = $resultUsers->rowCount();
    }
}
catch (PDOException $e) {
    die('Error : '.$e->getMessage());
}

