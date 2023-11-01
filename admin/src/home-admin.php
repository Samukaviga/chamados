
<?php 
    include_once "../../conexao.php";
    include_once "../body/menu-admin.php";
    include_once "../../eventos/funcoes-admin.php";

    $id_usuario = $_SESSION["id_usuario"];

    $tipo = tipoUsuario($pdo, $id_usuario);
 
    
    // Verifique se o usuário está logado, se não, redirecione-o para uma página de login
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
      header("location: ../../src/login.php");
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
                  <a class=" text-decoration-none font-size-lg text-success" data-bs-toggle="offcanvas" data-bs-target="#menu-1" aria-controls="offcanvasRight" href="#"><?php echo emAberto($pdo, $tipo['tipo'])?></a>
                </h3>
              <div class="mb-1 py-2 text-muted">Em aberto</div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="card flex-md-row mb-4 shadow-sm h-md-250">
            <div class="card-body d-flex flex-column align-items-center pt-4">
              <h3 class="mb-0">
                <a class="text-decoration-none font-size-lg text-success" data-bs-toggle="offcanvas" data-bs-target="#menu-2" aria-controls="offcanvasRight" href="#"><?php echo concluido($pdo, $tipo['tipo'])?></a>
              </h3>
              <div class="mb-1 py-2 text-muted">Concluido</div>
            </div>
          </div>
        </div>
        <div class="col-md-6">
                <div class="card flex-md-row mb-4 shadow-sm h-md-250">
                    <div class="card-body d-flex flex-column align-items-center">
                    <h3 class="mb-0">
                        <a class="text-decoration-none font-size-lg text-success" data-bs-toggle="offcanvas" data-bs-target="#menu-3" aria-controls="offcanvasRight" href="#"><?php echo andamento($pdo, $tipo['tipo'])?></a>
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
                      <th>Nome</th>
                      <th>Data</th>
                      <th>Titulo</th>
                  </tr>
              </thead>
              <tbody>
                    <?php 
                        $listagem = listagemEmaberto($pdo, $tipo['tipo']);
                          
                        
                        foreach ($listagem as $row) {
                          
                      ?>
                            <tr>
                                <td><?php echo $row['nome']."<br />\n";?></td>
                                <td><?php echo date("d/m/Y", strtotime($row['data']))."<br />\n";?></td>
                                <td> <a href="mensagem-admin.php?id_chamado=<?=$row['id_chamado'];?>" class="link-success" id="aberto" onclick="handleClick('<?= $row['id_chamado'];?>', '<?= $tipo['tipo'];?>')"><?php echo $row['titulo']."<br />\n";?></a></td>
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
                      <th>Nome</th>
                      <th>Data</th>
                      <th>Titulo</th>
                  </tr>
              </thead>
              <tbody>
                    <?php 
                        $listagem = listagemConcluido($pdo, $tipo['tipo']);
                          
                        foreach ($listagem as $row) {
                      ?>
                            <tr>
                                <td><?php echo $row['nome']."<br />\n";?></td>
                                <td><?php echo date("d/m/Y", strtotime($row['data']))."<br />\n";?></td>
                                <td> <a href="mensagem-admin.php?id_chamado=<?=$row['id_chamado'];?>" class="link-success"><?php echo $row['titulo']."<br />\n";?></a></td>
                            </tr>

                    <?php }?>

              </tbody>
        </table>


      </div>
  </div>
  <!-- Menu 3 -->
  <div class="offcanvas offcanvas-end" tabindex="-1" id="menu-3">
      <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Andamento</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
      
         <table class="table table-success table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Data</th>
                    <th>Titulo</th>
                </tr>
            </thead>
            <tbody>
                  <?php 
                      $listagem = listagemAndamento($pdo, $tipo['tipo']);
                        
                      foreach ($listagem as $row) {
                    ?>
                          <tr>
                              <td><?php echo $row['nome']."<br />\n";?></td>
                              <td><?php echo date("d/m/Y", strtotime($row['data']))."<br />\n";?></td>
                              <td> <a href="mensagem-admin.php?id_chamado=<?=$row['id_chamado'];?>" class="link-success"><?php echo $row['titulo']."<br />\n";?></a></td>
                          </tr>
                  <?php }?>

            </tbody>
        </table>
      </div>
  </div>

    <?php include_once "../body/rodape-admin.php"?>

  <script src="./js/emAberto.js"></script>
  
