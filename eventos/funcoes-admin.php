<?php

//funcoes da pagina home

function emAberto($pdo, $tipo)
{
    if($tipo == 9){
        $sql = "SELECT count(chamado.status) FROM chamado INNER JOIN usuario ON usuario.id_usuario = chamado.id_usuario AND chamado.status = 1";
    }   else {

    $sql = "SELECT count(chamado.status) FROM chamado INNER JOIN usuario ON usuario.id_usuario = chamado.id_usuario INNER JOIN departamento ON chamado.id_departamento = departamento.id_departamento AND chamado.status = 1 AND departamento.id_departamento = $tipo";
    }
      
      $stmt = $pdo->query($sql)->fetchAll();

      return $stmt[0][0];
}

function andamento($pdo,$tipo)
{
    if($tipo == 9){
        $sql = "SELECT count(chamado.status) FROM chamado INNER JOIN usuario ON usuario.id_usuario = chamado.id_usuario AND chamado.status = 2";
    }   else {

    $sql = "SELECT count(chamado.status) FROM chamado INNER JOIN usuario ON usuario.id_usuario = chamado.id_usuario INNER JOIN departamento ON chamado.id_departamento = departamento.id_departamento AND chamado.status = 2 AND departamento.id_departamento = $tipo";
    }

    $stmt = $pdo->query($sql)->fetchAll();

    return $stmt[0][0];
}

function concluido($pdo, $tipo)
{
    if($tipo == 9){
        $sql = "SELECT count(chamado.status) FROM chamado INNER JOIN usuario ON usuario.id_usuario = chamado.id_usuario AND chamado.status = 0";
    }   else {
    
    $sql = "SELECT count(chamado.status) FROM chamado INNER JOIN usuario ON usuario.id_usuario = chamado.id_usuario INNER JOIN departamento ON chamado.id_departamento = departamento.id_departamento AND chamado.status = 0 AND departamento.id_departamento = $tipo";
    }

    $stmt = $pdo->query($sql)->fetchAll();

    return $stmt[0][0];
}



function listagemEmAberto($pdo, $tipo)
{

    if($tipo == 9){
            $sql = "SELECT 
            usuario.id_usuario, 
            usuario.nome, 
            usuario.tipo,
            chamado.data, 
            chamado.titulo, 
            chamado.id_chamado 
        FROM chamado 
        INNER JOIN usuario ON usuario.id_usuario = chamado.id_usuario 
        AND chamado.status = 1";
    }   else {
            $sql = "SELECT 
            usuario.id_usuario, 
            usuario.nome, 
            usuario.tipo,
            chamado.data, 
            chamado.titulo, 
            chamado.id_chamado 
        FROM chamado 
        INNER JOIN usuario ON usuario.id_usuario = chamado.id_usuario
        INNER JOIN departamento ON departamento.id_departamento = chamado.id_departamento 
        AND chamado.status = 1 
        AND departamento.id_departamento = $tipo
        ";
    }

    $stmt = $pdo->query($sql)->fetchAll();

    return $stmt;   
}

function listagemConcluido($pdo, $tipo)
{

    if($tipo == 9){
            $sql = "SELECT 
            usuario.id_usuario, 
            usuario.nome, 
            usuario.tipo,
            chamado.data, 
            chamado.titulo, 
            chamado.id_chamado 
        FROM chamado 
        INNER JOIN usuario ON usuario.id_usuario = chamado.id_usuario 
        AND chamado.status = 0";
    }   else {
            $sql = "SELECT 
            usuario.id_usuario, 
            usuario.nome, 
            usuario.tipo,
            chamado.data, 
            chamado.titulo, 
            chamado.id_chamado 
        FROM chamado 
        INNER JOIN usuario ON usuario.id_usuario = chamado.id_usuario
        INNER JOIN departamento ON departamento.id_departamento = chamado.id_departamento 
        AND chamado.status = 0 
        AND departamento.id_departamento = $tipo";
    }
        $stmt = $pdo->query($sql)->fetchAll();

        return $stmt;

}

