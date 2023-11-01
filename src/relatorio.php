<?php
  
  include_once "../conexao.php";
  include_once "../body/menu.php";

  // Verifique se o usuário está logado, se não, redirecione-o para uma página de login
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

    $id_usuario = $_SESSION["id_usuario"];
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
    </tr>
  </thead>
  <tbody>
    
    <?php
   

       $sql = "SELECT 
       ROW_NUMBER() OVER (ORDER BY chamado.titulo ASC) AS ordem,
       usuario.id_usuario,
       usuario.nome,
       unidade.nome_unidade,
       setor.nome_setor,
       chamado.titulo,
       chamado.id_chamado,
       departamento.nome as 'nome_departamento'
   FROM 
       usuario
       INNER JOIN unidade ON unidade.id_unidade = usuario.id_unidade
       INNER JOIN setor ON usuario.id_setor = setor.id_setor
       INNER JOIN chamado ON chamado.id_usuario = usuario.id_usuario
       INNER JOIN departamento ON departamento.id_departamento = chamado.id_departamento
   WHERE
       usuario.id_usuario = $id_usuario;";


     
       $stmt = $pdo->query($sql)->fetchAll();

        //var_dump($stmt);

       foreach ($stmt as $row) {
        
    ?>

    <tr>
      <th scope="row"><?php echo $row['ordem']."<br />\n";?></th>
      <td><?php echo $row['nome']."<br />\n";?></td>
      <td><?php echo $row['nome_unidade']."<br />\n";?></td>
      <td><?php echo $row['nome_setor']."<br />\n";?></td>
      <td><?php echo $row['nome_departamento']."<br />\n";?></td>
    <td><a href="mensagem.php?id_chamado=<?=$row['id_chamado']; ?>" class="link-success"><?php echo $row['titulo']."<br />\n";?></a></td>
    </tr>


    <?php }
    
    unset($pdo);
    ?>
  </tbody>
</table>
</div>

<?php
  include_once "../body/rodape.php";
?>
        



