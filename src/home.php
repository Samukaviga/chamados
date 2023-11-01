
    <?php 
    include_once "../conexao.php";
    include_once "../body/menu.php";
    include_once "../eventos/funcoes.php";

    $id_usuario = $_SESSION["id_usuario"];

    echo $id_usuario;

    
    // Verifique se o usuário está logado, se não, redirecione-o para uma página de login
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: login.php");
      exit;
}
    ?>
<div class="container mt-4">
  <!-- Content here -->

     <div class="row mb-2">
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 shadow-sm h-md-250">
            <div class="card-body d-flex flex-column align-items-center pt-4">
                <h3 class="mb-0">
                  <a class=" text-decoration-none font-size-lg text-success" data-bs-toggle="offcanvas" data-bs-target="#menu-1" aria-controls="offcanvasRight" href="#"><?php echo emAberto($id_usuario, $pdo)?></a>
                </h3>
              <div class="mb-1 py-2 text-muted">Em aberto</div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 shadow-sm h-md-250">
            <div class="card-body d-flex flex-column align-items-center pt-4">
              <h3 class="mb-0">
                <a class="text-decoration-none font-size-lg text-success" data-bs-toggle="offcanvas" data-bs-target="#menu-2" aria-controls="offcanvasRight" href="#"><?php echo concluido($id_usuario, $pdo)?></a>
              </h3>
              <div class="mb-1 py-2 text-muted">Concluido</div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
                <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                    <div class="card-body d-flex flex-column align-items-center">
                    <h3 class="mb-0">
                        <a class="text-decoration-none font-size-lg text-success" data-bs-toggle="offcanvas" data-bs-target="#menu-3" aria-controls="offcanvasRight" href="#"><?php echo andamento($id_usuario, $pdo)?></a>
                    </h3>
                    <div class="mb-1 py-2 text-muted">Andamento</div>
                </div>
             </div>
           </div>
         </div>
       </div>  
      </div>
    </div>
 
</div>

  <!-- Menu 1 -->
    <div class="offcanvas offcanvas-end" tabindex="-1" id="menu-1">
      <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Em Aberto</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
    
        <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th>Titulo</th>
                    </tr>
                </thead>
                <tbody>
                      <?php 
                          $listagem = listagemEmaberto($id_usuario, $pdo);
                            
                          foreach ($listagem as $row) {
                        ?>
                              <tr>
                              <td><a href="mensagem.php?id_chamado=<?=$row['id_chamado']; ?>" class="link-success"><?php echo $row['titulo']."<br />\n";?></a></td>
                              </tr>

                      <?php }?>

                </tbody>
          </table>


      </div>
    </div>
  <!-- Menu 2-->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="menu-2">
      <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Concluido</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
                    
            <table class="table table-success table-striped">
                  <thead>
                      <tr>
                          <th>Titulo</th>
                      </tr>
                  </thead>
                  <tbody>
                        <?php 
                            $listagem = listagemConcluido($id_usuario, $pdo);
                              
                            foreach ($listagem as $row) {
                          ?>
                                <tr>
                                <td><a href="mensagem.php?id_chamado=<?=$row['id_chamado']; ?>" class="link-success"><?php echo $row['titulo']."<br />\n";?></a></td>
                                </tr>

                        <?php }?>

                  </tbody>
            </table>


      </div>
  </div>
  <!-- Menu 3 -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="menu-3">
      <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Concluido</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
                    
          <table class="table table-success table-striped">
                <thead>
                    <tr>
                        <th>Titulo</th>
                    </tr>
                </thead>
                <tbody>
                      <?php 
                          $listagem = listagemAndamento($id_usuario, $pdo);
                            
                          foreach ($listagem as $row) {
                        ?>
                              <tr>
                              <td><a href="mensagem.php?id_chamado=<?=$row['id_chamado']; ?>" class="link-success"><?php echo $row['titulo']."<br />\n";?></a></td>
                              </tr>

                      <?php }?>

                </tbody>
          </table>


      </div>
  </div>

    <?php include_once "../body/rodape.php"?>
