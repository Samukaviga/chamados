<?php

// Numeros pagina home

function emAberto($id, $pdo)
{
    $sql = "SELECT count(chamado.status) from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_usuario = $id and chamado.status = 1";

      
      $stmt = $pdo->query($sql)->fetchAll();

      return $stmt[0][0];
}

function andamento($id, $pdo)
{
    $sql = "select count(chamado.status) from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_usuario = $id and chamado.status = 2";

    $stmt = $pdo->query($sql)->fetchAll();

    return $stmt[0][0];
}

function concluido($id, $pdo)
{

    $sql = "select count(chamado.status) from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_usuario = $id and chamado.status = 0";

    $stmt = $pdo->query($sql)->fetchAll();

    return $stmt[0][0];
}


// Listas OffCanvas

function listagemEmAberto($id, $pdo)
{

    $sql = "select chamado.titulo, chamado.id_chamado from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_usuario = $id and chamado.status = 1";

    $stmt = $pdo->query($sql)->fetchAll();

    return $stmt;
}

function listagemConcluido($id, $pdo)
{

    $sql = "select chamado.titulo, chamado.id_chamado from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_usuario = $id and chamado.status = 0";
    $stmt = $pdo->query($sql)->fetchAll();

    return $stmt;

}

function listagemAndamento($id, $pdo)
{
    $sql = "select chamado.titulo, chamado.id_chamado from chamado inner join usuario on usuario.id_usuario = chamado.id_usuario and usuario.id_usuario = $id and chamado.status = 2";
    $stmt = $pdo->query($sql)->fetchAll();

    return $stmt;

}

//Pagina chamadas


function listagemDepartamento($pdo)
{
    $sql = "SELECT id_departamento, nome FROM departamento ORDER BY nome";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $lista = $stmt->fetchAll();

    if($lista){
        return $lista;
    } else {
        return null;
    }

}

function listagemPessoas($pdo)
{
    $sql = "SELECT id_usuario, nome, sobrenome FROM usuario WHERE tipo = 0 ORDER BY nome";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $lista = $stmt->fetchAll();

    if($lista){
        return $lista;
    } else {
        return null;
    }
}

