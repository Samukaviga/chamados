<?php

include_once "../../conexao.php";
session_start();



//$id_usuario = $_SESSION["id_usuario"];


if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(empty(trim($_POST["mensagem"]))){
        $login_err = "Por favor, insira uma mensagem.";
    } else{
        $mensagem = trim($_POST["mensagem"]);
        $titulo = trim($_POST["titulo"]);
        $id_usuario = trim($_POST["usuario"]);
        $data = date('Y/m/d');
        $hora = date('H:i');
        $status = 1;
        $prioridade = 0;
        $departamento = $_POST["departamento"];

        $sql = "INSERT INTO chamado (titulo, mensagem, id_usuario, data, hora, status, id_departamento, prioridade) VALUES ('$titulo','$mensagem','$id_usuario','$data','$hora','$status', '$departamento', '$prioridade')";

        if($stmt = $pdo->prepare($sql)){
            $stmt->bindParam(":titulo", $param_titulo, PDO::PARAM_STR);
            $stmt->bindParam(":mensagem", $param_mensagem, PDO::PARAM_STR);
            $stmt->bindParam(":id_usuario", $param_id_usuario, PDO::PARAM_STR);
            $stmt->bindParam(":data", $param_data, PDO::PARAM_STR);
            $stmt->bindParam(":hora", $param_hora, PDO::PARAM_STR);
            $stmt->bindParam(":status", $param_status, PDO::PARAM_STR);
            $stmt->bindParam(":id_departamento", $param_departamento, PDO::PARAM_STR);
            $stmt->bindParam(":prioridade", $param_prioridade, PDO::PARAM_STR);

        
            
            if($stmt->execute()){
                
                //$_SESSION['success_err'] = "Enviado com Sucesso !"; 
               // $success_err =  "Enviado com Sucesso !";
                header("location: ./chamadas-admin.php?success=1");
               
            } else{
                $_SESSION['err'] = "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
                //$login_err = "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
                header("Location: ./chamadas-admin.php?err=0");
                
            }

            unset($stmt);
        }

    }

    unset($pdo);
    
}