<?php

class User
{

    function __construct()
    {
    }

    public function redirect($path)
    {
        Header('Location: ' . $path);
    }
}