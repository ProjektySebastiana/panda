<?php

$config = [
    'DB' => [
        'host' => '127.0.0.1:3306',
        'user' => 'homestead',
        'pass' => 'secret',
        'name' => 'forms',
        'entities' => [
            'users' => [
                'id INT(6) PRIMARY KEY AUTO_INCREMENT',
                'email VARCHAR(255) NOT NULL UNIQUE',
                'password VARCHAR(100) NOT NULL',
                'first_name VARCHAR(100) NOT NULL',
                'last_name VARCHAR(100) NOT NULL',
                'gender TINYINT(1) NOT NULL',
                'is_active TINYINT(1) DEFAULT "1"',
                'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                'created_at DATETIME',
            ],
            'articles' => [
                'id INT(6) PRIMARY KEY AUTO_INCREMENT',
                'name VARCHAR(255) NOT NULL',
                'description TEXT NOT NULL',
                'is_active TINYINT(1) DEFAULT "0"',
                'updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP',
                'created_at DATETIME NOT NULL',
                'author_id INT(6) NOT NULL',
            ],
            'genders' => [
                'id TINYINT(1) PRIMARY KEY AUTO_INCREMENT',
                'name VARCHAR(50) NOT NULL UNIQUE'
            ]
        ],
        'defaults' => [
            'genders' => [
                [1, 'boy'],
                [2, 'girl']
            ]
        ]
    ],
    'LOGIN_FIELDS' => ['email', 'password'],
    'REGISTER_FIELDS' => ['first_name', 'last_name', 'gender', 'email', 'password'],
    'ARTICLE_FIELDS' => ['name', 'description']
];

foreach ($config as $key => $value) {
  define($key, $value);
}
