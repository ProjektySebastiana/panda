<?php

include_once __DIR__.'/app/autoload.php';

if (!isset($_SESSION['csv'])) {

    include_once 'csv-import.php';

}
else {

    include_once 'chart-display.php';

}