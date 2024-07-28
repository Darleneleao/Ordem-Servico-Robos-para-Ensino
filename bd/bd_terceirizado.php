<?php
require_once("conecta_bd.php");

function checaTerceirizado($email, $senha) {
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);
    $query = "SELECT * FROM terceirizado WHERE email = ? AND senha = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("ss", $email, $senhaMd5);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_array(MYSQLI_ASSOC);
    $stmt->close();
    return $dados;
}

function listaTerceirizados() {
    $conexao = conecta_bd();
    $terceirizados = array();
    $query = "SELECT * FROM terceirizado ORDER BY nome";
    $resultado = $conexao->query($query);
    while ($dados = $resultado->fetch_array(MYSQLI_ASSOC)) {
        array_push($terceirizados, $dados);
    }
    return $terceirizados;
}

function buscaTerceirizado($email) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM terceirizado WHERE email = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->num_rows;
    $stmt->close();
    return $dados;
}

function cadastraTerceirizado($nome, $email, $telefone, $senha, $status, $perfil, $data) {
    $conexao = conecta_bd();
    $query = "INSERT INTO terceirizado (nome, email, telefone, senha, status, perfil, data) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("sssssss", $nome, $email, $telefone, $senha, $status, $perfil, $data);
    $stmt->execute();
    $dados = $stmt->affected_rows;
    $stmt->close();
    return $dados;
}

function removeTerceirizado($codigo) {
    $conexao = conecta_bd();
    $query = "DELETE FROM terceirizado WHERE cod = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $dados = $stmt->affected_rows;
    $stmt->close();
    return $dados;
}

function buscaTerceirizadoeditar($codigo) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM terceirizado WHERE cod = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_array(MYSQLI_ASSOC);
    $stmt->close();
    return $dados;
}

function editarTerceirizado($codigo, $status, $data) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM terceirizado WHERE cod = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->num_rows;
    if ($dados == 1) {
        $query = "UPDATE terceirizado SET status = ?, data = ? WHERE cod = ?";
        $stmt = $conexao->prepare($query);
        $stmt->bind_param("ssi", $status, $data, $codigo);
        $stmt->execute();
        $dados = $stmt->affected_rows;
        $stmt->close();
        return $dados;
    }
    $stmt->close();
    return 0;
}
?>