function listagemAndamento($pdo, $tipo)
{
    if($tipo == 9){
            $sql = "SELECT 
            usuario.id_usuario, 
            usuario.nome, 
            usuario.tipo,
            chamado.data, 
            chamado.titulo, 
            chamado.id_chamado 
        FROM chamado 
        INNER JOIN usuario ON usuario.id_usuario = chamado.id_usuario 
        AND chamado.status = 2";
    }   else {
            $sql = "SELECT 
            usuario.id_usuario, 
            usuario.nome, 
            usuario.tipo,
            chamado.data, 
            chamado.titulo, 
            chamado.id_chamado 
        FROM chamado 
        INNER JOIN usuario ON usuario.id_usuario = chamado.id_usuario
        INNER JOIN departamento ON departamento.id_departamento = chamado.id_departamento 
        AND chamado.status = 2 
        AND departamento.id_departamento = $tipo";    
    }
    
    $stmt = $pdo->query($sql)->fetchAll();

    return $stmt;

}


//funcoes da pagina relatorio-admin

function adicionarEmAndamento($pdo, $id, $titulo) {
    $sql = "UPDATE chamado SET status = 2 WHERE titulo = :t AND id_usuario = :i";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':t', $titulo);
    $stmt->bindParam(':i', $id);

    if ($stmt->execute()) {
        echo "Adicionado com sucesso";
    } else {
        echo "Erro ao adicionar";
    }
}


function mensagemAdmin($pdo, $id_chamado)
{

        $sql = "SELECT mensagem_chamado.texto, mensagem_chamado.hora, mensagem_chamado.id_mensagem_chamado, usuario.nome FROM mensagem_chamado INNER JOIN usuario on mensagem_chamado.id_usuario = usuario.id_usuario and mensagem_chamado.id_chamada = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id_chamado);
        $stmt->execute();
        $mensagem = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
        if($mensagem) {
            return $mensagem;
        } 
}

function obtendoRespostas($id, $pdo)
{

    $sql = "SELECT resposta_chamado.mensagem from resposta_chamado inner join mensagem_chamado on mensagem_chamado.id_mensagem_chamado = resposta_chamado.id_mensagem_chamado and mensagem_chamado.id_mensagem_chamado = $id";
    $stmt = $pdo->query($sql)->fetchAll();

    if($stmt){
        return $stmt;
    } else {
        return null;
    }

}

function tipoUsuario($pdo, $id)
{
    $sql = "SELECT tipo FROM usuario WHERE id_usuario = $id";
    $stmt = $pdo->query($sql)->fetch();

    if($stmt){
        return $stmt;
    } else {
        return null;
    }
}

