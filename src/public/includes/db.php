<?php

// Verbinde mit mySQL, mit hilfe eines PHP PDO Opject
$db_host = getenv("DB_HOST");
$db_name = getenv("DB_NAME");
$db_user = getenv("DB_USER");
$db_pass = getenv("DB_PASSWORD");


try {
    $dbConn = new PDO("mysql:host=$db_host;dbname=$db_name;", $db_user, $db_pass);

    // Setze den Fehlermoduds für Web Devs
    $dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch (PDOException $e) {
    echo $e->getMessage();
}