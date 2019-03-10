<?php

include_once __DIR__.'/../autoload.php';

if (isset($_GET['chart'])) {

    if ($chart->generate($_GET['chart'])) {

        include_once __DIR__ . '/../templates/chart/display.php';

    }
    else {

        //$user->redirect('.');

    }
}
else {

   // $user->redirect('.');

}