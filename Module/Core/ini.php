<?php

session_start();

$GLOBALS['config'] = [
    'mysql' => [
        'host' => 'localhost',
        'username' => 'bakari',
        'password' => '1234',
        'database' => 'web_project',

    ],
    'remember' => [
        'cookie_name' => 'hash',
        'cookie_expiry' => 604800,
    ],
    'session' => [
        'session_name' => 'user',
        'token_name' => 'token',
    ],
];


define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT']);

$subdirs = ['Modules', 'Configs', 'Models', 'Helpers'];

foreach ($subdirs as $subdir) {
    spl_autoload_register(function ($class) use ($subdir) {
        $file = ROOT_PATH . '/Module/' . $subdir . '/' . $class . '.php';
        if (file_exists($file)) require_once $file;
    });
}

