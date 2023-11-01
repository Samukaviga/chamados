<?php

require_once './conexao.php';

//session_start();

$id_usuario = 8;


$senha = "123";
$senhaCriptografada = password_hash($senha, PASSWORD_DEFAULT);

$sql = "UPDATE usuario SET senha = :senha WHERE id_usuario = :id";

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':senha', $senhaCriptografada);
$stmt->bindValue(':id', $id_usuario);
$stmt->execute();

if($stmt->rowCount() > 0){
    echo 'Senha adicionada com sucesso !';
} else {
    echo 'Falha ao adicionar senha !';
}

