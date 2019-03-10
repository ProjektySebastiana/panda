<?php

require_once __DIR__ . '/../autoload.php';

if (isset($_SESSION['user'])) {

    $author_id = $article->get($_GET['id'], 'author_id');

    if (isset($_GET['id']) && $_SESSION['user']['id'] == $author_id) {

        if (isset($_POST) && count($_POST)) {

            $valid = $form->validate(ARTICLE_FIELDS, $_POST);

            if ($valid === true) {
                $status = $article->update($_GET['id'], $_POST);
                $user->redirect('article-display.php?id=' . $_GET['id']);
            }
            else {
                echo '<p class="warning">' . $valid['error'] . '</p>';
            }
        }

        $art = $article->get($_GET['id']);
        include_once __DIR__ . '/../templates/article/update.php';
    }
    else {
        $user->redirect('.');
    }
}
else {
    $user->redirect('.');
}