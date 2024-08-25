<?php
session_start();

$titulo = $_POST["titulo"];
$descricao = $_POST["descricao"];
$data = $_POST["data"];
$imagem = "";

// Verifica se uma imagem foi enviada
if(isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $imagem_nome = $_FILES['imagem']['name'];
    $imagem_tmp = $_FILES['imagem']['tmp_name'];

    // Diretório onde a imagem será salva
    $imagem_dir = "uploads/" . $imagem_nome;

    // Move a imagem para o diretório desejado
    if(move_uploaded_file($imagem_tmp, $imagem_dir)) {
        $imagem = $imagem_nome;
    } else {
        $_SESSION['texto_erro'] = 'Falha ao enviar a imagem.';
        header("Location: cad_acoes.php");
        exit();
    }
}

require_once("bd/bd_acoes.php");
$dados = cadastraAcaoProjeto($titulo, $descricao, $data, $imagem);

if($dados == 1) {
    $_SESSION['texto_sucesso'] = 'Ação do projeto adicionada com sucesso.';
    unset($_SESSION['texto_erro']);
    header("Location: acoes.php");
} else {
    $_SESSION['texto_erro'] = 'Os dados não foram adicionados no sistema!';
    $_SESSION['titulo'] = $titulo;
    $_SESSION['descricao'] = $descricao;
    header("Location: cad_acoes.php");
}
?>
