<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

require_once "./config2.php";

function getLastPost () {
    $pdo = require 'config.php';
}

function exerpt(string $text , int $lenght = 100 ):string
{
    $offset = strpos($text , ' ' , $lenght) +1 ;
    return substr($text , 0 , $offset) . "...";
}

function asset (string $file):string
{
    return rtrim( WEBSITE_URL) . "/$file";
}

function redirectto(string $file):void
{
    header('location:' . WEBSITE_URL);
    exit();
}

function url (string $file , array $params = []): string
{   
    $queryString = '?';
    foreach ($params as $key => $value)
    {
        $value = trim($value);
        $queryString = $queryString . "$key=$value&";
    }
    if (count($params))
    {
        return rtrim(WEBSITE_URL , '/') . "/" . ltrim($file ,  '/') . rtrim($queryString , '&');

    }else{
        return rtrim(WEBSITE_URL , '/') . "/" . ltrim($file ,  '/');
    }

}

function  getWebsiteTitle () : string 
{
    return WEBSITE_TITLE;
}

?>