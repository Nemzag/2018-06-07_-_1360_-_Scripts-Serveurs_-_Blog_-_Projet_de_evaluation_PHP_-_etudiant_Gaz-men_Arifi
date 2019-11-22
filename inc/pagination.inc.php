<?php
/**
 * Created by PhpStorm.
 * User: nemzag
 * Date: 2018-06-05
 * Time: 19:05
 */

$_GET['perpage'] = $_GET['perpage'] ?? null;
$_GET['page'] = $_GET['page'] ?? null;
$firstOfPage  = $firstOfPage ?? null;
$perPage  = $perPage  ?? null;

?>
<!-- LOGGED, LEVEL ADMINISTRATOR, TYPE ADMINISTRATION -->
<?php if(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator' && ($_SESSION['type']) == 'administration') : ?>
<!-- FORMULAIRE -->
    <form action="index.php?" method="get" class="input-group mb-3">
        <label for="perpage" class="input-group-text">Nombre d'articles par page:</label>
        <select id="perpage" name="perpage" onchange="this.form.submit()" class="custom-select">
            <option value="3" <?= $_GET['perpage'] == 3 ? 'selected' : '' ?>>3</option>
            <option value="5" <?= $_GET['perpage'] == 5 ? 'selected' : '' ?>>5</option>
            <option value="8" <?= $_GET['perpage'] == 8 ? 'selected' : '' ?>>8</option>
            <option value="10" <?= $_GET['perpage'] == 10 ? 'selected' : '' ?>>10</option>
            <option value="50" <?= ($_GET['perpage'] XOR $perPage) == 50 ? 'selected' : '' ?>>50</option>
        </select>
        <input type="hidden" name="page" value="<?= $current ?>">
    </form>

<!-- PAGINATION -->
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
            <li class="page-item <?= $current == 1 ? 'disabled' : '' ?>">
                <a class="page-link"
                   href="?type=administration&amp;page=<?= $current != 1 ? $current - 1 : $current ?>&amp;perpage=<?= $_GET['perpage'] ?>"
                   tabindex="-1" >Précédent</a>
            </li>

        <?php for ($i = 1; $i <= $nbPage; $i++) : ?>
            <?php if ($i == $current) : ?>
                <li class="page-item"><a class="page-link"
                                         href="?type=administration&amp;field=<?= $_GET['field'] ?>&amp;order=<?= $_GET['order'] == 'DESC' ? 'ASC' : 'DESC' ?>&amp;page=<?= $i ?>&amp;perpage=<?= $_GET['perpage'] ?>"><?= $i ?></a></li>
            <?php else : ?>
                <li class="page-item"><a class="page-link"
                                         href="?type=administration&amp;field=<?= $_GET['field'] ?>&amp;order=<?= $_GET['order'] == 'DESC' ? 'ASC' : 'DESC' ?>&amp;page=<?= $i ?>&amp;perpage=<?= $_GET['perpage'] ?>"><?= $i ?></a></li>
            <?php endif; ?>
        <?php endfor; ?>

        <li class="page-item <?= $current == $nbPage ? 'disabled' : '' ?>">
                <a class="page-link"
                   href="?type=administration&amp;page=<?= $current != $nbPage ? ($current + 1) : $current ?>&amp;perpage=<?= $_GET['perpage'] ?>" >Suivant</a>
            </li>
    </ul>
</nav>

<!-- LOGGED, LEVEL ADMINISTRATOR, TYPE ARTICLES -->
<?php elseif(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator' && ($_SESSION['type']) == 'articles') : ?>
<!-- FORMULAIRE -->

    <form action="index.php?type=articles" method="get" class="input-group mb-3">
        <label for="perpage" class="input-group-text">Nombre d'articles par page:</label>
        <select id="perpage" name="perpage" onchange="this.form.submit()" class="custom-select">
            <option value="3" <?= $_GET['perpage'] == 3 ? 'selected' : '' ?>>3</option>
            <option value="5" <?= $_GET['perpage'] == 5 ? 'selected' : '' ?>>5</option>
            <option value="8" <?= $_GET['perpage'] == 8 ? 'selected' : '' ?>>8</option>
            <option value="10" <?= $_GET['perpage'] == 10 ? 'selected' : '' ?>>10</option>
            <option value="50" <?= ($_GET['perpage'] XOR $perPage) == 50 ? 'selected' : '' ?>>50</option>
        </select>
        <input type="hidden" name="page" value="<?= $current ?>">
    </form>

        <!-- PAGINATION -->
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= $current == 1 ? 'disabled' : '' ?>">
                    <a class="page-link"
                       href="?type=articles&amp;page=<?= $current != 1 ? $current - 1 : $current ?>&amp;perpage=<?= $_GET['perpage'] ?>"
                       tabindex="-1" >Précédent</a>
                </li>

                <?php for ($i = 1; $i <= $nbPage; $i++) : ?>
                    <?php if ($i == $current) : ?>
                        <li class="page-item"><a class="page-link"
                                                 href="?type=articles&amp;field=<?= $_GET['field'] ?>&amp;order=<?= $_GET['order'] == 'DESC' ? 'ASC' : 'DESC' ?>&amp;page=<?= $i ?>&amp;perpage=<?= $_GET['perpage'] ?>"><?= $i ?></a></li>
                    <?php else : ?>
                        <li class="page-item"><a class="page-link"
                                                 href="?type=articles&amp;field=<?= $_GET['field'] ?>&amp;order=<?= $_GET['order'] == 'DESC' ? 'ASC' : 'DESC' ?>&amp;page=<?= $i ?>&amp;perpage=<?= $_GET['perpage'] ?>"><?= $i ?></a></li>
                    <?php endif; ?>
                <?php endfor; ?>

                <li class="page-item <?= $current == $nbPage ? 'disabled' : '' ?>">
                    <a class="page-link"
                       href="?type=articles&amp;page=<?= $current != $nbPage ? ($current + 1) : $current ?>&amp;perpage=<?= $_GET['perpage'] ?>" >Suivant</a>
                </li>
            </ul>
        </nav>

    <!-- LOGGED, LEVEL ADMINISTRATOR, TYPE USERS -->
<?php elseif(isset($_SESSION['login']) && $_SESSION['level'] == 'administrator' && ($_SESSION['type']) == 'users') : ?>
    <!-- FORMULAIRE -->

    <form action="index.php?type=articles" method="get" class="input-group mb-3">
        <label for="perpage" class="input-group-text">Nombre d'articles par page:</label>
        <select id="perpage" name="perpage" onchange="this.form.submit()" class="custom-select">
            <option value="3" <?= $_GET['perpage'] == 3 ? 'selected' : '' ?>>3</option>
            <option value="5" <?= $_GET['perpage'] == 5 ? 'selected' : '' ?>>5</option>
            <option value="8" <?= $_GET['perpage'] == 8 ? 'selected' : '' ?>>8</option>
            <option value="10" <?= $_GET['perpage'] == 10 ? 'selected' : '' ?>>10</option>
            <option value="50" <?= ($_GET['perpage'] XOR $perPage) == 50 ? 'selected' : '' ?>>50</option>
        </select>
        <input type="hidden" name="page" value="<?= $current ?>">
    </form>

    <!-- PAGINATION -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= $current == 1 ? 'disabled' : '' ?>">
                <a class="page-link"
                   href="?type=articles&amp;page=<?= $current != 1 ? $current - 1 : $current ?>&amp;perpage=<?= $_GET['perpage'] ?>"
                   tabindex="-1" >Précédent</a>
            </li>

            <?php for ($i = 1; $i <= $nbPage; $i++) : ?>
                <?php if ($i == $current) : ?>
                    <li class="page-item"><a class="page-link"
                                             href="?type=users&amp;field=<?= $_GET['field'] ?>&amp;order=<?= $_GET['order'] == 'DESC' ? 'ASC' : 'DESC' ?>&amp;page=<?= $i ?>&amp;perpage=<?= $_GET['perpage'] ?>"><?= $i ?></a></li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link"
                                             href="?type=users&amp;field=<?= $_GET['field'] ?>&amp;order=<?= $_GET['order'] == 'DESC' ? 'ASC' : 'DESC' ?>&amp;page=<?= $i ?>&amp;perpage=<?= $_GET['perpage'] ?>"><?= $i ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <li class="page-item <?= $current == $nbPage ? 'disabled' : '' ?>">
                <a class="page-link"
                   href="?type=articles&amp;page=<?= $current != $nbPage ? ($current + 1) : $current ?>&amp;perpage=<?= $_GET['perpage'] ?>" >Suivant</a>
            </li>
        </ul>
    </nav>

<!-- LEVEL USER -->
<?php elseif($_SESSION['level'] == 'user') : ?>
    <form method="get" class="input-group mb-3">
        <label for="perpage" class="input-group-text">Nombre d'articles par page:</label>
        <select id="perpage" name="perpage" onchange="this.form.submit()" class="custom-select">
            <option value="3" <?= $_GET['perpage'] == 3 ? 'selected' : '' ?>>3</option>
            <option value="5" <?= $_GET['perpage'] == 5 ? 'selected' : '' ?>>5</option>
            <option value="8" <?= $_GET['perpage'] == 8 ? 'selected' : '' ?>>8</option>
            <option value="10" <?= $_GET['perpage'] == 10 ? 'selected' : '' ?>>10</option>
            <option value="50" <?= ($_GET['perpage'] XOR $perPage) == 50 ? 'selected' : '' ?>>50</option>
        </select>
        <input type="hidden" name="page" value="<?= $current ?>">
    </form>

    <!-- PAGINATION -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= $current == 1 ? 'disabled' : '' ?>">
                <a class="page-link"
                   href="?page=<?= $current != 1 ? $current - 1 : $current ?>&amp;perpage=<?= $_GET['perpage'] ?>"
                   tabindex="-1" >Précédent</a>
            </li>

            <?php for ($i = 1; $i <= $nbPage; $i++) : ?>
                <?php if ($i == $current) : ?>
                    <li class="page-item"><a class="page-link"
                                             href="?page=<?= $i ?>&amp;field=<?= $_GET['field'] ?>&amp;order=<?= $_GET['order'] == 'DESC' ? 'ASC' : 'DESC' ?>&amp;perpage=<?= $_GET['perpage'] ?>"><?= $i ?></a></li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link"
                                             href="?page=<?= $i ?>&amp;field=<?= $_GET['field'] ?>&amp;order=<?= $_GET['order'] == 'DESC' ? 'ASC' : 'DESC' ?>&amp;perpage=<?= $_GET['perpage'] ?>"><?= $i ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <li class="page-item <?= $current == $nbPage ? 'disabled' : '' ?>">
                <a class="page-link"
                   href="?page=<?= $current != $nbPage ? ($current + 1) : $current ?>&amp;perpage=<?= $_GET['perpage'] ?>" >Suivant</a>
            </li>
        </ul>
    </nav>

<!-- VISITOR -->
<?php elseif(!isset($_SESSION['level'])) : ?>

    <form method="get" class="input-group mb-3">
        <label for="perpage" class="input-group-text">Nombre d'articles par page:</label>
        <select id="perpage" name="perpage" onchange="this.form.submit()" class="custom-select">
            <option value="3" <?= $_GET['perpage'] == 3 ? 'selected' : '' ?>>3</option>
            <option value="5" <?= $_GET['perpage'] == 5 ? 'selected' : '' ?>>5</option>
            <option value="8" <?= $_GET['perpage'] == 8 ? 'selected' : '' ?>>8</option>
            <option value="10" <?= $_GET['perpage'] == 10 ? 'selected' : '' ?>>10</option>
            <option value="50" <?= ($_GET['perpage'] XOR $perPage) == 50 ? 'selected' : '' ?>>50</option>
        </select>
        <input type="hidden" name="page" value="<?= $current ?>">
    </form>

    <!-- PAGINATION -->
    <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
            <li class="page-item <?= $current == 1 ? 'disabled' : '' ?>">
                <a class="page-link"
                   href="?page=<?= $current != 1 ? $current - 1 : $current ?>&amp;perpage=<?= $_GET['perpage'] ?>"
                   tabindex="-1" >Précédent</a>
            </li>

            <?php for ($i = 1; $i <= $nbPage; $i++) : ?>
                <?php if ($i == $current) : ?>
                    <li class="page-item"><a class="page-link"
                                             href="?page=<?= $i ?>&amp;field=<?= $_GET['field'] ?>&amp;<?= $_GET['order'] == 'DESC' ? 'ASC' : 'DESC' ?>&amp;perpage=<?= $_GET['perpage'] ?>"><?= $i ?></a></li>
                <?php else : ?>
                    <li class="page-item"><a class="page-link"
                                             href="?page=<?= $i ?>&amp;field=<?= $_GET['field'] ?>&amp;order=<?= $_GET['order'] == 'DESC' ? 'ASC' : 'DESC' ?>&amp;perpage=<?= $_GET['perpage'] ?>"><?= $i ?></a></li>
                <?php endif; ?>
            <?php endfor; ?>

            <li class="page-item <?= $current == $nbPage ? 'disabled' : '' ?>">
                <a class="page-link"
                   href="?page=<?= $current != $nbPage ? ($current + 1) : $current ?>&amp;perpage=<?= $_GET['perpage'] ?>" >Suivant</a>
            </li>
        </ul>
    </nav>
<?php endif; ?>