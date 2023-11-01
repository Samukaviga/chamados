<?php

include_once "../conexao.php";


$resposta = $_POST['resposta'];
$id_mensagem_chamado = $_GET['id_mensagem_chamado'];
$id_chamado = $_GET['id_chamado'];

$sql = "INSERT INTO resposta_chamado (mensagem, id_mensagem_chamado) VALUES (:m, :id)";
 
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':m', $resposta);
$stmt->bindParam(':id', $id_mensagem_chamado);

if($stmt->execute()){
    header('Location: ./mensagem.php?id_chamado='. $id_chamado);
    exit();
}
