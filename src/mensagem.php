<?php
  
  include_once "../conexao.php";
  include_once "../body/menu.php";
  include_once "../eventos/funcoes-admin.php";

  // Verifique se o usuário está logado, se não, redirecione-o para uma página de login
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}

    $id_usuario = $_SESSION["id_usuario"];
?>
<style>
    .response {
      background-color: #5F9EA0; /* Cor de fundo da resposta */
      border-radius: 10px;
      padding: 10px;
      margin-top: 5px; 
      
    }

    .bg-tabela{
    background-color: #4682B4;
    
  }


</style>

            
            <?php
                  $id_chamado = $_GET["id_chamado"];

                 $sql = "select chamado.mensagem, chamado.id_chamado, chamado.hora from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_usuario = $id_usuario and chamado.id_chamado = '$id_chamado'";

                 // $sql = "select * from usuario";
                  $stmt = $pdo->query($sql)->fetchAll();

                  $id_chamado = $stmt[0][1];
                  echo $id_chamado;
                 //  var_dump($stmt);
                $mensagens = mensagemAdmin($pdo, $id_chamado);  
                //echo $mensagens;    
            ?>
          

            <div class="message-container">
              <div class="message">
                <p><?php echo $stmt[0][0]."<br />\n";?></p>
                <span class="message-time"><?php echo $stmt[0][2]; ?></span>
              </div>
              <?php
                if($mensagens){
                  
                  foreach($mensagens as $mensagem){ 
              ?>
              <div class="d-flex justify-content-end"> <!-- Nome -->
              <p class="bg-primary text-white rounded p-2"><?= $mensagem['nome']; ?></p>
              </div>
              <div class="message bg-tabela">   
                  <p class="py-2 text-white"><?= $mensagem['texto']; ?></p>
                  <span class="message-time text-white"><?php echo $mensagem["hora"]; ?></span>
                  <form method="POST" action="./enviando_resposta.php?id_chamado=<?= $id_chamado; ?>&id_mensagem_chamado=<?= $mensagem['id_mensagem_chamado']; ?>">
                    <div class="reply-container">
                        <input type="text" name="resposta" id="resposta" class="form-control reply-input" placeholder="Digite sua resposta">
                        <button type="submit" class="btn btn-primary">Responder</button>
                    </div>
                    <?php
                     
                     $respostas = obtendoRespostas($mensagem['id_mensagem_chamado'], $pdo);
                     
                     if ($respostas !== null):
                     ?>
                    
                    <div class="response text-white p-2">
                        <?php foreach($respostas as $resposta){  ?>  
                              <p><?= $resposta['mensagem'] ?></p>
                        <?php } ?>
                    </div>
                  </form>
              </div>
            
              
              <?php endif; ?>
              <?php } ?>
              <?php } ?>
            </div>

            <?php 
            unset($pdo);
            ?>
   
<?php
  include_once "../body/rodape.php";
?>
      