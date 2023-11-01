<?php
  
  include_once "../../conexao.php";
  include_once "../body/menu-admin.php";
  include_once "../../eventos/funcoes-admin.php";

  // Verifique se o usuário está logado, se não, redirecione-o para uma página de login
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../src/login.php");
    exit;
}

    $id_usuario = $_SESSION["id_usuario"];
    echo $id_usuario;
?>
        
<div class="mx-auto mt-3" style="width: 900px;">
    <table class="table table-success table-striped h6">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Usuario</th>
      <th scope="col">Unidade</th>
      <th scope="col">Setor</th>
      <th scope="col">Departamento</th>
      <th scope="col">Titulo</th>
      <th scope="col">Concluido</th>
      <th scope="col">Prioridade</th>
    </tr>
  </thead>
  <tbody>
    
    <?php
          // $id_usuario = $_SESSION["id_usuario"];

         //  echo $id_usuario;
       $tipo = tipoUsuario($pdo, $id_usuario);
       
       $sql = exibirRelatorioSql($tipo, $id_usuario);


      // $sql = "select * from usuario";
       $stmt = $pdo->query($sql)->fetchAll();

       // var_dump($stmt);

       foreach ($stmt as $row) {
        $id_usuario = $row['id_usuario'];
        $titulo = $row['titulo'];
        $status = $row['status'];
        $prioridade = $row['prioridade'];
        $ordem = $row['ordem'];
        $id_chamado = $row['id_chamado'];
        // Verificar o valor do campo "status"
        $checkboxConcluido = ($status == 0) ? 'checked' : '';
        $checkboxPrioridade = ($prioridade == 1) ? 'checked' : '';
    ?>
    
    <tr>
        <th scope="row"><?php echo $row['ordem']; ?></th>
        <td><?php echo $row['nome']; ?></td>
        <td><?php echo $row['nome_unidade']; ?></td>
        <td><?php echo $row['nome_setor']; ?></td>
        <td><?php echo $row['nome_departamento']; ?></td>
        <td> <a href="mensagem-admin.php?id_chamado=<?=$row['id_chamado'];?>" class="link-success"><?php echo $row['titulo']."<br />\n";?></a></td>

        <td>
            <div class="form-check d-flex justify-content-center align-items-center"> 
                <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" onchange="checkboxConcluido(this, '<?php echo $id_chamado; ?>', '<?php echo $titulo; ?>')" <?php echo $checkboxConcluido; ?>>
            </div>
        </td>
        <td>
            <div class="form-check form-switch d-flex justify-content-center align-items-center">
                <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" onchange="checkboxPrioridade(this, '<?php echo $id_chamado; ?>', '<?php echo $titulo; ?>')" <?php echo $checkboxPrioridade; ?>>
            </div>
        </td>
    </tr>

        <?php }?>

  </tbody>
</table>
</div>

<?php
  include_once  "../body/rodape-admin.php";
?>


<script src="./js/checkbox.js"></script>
        



