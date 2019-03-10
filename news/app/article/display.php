<?php

require_once __DIR__ . '/../autoload.php';

if (isset($_GET['id'])) {

    $art = $article->get($_GET['id']);
    include __DIR__ . '/../templates/article/display-single.php';

}