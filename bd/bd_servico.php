<?php
require_once("conecta_bd.php");

function checaServico($nome) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM servico WHERE nome = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_array(MYSQLI_ASSOC);
    $stmt->close();
    return $dados;
}

function listaServicos() {
    $conexao = conecta_bd();
    $servicos = array();
    $query = "SELECT * FROM servico ORDER BY nome";
    $resultado = $conexao->query($query);
    while ($dados = $resultado->fetch_array(MYSQLI_ASSOC)) {
        array_push($servicos, $dados);
    }
    return $servicos;
}

function buscaServico($nome) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM servico WHERE nome = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("s", $nome);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->num_rows;
    $stmt->close();
    return $dados;
}

function cadastraServico($nome, $valor, $data) {
    $conexao = conecta_bd();
    $query = "INSERT INTO servico (nome, valor, data) VALUES (?, ?, ?)";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("sss", $nome, $valor, $data);
    $stmt->execute();
    $dados = $stmt->affected_rows;
    $stmt->close();
    return $dados;
}

function removeServico($codigo) {
    $conexao = conecta_bd();
    $query = "DELETE FROM servico WHERE cod = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $dados = $stmt->affected_rows;
    $stmt->close();
    return $dados;
}

function buscaServicoeditar($codigo) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM servico WHERE cod = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_array(MYSQLI_ASSOC);
    $stmt->close();
    return $dados;
}

function editarServico($codigo, $nome, $valor, $data) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM servico WHERE cod = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->num_rows;
    if ($dados == 1) {
        $query = "UPDATE servico SET nome = ?, valor = ?, data = ? WHERE cod = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bind_param("sssi", $nome, $valor, $data, $codigo);
        $stmt->execute();
        $dados = $stmt->affected_rows;
        $stmt->close();
        return $dados;
    }
    $stmt->close();
    return 0;
}
?>
