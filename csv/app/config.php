<?php

$config = [
    'DB' => [
        'host' => '127.0.0.1:3306',
        'user' => 'homestead',
        'pass' => 'secret',
        'name' => 'forms',
    ],
    'IMPORT_FIELDS' => ['file', 'column']
];

foreach ($config as $key => $value) {
  define($key, $value);
}
