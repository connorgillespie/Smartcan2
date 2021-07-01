<?php

// Include file auth
if(!defined("api")){
    header('HTTP/1.0 403 Forbidden');
    die('File access forbidden.');
}

// MySQL connection settings
$username = "administrator";
$password = "vnserver#2020";
$host = "192.168.1.106";
$port = "3306";
$database = "smartcan-v2";