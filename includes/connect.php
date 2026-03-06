<?php 
$host = "localhost"; //hostname
$db = "book_manager"; //database name
$user = "root"; //username
$password = ""; //password

//database variable allocation
$dsn = "mysql:host=$host;dbname=$db";

//try block
try {

    // create pdo
   $pdo = new PDO ($dsn, $user, $password); 
   $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
//catch block
catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage()); 
}