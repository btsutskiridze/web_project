<?php

class Redirect
{

    public static function to($location = null, $data = []): void
    {
        if (is_numeric($location)) {
            switch ($location) {
                case 404:
                    header('HTTP/1.0 404 Not Found');
                    include_once 'Module/Errors/404.php';
                    exit();
            }
        }

        if ($location) {
            header('location: ' . $location);
            exit();
        }
    }
}