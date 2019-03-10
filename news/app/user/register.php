<?php

require_once __DIR__ . '/../autoload.php';

if (isset($_POST) && count($_POST)) {

    $valid = $form->validate(REGISTER_FIELDS, $_POST);

    if ($valid === true) {
        $status = $user->register($_POST);
        if ($status === true){
            $user->login($_POST);
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

include_once __DIR__ . '/../templates/user/form-register.php';