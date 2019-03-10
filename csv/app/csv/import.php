<?php

include_once __DIR__.'/../autoload.php';

if (isset($_POST) && count($_POST)) {
    $status = $form->validate(IMPORT_FIELDS, $_POST);
    if ($status === true) {
        $save = $csv->save2db($_POST);
        if ($save['chart'] === true) {
            $user->redirect('chart-display.php?chart='.$save['name']);
        }
    }
    else {
        echo '<p class="warning">' . $status['error'] . '</p>';
    }
}

include_once __DIR__.'/../templates/csv/import.php';