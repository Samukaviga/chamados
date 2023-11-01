<?php
  include_once "../body/menu-admin.php";

include_once '../../conexao.php';
include_once "../../eventos/funcoes.php";

 $id_usuario = $_SESSION['id_usuario'];

    if (isset($_GET['success'])){
        $success = $_GET['success'];
    }
    if (isset($_GET['err'])){
        $err = $_GET['err'];
    }

    if(!empty($success)){
        $success = "Enviado com Sucesso !";
        echo '<div class="alert alert-success">' . $success . '</div>';
        $success = null;
    }   
    if(!empty($err)){
        $err = "Ops! Algo deu errado. Por favor, tente novamente mais tarde.";
        echo '<div class="alert alert-danger">' . $err . '</div>';
        $err = null;
    } 
    if(!empty($username_err)){
        echo '<div class="alert alert-danger">' . $username_err . '</div>';
    }

    
 
// Verifique se o usuário está logado, se não, redirecione-o para uma página de login
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}


    $listaDepartamento = listagemDepartamento($pdo);
    $listaPessoas = listagemPessoas($pdo);


 ?>


<div class="container">
    <div class="bg-light p-3 mt-5 rounded">
        <form id="some-form" method="POST" action="./adicionando-formulario-admin.php" onsubmit="return validateForm()">
            <div class="mb-3">
                <label for="disabledSelect" class="form-label">Departamento</label>
                <select name="departamento" id="disabledSelect" class="form-select">

                    <?php foreach($listaDepartamento as $lista): ?>
                        <?php if($lista['id_departamento']): ?>
                            <option value="<?= $lista['id_departamento']; ?>"><?= $lista['nome']; ?></option>
                        <?php endif; ?>
                        <?php endforeach;?>

                </select>
            </div>
            <div class="mb-3">
                <label for="disabledSelect" class="form-label">Usuario</label>
                <select name="usuario" id="disabledSelect" class="form-select">

                    <?php foreach($listaPessoas as $lista): ?>
                        <option value="<?= $lista['id_usuario']; ?>"><?= $lista['nome']. ' '. $lista['sobrenome']; ?></option>
                    <?php endforeach;?>

                </select>
            </div>

            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" name="titulo" id="titulo" class="form-control">
            </div>
            <div class="mb-3">
                <label for="mensagem" class="form-label">Descrição</label>
                <textarea class="form-control" id="mensagem" name="mensagem" rows="3" placeholder="Descreva o problema aqui"></textarea>
            </div>
            <button type="submit" id="form" value="enviar" name="enviar" class="btn btn-primary">Enviar</button>
        </form>
    </div>
</div>
        
<?php
include_once "../body/rodape-admin.php";
?>

<script>
    function validateForm() {
        var departamento = document.forms["some-form"]["departamento"].value;
        var titulo = document.forms["some-form"]["titulo"].value;
        var mensagem = document.forms["some-form"]["mensagem"].value;
        var usuario = document.forms["some-form"]["usuario"].value;

        if (departamento === "" || titulo === "" || mensagem === "" || usuario == "") {
            alert("Por favor, preencha todos os campos");
            return false;
        }
    }
</script>






 