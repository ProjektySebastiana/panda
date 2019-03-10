<?php

require_once __DIR__ . '/../autoload.php';

if (isset($_POST) && count($_POST)) {

    $valid = $form->validate(LOGIN_FIELDS, $_POST);

    if ($valid === true) {
        $status = $user->login($_POST);
        if ($status) {
            $user->redirect('.');
        }
        else {
            var_dump($status);
        }
    }
    else {
        echo '<p class="warning">' . $valid['error'] . '</p>';
    }
}

include_once __DIR__ . '/../templates/user/form-login.php';