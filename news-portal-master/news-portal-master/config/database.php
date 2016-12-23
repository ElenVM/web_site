<?php

return [

    'driver'    => 'mysql',
    'host'      => '127.0.0.1',
    'database'  => 'news-portal',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',

    'options'   => [
        PDO::ATTR_TIMEOUT => 5,
        PDO::ATTR_EMULATE_PREPARES => false,
    ],

];