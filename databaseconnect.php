<?php

require_once (__DIR__ . '/config/mysql.php');
try {
    // connect to MySQL
    $mysqlClient = new PDO(
        sprintf('mysql:host=%s;dbname=%s;port=%s;charset=utf8', 
        MYSQL_HOST, MYSQL_NAME,MYSQL_PORT),
        MYSQL_USER, MYSQL_PASSWORD);
        
        // error message management 
        $mysqlClient->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\Throwable $exception) {
      
        // In case of error, display an error message and end of process
      die('Erreur : ' . $exception->getMessage());
}
