<?php
const HOST = 'localhost';
const DB_NAME = 'php';
const USER_NAME = 'root';
const PASSWORD = 'mamad.esi4030';

function connect ()
{
    try {
        $pdo = new PDO("mysql:host=". HOST .";dbname=". DB_NAME .";charset=utf8", USER_NAME, PASSWORD);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("اتصال به دیتابیس ناموفق بود: " . $e->getMessage());
    }
}

?>