<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "percetakan";

try{
    $pdo = new PDO(
        "mysql:host=$host; dbname=$dbname",
        $user,
        $pass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

}catch(PDOException $e){
    die("tidak bisa konek ke database $dbname : ". $e->getMessage());
}