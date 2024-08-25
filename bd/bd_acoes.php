<?php
require_once("conecta_bd.php");

function listaAcoes(){
    $conexao = conecta_bd();
    $acoes = array();

    $query = "SELECT * FROM acoes_projeto ORDER BY data DESC";            
    $resultado = mysqli_query($conexao, $query);

    while($dados = mysqli_fetch_array($resultado)) {
        array_push($acoes, $dados);
    }

    return $acoes;
}

function cadastraAcaoProjeto($titulo, $descricao, $data, $imagem){
    $conexao = conecta_bd();

    $query = "INSERT INTO acoes_projeto(titulo, descricao, data, imagem) 
              VALUES ('$titulo', '$descricao', '$data', '$imagem')";
   
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);
    return $dados;
}

function removeAcaoProjeto($codigo) {
    $conexao = conecta_bd();

    $query = "DELETE FROM acoes_projeto WHERE cod = '$codigo'";
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_affected_rows($conexao);
    return $dados;
}

function buscaAcaoProjeto($codigo){
    $conexao = conecta_bd();

    $query = "SELECT * FROM acoes_projeto WHERE cod = '$codigo'";
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;
}

function editarAcaoProjeto($codigo, $titulo, $descricao, $data, $imagem = null) {
    $conexao = conecta_bd();

    $query = "SELECT * FROM acoes_projeto WHERE cod = '$codigo'";
    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_num_rows($resultado);

    if($dados == 1) {
        // Atualiza a imagem apenas se uma nova imagem foi enviada
        if ($imagem) {
            $query = "UPDATE acoes_projeto 
                      SET titulo = '$titulo', descricao = '$descricao', data = '$data', imagem = '$imagem'
                      WHERE cod = '$codigo'";
        } else {
            $query = "UPDATE acoes_projeto 
                      SET titulo = '$titulo', descricao = '$descricao', data = '$data'
                      WHERE cod = '$codigo'";
        }

        $resultado = mysqli_query($conexao, $query);
        $dados = mysqli_affected_rows($conexao);
        return $dados;      
    } else {
        return 0; // Caso a ação não seja encontrada
    }
}

?>
