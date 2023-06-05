<?php


class Session
{

    public static function put($name, $value): string
    {
        return $_SESSION[$name] = $value;
    }

    public static function get($token): string
    {
        return $_SESSION[$token];
    }

    public static function exists($name): bool
    {
        return (isset($_SESSION[$name]));
    }

    public static function delete($name): void
    {
        if (self::exists($name)) unset($_SESSION[$name]);
    }

    public static function flash($name, string $string = ''): string|null
    {
        if (self::exists($name)) {
            $session = self::get($name);
            self::delete($name);
            return $session;
        }

        self::put($name, $string);
        return null;
    }
}