<?php
require_once("conecta_bd.php");

function checaCliente($email, $senha) {
    $conexao = conecta_bd();
    $senhaMd5 = md5($senha);
    $query = "SELECT * FROM cliente WHERE email = ? AND senha = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("ss", $email, $senhaMd5);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_array(MYSQLI_ASSOC);
    $stmt->close();
    return $dados;
}

function listaClientes() {
    $conexao = conecta_bd();
    $clientes = array();
    $query = "SELECT * FROM cliente ORDER BY nome";
    $resultado = $conexao->query($query);
    while ($dados = $resultado->fetch_array(MYSQLI_ASSOC)) {
        array_push($clientes, $dados);
    }
    return $clientes;
}

function buscacliente($email) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM cliente WHERE email = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->num_rows;
    $stmt->close();
    return $dados;
}

function cadastraCliente($nome, $email, $senha, $cep, $logradouro,  $bairro, $cidade, $estado, $telefone, $status, $perfil, $data) {
    $conexao = conecta_bd();
    $query = "INSERT INTO cliente (nome, email, senha, cep, logradouro,  bairro, cidade, estado, telefone, status, perfil, data) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("ssssssssssss", $nome, $email, $senha, $cep, $logradouro, $bairro, $cidade, $estado, $telefone, $status, $perfil, $data);
    $stmt->execute();
    $dados = $stmt->affected_rows;
    $stmt->close();
    return $dados;
}

function removeCliente($codigo) {
    $conexao = conecta_bd();
    $query = "DELETE FROM cliente WHERE cod = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $dados = $stmt->affected_rows;
    $stmt->close();
    return $dados;
}

function buscaClienteeditar($codigo) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM cliente WHERE cod = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_array(MYSQLI_ASSOC);
    $stmt->close();
    return $dados;
}

function editarCliente($codigo, $status, $data) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM cliente WHERE cod = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->num_rows;
    if ($dados == 1) {
        $query = "UPDATE cliente SET status = ?, data = ? WHERE cod = ?";
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
