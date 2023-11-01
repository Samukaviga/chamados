<?php

$host = "localhost";
$user = "root";
$pass = "";
$dbname = "chamado";
$port = 3306;

try{
    $pdo = new PDO("mysql:host=$host;port=$port;dbname=" . $dbname, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch(PDOException $e){

        echo("Erro na conexao com o banco de dados" . $e->getMessage());
}



