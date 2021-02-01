<?php

$host = 'localhost';
$dbname = 'ud3_balance';
$username = 'root';
$password = '';

// MySQL/MariaDB
try {

    $dbh = new PDO('mysql:host=' . $host . ';dbname=' . $dbname, $username, $password);
   //asi definimos si hay algun error en la BBDD
//$dbh->setAttribute(pdo::attr_errmode, pdo::errmode_exception);
} catch (Exception $e) {
    die("Error " . $e->GetMessage());
} finally {

    $base = null;
}

