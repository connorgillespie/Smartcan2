<?php

// Include file auth
if(!defined("api")){
    header('HTTP/1.0 403 Forbidden');
    die('File access forbidden.');
}

// MySQL connection settings
$username = "root";
$password = "password";
$host = "127.0.0.1";
$port = "3306";
$database = "smartcan-v2";
