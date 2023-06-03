<?php

class Input
{
    public static function exists($type = 'post'): bool
    {
        return match ($type) {
            'post' => !empty($_POST),
            'get' => !empty($_GET),
            default => false,
        };

    }

    public static function get($value): string
    {
        return $_POST[$value] ?? $_GET[$value] ?? '';
    }

}