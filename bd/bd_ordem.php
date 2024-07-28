<?php
require_once("conecta_bd.php");

function checaOrdem($cod_cliente, $cod_servico, $data_servico) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM ordem WHERE cod_cliente = ? AND cod_servico = ? AND data_servico = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("iis", $cod_cliente, $cod_servico, $data_servico);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->fetch_array(MYSQLI_ASSOC);
    $stmt->close();
    return $dados;
}

function listaOrdem(){
    $conexao = conecta_bd();
    $ordens = array();
    $query = "SELECT 
    os.cod AS ordem_cod,
    c.nome AS nome_cliente,
    t.nome AS nome_terceirizado,
    s.nome AS nome_servico,
    os.data_servico,
    os.status
FROM 
    ordem os
JOIN 
    cliente c ON os.cod_cliente = c.cod
JOIN 
    terceirizado t ON os.cod_terceirizado = t.cod
JOIN 
    servico s ON os.cod_servico = s.cod;";

    $resultado = mysqli_query($conexao, $query);
    while ($dados = mysqli_fetch_array($resultado)){
        array_push($ordens, $dados);
    }
    return $ordens;

}

function buscaOrdem($cod_cliente, $cod_servico) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM ordem WHERE cod_cliente = ? AND cod_servico = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("ii", $cod_cliente, $cod_servico);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->num_rows;
    $stmt->close();
    return $dados;
}

function cadastraOrdem($cod_cliente, $cod_servico, $cod_terceirizado, $data_servico, $status, $data) {
    $conexao = conecta_bd();
    $query = "INSERT INTO ordem (cod_cliente, cod_servico, cod_terceirizado, data_servico, status, data) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("iiisss", $cod_cliente, $cod_servico, $cod_terceirizado, $data_servico, $status, $data);
    $stmt->execute();
    $dados = $stmt->affected_rows;
    $stmt->close();
    return $dados;
}

function removeOrdem($codigo) {
    $conexao = conecta_bd();
    $query = "DELETE FROM ordem WHERE cod = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $dados = $stmt->affected_rows;
    $stmt->close();
    return $dados;
}

function buscaOrdemeditar($codigo){
    $conexao = conecta_bd();
    $query = "Select 
    o.cod AS cod,
    c.nome AS nome_cliente,
    t.nome AS nome_terceirizada,
    s.nome AS nome_servico,
    o.data_servico AS data_servico,
    o.status AS status,
    t.cod AS cod_terceirizado
    From ordem o,servico s, cliente c, terceirizado t 
    Where o.cod_cliente = c.cod AND 
          o.cod_servico = s.cod AND 
          o.cod_terceirizado = t.cod AND
          o.cod = '$codigo'";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);

    return $dados;


}

function editarOrdem($codigo, $status, $data) {
    $conexao = conecta_bd();
    $query = "SELECT * FROM ordem WHERE cod = ?";
    $stmt = $conexao->prepare($query);
    $stmt->bind_param("i", $codigo);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $dados = $resultado->num_rows;
    if ($dados == 1) {
        $query = "UPDATE ordem SET status = ?, data = ? WHERE cod = ?";
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

function buscaOrdemadd()
{
    $conexao = conecta_bd();

    $query = "Select
           c.nome AS nome_cliente,
           t.nome AS nome_terceirizada,
           s.nome AS nome_servico,
           s.valor AS valor_servico, 
           o.data_servico AS data_servico,
           o.status AS status
           From ordem o, servico s, cliente c, terceirizado t where o.cod_cliente = c.cod AND o.cod_servico = s.cod AND o.cod_terceirizado = t.cod order by o.cod DESC LIMIT 1";

    $resultado = mysqli_query($conexao, $query);
    $dados = mysqli_fetch_array($resultado);


    return $dados;
}

function consultaStatusCliente($cod_usuario,$status){
    $conexao = conecta_bd();
    $query = "select count(*) AS total from ordem where status = '$status' and cod_cliente = '$cod_usuario'";

    $resultado = mysqli_query($conexao, $query);
    $total = mysqli_fetch_array($resultado);

    return $total;

}


function consultaStatusTerceirizado($cod_usuario,$status){
    $conexao = conecta_bd();
    $query = "select count(*) AS total from ordem where status = '$status' and cod_terceirizado = '$cod_usuario'";

    $resultado = mysqli_query($conexao, $query);
    $total = mysqli_fetch_array($resultado);

    return $total;


}

function consultaStatusUsuario($status){
    $conexao = conecta_bd();
    $query = "select count(*) AS total from ordem where status = '$status'";

    $resultado = mysqli_query($conexao, $query);
    $total = mysqli_fetch_array($resultado);

    return $total;


}

?>
