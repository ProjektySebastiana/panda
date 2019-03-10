<?php

require_once __DIR__ . '/../autoload.php';

if (isset($_SESSION['user'])) {

    $author_id = $article->get($_GET['id'], 'author_id');

    if (isset($_GET['id']) && $_SESSION['user']['id'] == $author_id) {

        $article->remove($_GET['id']);
    }


}

$user->redirect('.');