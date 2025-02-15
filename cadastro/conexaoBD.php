<?php
$host = "localhost:3306";
$user = "root";
$password = "root";
$dbname = "cadastro";


try{
    $conn = new PDO(dsn: "mysql:host=$host; dbname=$dbname", username: $user, password: $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    echo "". $e->getMessage();
    exit();

}


?>