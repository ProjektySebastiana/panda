<?php

session_start();

define('DEBUG', false);

$files = [
    'config',
    'functions',
    'classes/database',
    'classes/form',
    'classes/user',
    'classes/chart',
    'classes/csv',
];

foreach ($files as $file) {
    $file .= '.php';
    if (DEBUG) { echo 'loading: '.$file.'<br>'; }
    require_once $file;
}

$db = new Database();

$form = new Form();
$user = new User();
$csv = new Csv($db);
$chart = new Chart($db);
