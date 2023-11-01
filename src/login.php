<?php 
include_once '../conexao.php';

session_start();

//echo md5("samuel");
 
// Verifique se o usuário já está logado, em caso afirmativo, redirecione-o para a página de boas-vindas
/*if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}*/

if($_SERVER["REQUEST_METHOD"] == "POST"){

 
  if(empty(trim($_POST["email"]))){
      $username_err = "Por favor, insira o email de usuário.";
  } else{
      $email = trim($_POST["email"]);
  }
  
  if(empty(trim($_POST["senha"]))){
       $password_err = "Por favor, insira sua senha.";
  } else{
      $senha = trim($_POST["senha"]);
  }
  
  //sssss

   // Validar credenciais
   if(empty($username_err) && empty($password_err)){
  
    // Prepare uma declaração selecionada
    $sql = "SELECT id_usuario, email,nome, senha, id_setor, tipo FROM usuario WHERE email = :email";
    

    if($stmt = $pdo->prepare($sql)){
        // Vincule as variáveis à instrução preparada como parâmetros
        $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
         
        // Definir parâmetros
        $param_email = trim($_POST["email"]);
    
  
        // Tente executar a declaração preparada
        if($stmt->execute()){
            // Verifique se o nome de usuário existe, se sim, verifique a senha
            if($stmt->rowCount() == 1){


                if($row = $stmt->fetch()){

                  $id = $row["id_usuario"];
                  $email = $row["email"];
                  $hashed_password = $row["senha"];
                  $nome = $row['nome'];
                  $setor = $row['id_setor'];
                  $tipo = $row['tipo'];
                  


                    if(password_verify($senha, $hashed_password)){

                        // A senha está correta, então inicie uma nova sessão
                        session_start();
                        
                        // Armazene dados em variáveis de sessão
                        $_SESSION["loggedin"] = true;
                        $_SESSION["id_usuario"] = $id;
                        $_SESSION["email"] = $email;
                        $_SESSION['nome'] = $nome;
                        $_SESSION['tipo'] = $tipo;                            
                        
                            if($tipo ==! 0){
                                    header("location: /chamando/admin/src/home-admin.php");
                            } else if ($tipo == 0){
                                 // Redirecionar o usuário para a página de boas-vindas
                                    header("location: home.php");
                            }
                           
                        
                        
                    } else{
                        // A senha não é válida, exibe uma mensagem de erro genérica
                        $login_err = "Nome de usuário ou senha inválidos.";
                    }
                }
            } else{
                // O nome de usuário não existe, exibe uma mensagem de erro genérica
                $login_err = "Nome de usuário ou senha inválidos.";
            }
        } else{
            echo "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
        }


        // Fechar declaração
        unset($stmt);
    }
}

// Fechar conexão
unset($pdo);


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .login-form {
      background-color: #34A853;
      border-radius: 10px;
      padding: 20px;
    }
  </style>
</head>

<body>


                <?php 
                if(!empty($login_err)){
                    echo '<div class="alert alert-danger">' . $login_err . '</div>';
                }   
                if(!empty($password_err)){
                    echo '<div class="alert alert-danger">' . $password_err . '</div>';
                } 
                if(!empty($username_err)){
                    echo '<div class="alert alert-danger">' . $username_err . '</div>';
                }
                ?>
                 
  <div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
      <div class="col-lg-4 col-md-6">
        <div class="login-form">
          <h1 class="text-center mb-4 text-white">Login</h1>
          <div class="d-flex justify-content-center">
            <img src="../assets/image/logo.png" width="70%" alt="Logo do Liceu">
          </div>
          <form method="POST" action="">
            <div class="mb-3">
              <label for="email" class="form-label text-white">Email:</label>
              <input type="email" name="email" class="form-control" id="email" placeholder="Digite seu Email">
            </div>
            <div class="mb-3">
              <label for="password" class="form-label text-white">Senha:</label>
              <input type="password" name="senha" class="form-control" id="senha" placeholder="Digite sua senha">
            </div>
            <div class="text-center">
              <button type="submit" value="entrar" name="entrar" class="btn btn-primary">Login</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>







          
       

<?php include_once "../body/rodape.php"?>