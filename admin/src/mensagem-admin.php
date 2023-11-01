<?php
  
    include_once "../../conexao.php";
    include_once "../body/menu-admin.php";
    include_once "../../eventos/funcoes-admin.php";

  // Verifique se o usuário está logado, se não, redirecione-o para uma página de login
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../src/login.php");
    exit;
}

    $id_admin = $_SESSION["id_usuario"];
          
        

                $id_chamado = $_GET["id_chamado"];


                 $sql = "SELECT chamado.mensagem, chamado.id_chamado, chamado.hora, usuario.nome from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and chamado.id_chamado = $id_chamado";

                  $stmt = $pdo->query($sql)->fetchAll();

                $mensagens = mensagemAdmin($pdo, $id_chamado);
?>
<style>
    .response {
      background-color: #B0E0E6; /* Cor de fundo da resposta */
      border-radius: 10px;
      padding: 10px;
      margin-top: 5px;   
    }

</style>
                

            <div class="message-container">
                <div class="d-flex justify-content-start"> <!-- Nome usuario -->
                    <p class="bg-primary text-white rounded p-2"><?= $stmt[0][3]; ?></p>
                </div>
                <div class="message text-right">
                    <p class="py-2"><?php echo $stmt[0][0]. "<br />\n"; //mensagem ?></p>
                    <span class="message-time"><?php echo $stmt[0][2]; //hora ?></span>
                </div>
                <?php
                if($mensagens){
                    foreach($mensagens as $mensagem ){
                ?>
                <div class="message">
                    <p class=""><?php echo $mensagem["texto"]; ?></p>
                    <span class="message-time"><?php echo $mensagem["hora"]; ?></span>
                
                    <!-- inicio -->
                        <?php
                        
                        $respostas = obtendoRespostas($mensagem['id_mensagem_chamado'], $pdo);
                        
                        if ($respostas !== null):
                        ?>
                        
                        <div class="response bg-primary text-white">
                            <?php foreach($respostas as $resposta){  ?>  
                                <p><?= $resposta['mensagem'] ?></p>
                            <?php } ?>
                        </div>
                    <!-- fim -->
                
                </div>
                
                <?php endif; ?>
                <?php } ?>
                <?php } ?>
            </div>
           
            <div class="fixed-bottom">
                <form method="POST" action="./adicionando_mensagem.php?id_chamado=<?=$id_chamado;?>">
                    <div class="message reply-container">
                    <input type="text" name="mensagem" id="mensagem" class="form-control reply-input mb-2" placeholder="Digite sua resposta">
                    <button type="submit" class="btn btn-primary">Responder</button>
                    </div>
                </form>
            </div> 
            
            <?php 
            unset($pdo);
            ?>
   
<?php
  include_once "../../body/rodape.php";
?>
    