<?php

ini_set('session.gc_maxlifetime', 2592000);
ini_set('session.cache_expire', 2592000);
ini_set('session.cache_limiter', 'none');
ini_set('session.cookie_lifetime', 2592000);
session_start();

$l = $_GET["l"];
$s = $_GET["s"];

$charset = 'ABCDEFGHJKLMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz';
$numeric = '23456789';
$symbol = '!#&^$*@<>:-_[]|/=+~{}?.,';
$password = '';

switch ($s) {
    case 1:
        $charset = $charset.$numeric;
        break;
    case 2:
        $charset = $charset.$numeric.$symbol;
        break;  
}

for($i=0; $i<$l; $i++) {
    $random = rand() % strlen($charset);
    $password.=substr($charset, $random, 1);
}

echo $password;

$_SESSION['passwordphp_length'] = $l;
$_SESSION['passwordphp_strength'] = $s;
