<?php

/**
* File of miniTwitter
*
* @author     	Daniel Plewinski
* @author  		email: dplewinski@gmail.com
* @link     	https://github.com/daniel-plewinski/miniTwitter
*/


$host = "localhost";
$user = "root";
$pass = "1234";
$db = "twitter";
$conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if ($conn->errorCode() != null) {
    die("Połączenie nieudane. Błąd: " . $conn->errorInfo()[2]);
}