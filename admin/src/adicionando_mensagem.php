<?php
include_once "../../conexao.php";
include_once "../../eventos/funcoes-admin.php";

session_start();

$id_usuario = $_SESSION['id_usuario'];

$mensagem = $_POST['mensagem'];

$id_chamado = $_GET['id_chamado'];
 

$sql = "INSERT INTO mensagem_chamado ( id_chamada , id_usuario, data, hora, texto ) 
VALUES (:id_c, :id_u, :data, :hora, :texto)";

       $stmt2 = $pdo->prepare($sql);
       $stmt2->bindParam(':id_c', $id_chamado);
       $stmt2->bindParam(':id_u', $id_usuario);
       $stmt2->bindParam(':data', date("Y-m-d"));
       $stmt2->bindParam(':hora', date("H:i"));
       $stmt2->bindParam(':texto', $mensagem);
       
       if($stmt2->execute()){
            header("Location: ./mensagem-admin.php?id_chamado=$id_chamado");
            exit;
       } else { 
            echo "Erro ao inserir.";
       }