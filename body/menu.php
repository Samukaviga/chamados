<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Bem vindo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/mensage.css">
    <link rel="stylesheet" href="../assets/css/chamada.css">
    <link rel="stylesheet" href="../assets/css/menu.css">
    
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous">


    <style>
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>

<?php session_start();  $id_usuario = $_SESSION["id_usuario"];

     //$diretorio_relatorio = $id_usuario == 5 ? "./relatorio.php" : "../admin/relatorio-admin.php";

?>
          
        <nav class="navbar navbar-expand-lg navbar-dark bk gradient-custom">
          <div class="container-fluid">
            <a class="navbar-brand" href="../src/home.php"><img src="../assets/image/logo.png" alt="logotipo" class="logo"></a>
          
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" aria-current="page" href="./home.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./chamadas.php">Chamadas</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="./relatorio.php"> Relatorio</a>
                </li>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-gears" style="color: #9fd1a2;" ></i>
                  </a>
                  <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                    <li><a class="dropdown-item" href="../src/alterar-senha.php">Alterar a senha</a></li>
                    <li><a class="dropdown-item" href="../logout.php">Sair</a></li>
                  </ul>
                </li>
              </ul>
            </div>
            <p class="nome-usuario d-lg-block d-md-none px-2 mt-3 text-white"> Olá <?php echo htmlspecialchars($_SESSION["nome"]); ?></p><i class="fa-regular fa-user  d-lg-block d-md-none" style="color: #9fd1a2;"></i>
          </div>
        </nav>
        

  </header>