function exibirRelatorioSql($tipo, $id){

    if($tipo['tipo'] == 1){ //TI
       return $sql = "SELECT ROW_NUMBER() OVER (ORDER BY chamado.prioridade DESC) AS ordem, usuario.id_usuario, chamado.id_chamado, usuario.nome, unidade.nome_unidade, setor.nome_setor, chamado.titulo, chamado.status, chamado.prioridade, departamento.nome as 'nome_departamento' FROM usuario INNER JOIN unidade ON unidade.id_unidade = usuario.id_unidade INNER JOIN setor ON usuario.id_setor = setor.id_setor INNER JOIN chamado ON chamado.id_usuario = usuario.id_usuario INNER JOIN departamento on departamento.id_departamento = chamado.id_departamento and departamento.id_departamento = 1 ORDER BY chamado.prioridade DESC, chamado.status DESC";
   } else if ($tipo['tipo'] == 2){ //Marketing
        return $sql = "SELECT ROW_NUMBER() OVER (ORDER BY chamado.prioridade DESC) AS ordem, usuario.id_usuario, chamado.id_chamado, usuario.nome, unidade.nome_unidade, setor.nome_setor, chamado.titulo, chamado.status, chamado.prioridade, departamento.nome as 'nome_departamento' FROM usuario INNER JOIN unidade ON unidade.id_unidade = usuario.id_unidade INNER JOIN setor ON usuario.id_setor = setor.id_setor INNER JOIN chamado ON chamado.id_usuario = usuario.id_usuario INNER JOIN departamento on departamento.id_departamento = chamado.id_departamento and departamento.id_departamento = 2 ORDER BY chamado.prioridade DESC, chamado.status DESC";
    } else if ($tipo['tipo'] == 3){ //RH
        return $sql = "SELECT ROW_NUMBER() OVER (ORDER BY chamado.prioridade DESC) AS ordem, usuario.id_usuario, chamado.id_chamado, usuario.nome, unidade.nome_unidade, setor.nome_setor, chamado.titulo, chamado.status, chamado.prioridade, departamento.nome as 'nome_departamento' FROM usuario INNER JOIN unidade ON unidade.id_unidade = usuario.id_unidade INNER JOIN setor ON usuario.id_setor = setor.id_setor INNER JOIN chamado ON chamado.id_usuario = usuario.id_usuario INNER JOIN departamento on departamento.id_departamento = chamado.id_departamento and departamento.id_departamento = 3 ORDER BY chamado.prioridade DESC, chamado.status DESC";
    } else if ($tipo['tipo'] == 4){ //FINANCEIRO
        return $sql = "SELECT ROW_NUMBER() OVER (ORDER BY chamado.prioridade DESC) AS ordem, usuario.id_usuario, chamado.id_chamado, usuario.nome, unidade.nome_unidade, setor.nome_setor, chamado.titulo, chamado.status, chamado.prioridade, departamento.nome as 'nome_departamento' FROM usuario INNER JOIN unidade ON unidade.id_unidade = usuario.id_unidade INNER JOIN setor ON usuario.id_setor = setor.id_setor INNER JOIN chamado ON chamado.id_usuario = usuario.id_usuario INNER JOIN departamento on departamento.id_departamento = chamado.id_departamento and departamento.id_departamento = 4 ORDER BY chamado.prioridade DESC, chamado.status DESC";
    } else if ($tipo['tipo'] == 5){ //COBRANÇA
        return $sql = "SELECT ROW_NUMBER() OVER (ORDER BY chamado.prioridade DESC) AS ordem, usuario.id_usuario, chamado.id_chamado, usuario.nome, unidade.nome_unidade, setor.nome_setor, chamado.titulo, chamado.status, chamado.prioridade, departamento.nome as 'nome_departamento' FROM usuario INNER JOIN unidade ON unidade.id_unidade = usuario.id_unidade INNER JOIN setor ON usuario.id_setor = setor.id_setor INNER JOIN chamado ON chamado.id_usuario = usuario.id_usuario INNER JOIN departamento on departamento.id_departamento = chamado.id_departamento and departamento.id_departamento = 5 ORDER BY chamado.prioridade DESC, chamado.status DESC";
    } else if ($tipo['tipo'] == 9){ // TODOS
        return $sql = "SELECT ROW_NUMBER() OVER (ORDER BY chamado.prioridade DESC) AS ordem, usuario.id_usuario, chamado.id_chamado, usuario.nome, unidade.nome_unidade, setor.nome_setor, chamado.titulo, chamado.status, chamado.prioridade, departamento.nome as 'nome_departamento' FROM usuario INNER JOIN unidade ON unidade.id_unidade = usuario.id_unidade INNER JOIN setor ON usuario.id_setor = setor.id_setor INNER JOIN chamado ON chamado.id_usuario = usuario.id_usuario INNER JOIN departamento on departamento.id_departamento = chamado.id_departamento  ORDER BY chamado.prioridade DESC, chamado.status DESC";
   } 
}







 