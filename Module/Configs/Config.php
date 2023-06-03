<?php

class Config
{

    public static function get($path = null): ?string
    {
        if (!$path) return null;

        $config = $GLOBALS['config'];

        foreach (explode('/', $path) as $bit) {
            if (!isset($config[$bit])) return null;

            $config = $config[$bit];
        }
        
        return $config;
    }

}