<?php
    include_once "../../../conexao.php";

    $id_usuario = $_GET['id_usuario'];
    $titulo = $_GET['titulo'];

    // Aqui você pode usar o seu código para atualizar o banco de dados com os valores recebidos

    // Exemplo de conexão PDO

    // Atualizar o banco de dados
    $sql = "UPDATE chamado SET status = 2 WHERE id_chamado = :id_usuario";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_usuario', $id_usuario);
    $stmt->execute();

    // Responder com uma mensagem de sucesso
    echo "Atualizado com sucesso";
?>