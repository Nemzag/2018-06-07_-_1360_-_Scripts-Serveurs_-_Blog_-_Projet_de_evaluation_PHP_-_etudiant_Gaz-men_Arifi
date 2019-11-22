<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-06-05
 * Time: 19:13
 */

$_SESSION['level'] = $_SESSION['level'] ?? null;

// LEVEL USER
if($_SESSION['level'] == 'user') {
if(isset($_GET['perpage']) && !empty($_GET['perpage']) && ctype_digit($_GET['perpage']) == 1) {
    $perPage = $_GET['perpage'];
}else{
    $perPage= 50;
}

try {
    $dbh = connect();

    $sql = "SELECT COUNT(title) AS total
            FROM blog.posts
            WHERE blog.posts.visibility = 1";

    $result = $dbh->query($sql);
    $req = $result->fetch();
    $total = $req['total'];

    $nbPage = (int) ceil($total/$perPage);

} catch(PDOException $e) {
    die('Error SQL : '.$e->getMessage());
}

if(isset($_GET['page']) && !empty($_GET['page'] && ctype_digit($_GET['page']) == 1)) {
    if ($_GET['page'] > $nbPage) {
        $current = $nbPage;
    } else {
        $current = $_GET['page'];
    }
} else {
    $current = 1;
}

$firstOfPage = ($current-1)*$perPage;

}

// LEVEL ADMINISTRATOR & TYPE ADMINISTRATION
elseif(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator' && $_SESSION['type'] == 'administration') {
    if(isset($_GET['perpage']) && !empty($_GET['perpage']) && ctype_digit($_GET['perpage']) == 1) {
        $perPage = $_GET['perpage'];
    }else{
        $perPage= 50;
    }

    try {
        $dbh = connect();

        $sql = "SELECT COUNT(title) AS total
            FROM blog.posts
            WHERE blog.posts.visibility = 1";

        $result = $dbh->query($sql);
        $req = $result->fetch();
        $total = $req['total'];

        $nbPage = (int) ceil($total/$perPage);

    } catch(PDOException $e) {
        die('Error SQL : '.$e->getMessage());
    }

    if(isset($_GET['page']) && !empty($_GET['page'] && ctype_digit($_GET['page']) == 1)) {
        if ($_GET['page'] > $nbPage) {
            $current = $nbPage;
        } else {
            $current = $_GET['page'];
        }
    } else {
        $current = 1;
    }

    $firstOfPage = ($current-1)*$perPage;

}
// LEVEL ADMINISTRATOR & TYPE ADMINISTRATION
elseif(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator' && $_SESSION['type'] == 'administration') {
    if(isset($_GET['perpage']) && !empty($_GET['perpage']) && ctype_digit($_GET['perpage']) == 1) {
        $perPage = $_GET['perpage'];
    }else{
        $perPage = 50;
    }

    try {
        $dbh = connect();

        $sql = "SELECT COUNT(title) AS total
            FROM blog.posts
            WHERE blog.posts.visibility = 1";

        $result = $dbh->query($sql);
        $req = $result->fetch();
        $total = $req['total'];

        $nbPage = (int) ceil($total/$perPage);

    } catch(PDOException $e) {
        die('Error SQL : '.$e->getMessage());
    }

    if(isset($_GET['page']) && !empty($_GET['page'] && ctype_digit($_GET['page']) == 1)) {
        if ($_GET['page'] > $nbPage) {
            $current = $nbPage;
        } else {
            $current = $_GET['page'];
        }
    } else {
        $current = 1;
    }

    $firstOfPage = ($current-1)*$perPage;

}

// LEVEL ADMINISTRATOR, TYPE ARTICLES
elseif($_SESSION['level'] == 'administrator' && $_SESSION['type'] == 'articles') {

    if(isset($_GET['perpage']) && !empty($_GET['perpage']) && ctype_digit($_GET['perpage']) == 1) {
        $perPage = $_GET['perpage'];
    }else{
        $perPage= 50;
    }

    try {
        $dbh = connect();

        $sql = "SELECT COUNT(title) AS total
            FROM blog.posts";

        $result = $dbh->query($sql);
        $req = $result->fetch();
        $total = $req['total'];

        $nbPage = (int) ceil($total/$perPage);

    } catch(PDOException $e) {
        die('Error SQL : '.$e->getMessage());
    }

    if(isset($_GET['page']) && !empty($_GET['page'] && ctype_digit($_GET['page']) == 1)) {
        if ($_GET['page'] > $nbPage) {
            $current = $nbPage;
        } else {
            $current = $_GET['page'];
        }
    } else {
        $current = 1;
    }

    $firstOfPage = ($current-1)*$perPage;

}

// LEVEL ADMINISTRATOR, TYPE USERS
elseif($_SESSION['level'] == 'administrator' && $_SESSION['type'] == 'users') {

    if(isset($_GET['perpage']) && !empty($_GET['perpage']) && ctype_digit($_GET['perpage']) == 1) {
        $perPage = $_GET['perpage'];
    }else{
        $perPage= 50;
    }

    try {
        $dbh = connect();

        $sql = "SELECT COUNT(blog.users.id) AS total
            FROM blog.users";

        $result = $dbh->query($sql);
        $req = $result->fetch();
        $total = $req['total'];

        $nbPage = (int) ceil($total/$perPage);

    } catch(PDOException $e) {
        die('Error SQL : '.$e->getMessage());
    }

    if(isset($_GET['page']) && !empty($_GET['page'] && ctype_digit($_GET['page']) == 1)) {
        if ($_GET['page'] > $nbPage) {
            $current = $nbPage;
        } else {
            $current = $_GET['page'];
        }
    } else {
        $current = 1;
    }

    $firstOfPage = ($current-1)*$perPage;

}

// LEVEL VISITOR

if(!isset($_SESSION['level'])) {
    if(isset($_GET['perpage']) && !empty($_GET['perpage']) && ctype_digit($_GET['perpage']) == 1) {
        $perPage = $_GET['perpage'];
    }else{
        $perPage= 50;
    }

    try {
        $dbh = connect();

        $sql = "SELECT COUNT(title) AS total
            FROM posts
            WHERE visibility = 1";

        $result = $dbh->query($sql);
        $req = $result->fetch();
        $total = $req['total'];

        $nbPage = (int) ceil($total/$perPage);

    } catch(PDOException $e) {
        die('Error SQL : '.$e->getMessage());
    }

    if(isset($_GET['page']) && !empty($_GET['page'] && ctype_digit($_GET['page']) == 1)) {
        if ($_GET['page'] > $nbPage) {
            $current = $nbPage;
        } else {
            $current = $_GET['page'];
        }
    } else {
        $current = 1;
    }

    $firstOfPage = ($current-1)*$perPage;

}
?>
