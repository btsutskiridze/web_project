<?php

class Token
{

    public static function generate(): string
    {
        return Session::put(Config::get('session/token_name'), md5(uniqid()));
    }

    public static function check($token): bool
    {
        $tokenName = Config::get('session/token_name');

        if (self::isValidToken($token, $tokenName)) {
            Session::delete($tokenName);
            return true;
        }
        return false;
    }

    private static function isValidToken($token, $tokenName): bool
    {
        return Session::exists($tokenName) && $token === Session::get($tokenName);
    }

}