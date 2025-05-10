<?php
require_once('Controllers/Page.php');

$url = $_GET['url'] ?? 'landing';

if ($url == 'login'){
    require_once('Views/login.php');
    exit();
} else if ($url == 'landing'){
    require_once('Views/landing.php');
    exit();
}

$title = strtoupper($url);
$home = new Page("$title", "$url");
$home->call();
