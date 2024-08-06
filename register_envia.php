<?php
session_start();
$nome = $_POST["nome"];
$senha = md5($_POST["senha"]);
$email = $_POST["email"];
$perfil = 2;
$status = 1;
$data=date("y/m/d");
$cep = $_POST["cep"];
$logradouro = $_POST["logradouro"];
$bairro = $_POST["bairro"];
$cidade = $_POST["cidade"];
$estado = $_POST["estado"];
$telefone = $_POST["telefone"];

require_once ("bd/bd_cliente.php");
$dados = buscaCliente($email);

if($dados != 0){
	$_SESSION['texto_erro_register'] = 'Este email já existe cadastrado no sistema!';
	$_SESSION['nome'] = $nome;
	header ("Location:register.php");
}else{
	$dados = cadastraCliente($nome, $email, $senha, $cep, $logradouro, $bairro, $cidade, $estado, $telefone, $status, $perfil, $data);
	if($dados == 1){
		$_SESSION['texto_sucesso_register'] = 'Dados adicionados com sucesso.';
		unset($_SESSION['texto_erro_register']);
		header ("Location:index.php");
	}else{
		$_SESSION['texto_erro_register'] = 'O dados não foram adicionados no sistema!';
		$_SESSION['nome'] = $nome;
		header ("Location:register.php");
	}
	
}

?>