<?php

require_once __DIR__ . '/../autoload.php';

if (isset($_SESSION['user'])) {

    if (isset($_POST) && count($_POST)) {

        $valid = $form->validate(ARTICLE_FIELDS, $_POST);

        if ($valid === true) {
            $status = $article->create($_POST);
            if ($status === true) {
                $user->redirect('article-display.php?id='.$db->insertedId());
            }
        }
        else {
            echo '<p class="warning">' . $valid['error'] . '</p>';
        }
    }

    include_once __DIR__ . '/../templates/article/create.php';
}