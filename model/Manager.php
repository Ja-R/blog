<?php

class Manager
{
    protected function dbConnect()
    {
        $db = new PDO('mysql:host=127.0.0.1;dbname=test;charset=utf8', 'root', 'user');
        return $db;
    }
}
