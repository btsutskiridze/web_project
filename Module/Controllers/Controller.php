<?php

class Controller
{
    public static function view($viewName, $data = []): void
    {
        extract($data);
        require_once("src/views/$viewName.php");
    }

}
