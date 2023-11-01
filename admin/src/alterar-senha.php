<?php
       include_once "../../conexao.php";
       include_once "../body/menu-admin.php";


        $id_usuario = $_SESSION["id_usuario"];

        if($_SERVER["REQUEST_METHOD"] == "POST"){

            if(empty(trim($_POST["senha-atual"])) || empty(trim($_POST["senha-nova"]))){
                 $login_err = "Por favor, insira uma senha";
            } else{
                
                $senha_atual = $_POST["senha-atual"];
                $senha_nova = $_POST["senha-nova"];
                
                $sql = "select senha from usuario where id_usuario = $id_usuario";

                 $sql_senha = $pdo->query($sql)->fetch();
                


                if(password_verify($senha_atual, $sql_senha['senha'])){
                    
                    $senhaCriptografada = password_hash($senha_nova, PASSWORD_DEFAULT);


                    $sql = "update usuario set senha = :senha where id_usuario = :id_usuario";

                      if($stmt = $pdo->prepare($sql)){

                        $stmt->bindParam(':senha', $senhaCriptografada, PDO::PARAM_STR);
                        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_STR);
                        $stmt->execute();

                        if($stmt->rowCount()){
                            $success_err = "Senha alterada com sucesso";
                        } 
                      } else {
                        $login_err = "Erro ao alterar senha !";
                      }
                } else {
                        $login_err = "Senha incorreta !";
                }
            }



        }

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bem vindo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/menu.css">

    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
        
    <div class="mx-auto" style="width: 600px;">
        
        <h1 class="my-5">Alterar a Senha</h1>

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }
        if(!empty($success_err)){
            echo '<div class="alert alert-success">' . $success_err . '</div>';
        }
        ?>

        <form method="POST" action="" >
        <div class="form-group">
            <label for="senha-atual">Senha atual</label>
            <input type="password" name="senha-atual" class="form-control" id="senha-atual" aria-describedby="emailHelp">
            <span class="invalid-feedback"><?php echo $username_err; ?></span>
        </div>
        <div class="form-group">
            <label for="senha-nova">Senha nova</label>
            <input type="password" name="senha-nova" class="form-control" id="senha-nova">
            <span class="invalid-feedback"><?php echo $password_err; ?></span>
        </div>
    
        <button type="submit" value="entrar" name="entrar" class="btn btn-primary">Entrar</button>
        </form>
    </div>

       <?php include_once "../body/rodape-admin.php"?>
    