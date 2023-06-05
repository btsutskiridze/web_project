<?php

class Hash
{
    public static function make($string, $salt = ''): string
    {
        return hash('sha256', $string . $salt);
    }

    /**
     * @throws Exception
     */
    public static function salt(int $length): string
    {
        return random_bytes($length);
    }

    public static function unique(): string
    {
        return self::make(uniqid());
    }
}