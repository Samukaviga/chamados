<?php

include_once "../conexao.php";
include_once "../body/menu.php";

// Verifica se o parâmetro de página foi definido na URL
$page = isset($_GET['page']) ? $_GET['page'] : 1;

// Define o número de registros a serem exibidos por página
$limit = 10;

// Calcula o offset com base na página atual
$offset = ($page - 1) * $limit;

// Consulta SQL para recuperar os dados em grupos de 10 com base no offset
$sql = "SELECT * FROM chamado LIMIT $limit OFFSET $offset";

$result = $pdo->query($sql);

// Exibição dos dados em uma tabela HTML
if ($result->rowCount() > 0){
    ?>
    <table class= 'table table-success table-striped h6'>
        <tr><th>ID</th><th>Nome</th><th>Email</th></tr>
    
        <?php while ($row = $result->fetch(PDO::FETCH_ASSOC)): ?>
            <tr><td><?= $row["id_usuario"] ?></td>
            <td><?= $row["mensagem"] ?></td>
            <td><?= $row["titulo"]?></td></tr>
        <?php endwhile; ?>
    </table>
    <?php } else {
    echo "Nenhum resultado encontrado.";
}

// Botões de navegação de página
$total_pages_sql = "SELECT COUNT(*) as total FROM chamado";
$result = $pdo->query($total_pages_sql);
$row = $result->fetch(PDO::FETCH_ASSOC);
$total_records = $row['total'];
$total_pages = ceil($total_records / $limit);
?>

<div class='pagination'>

<?php for ($i = 1; $i <= $total_pages; $i++): ?>
    <a href='?page="<?= $i ?>"'><?= $i ?></a>
<?php endfor; ?>
</div>

<?php 
$pdo = null;

  include_once "../body/rodape.php";

?>
