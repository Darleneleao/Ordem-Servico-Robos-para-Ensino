<?php
require_once("valida_session.php");
require_once("bd/bd_acoes.php");

$codigo = $_POST["cod"];
$titulo = $_POST["titulo"];
$descricao = $_POST["descricao"];
$data = $_POST["data"];
$imagem = "";

// Verifica se uma nova imagem foi enviada
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
    $imagem_nome = $_FILES['imagem']['name'];
    $imagem_tmp = $_FILES['imagem']['tmp_name'];

    // Diretório onde a imagem será salva
    $imagem_dir = "uploads/" . $imagem_nome;

    // Move a imagem para o diretório desejado
    if (move_uploaded_file($imagem_tmp, $imagem_dir)) {
        $imagem = $imagem_nome;
    } else {
        $_SESSION['texto_erro'] = 'Falha ao enviar a nova imagem.';
        header("Location: editar_acoes.php?cod=$codigo");
        exit();
    }
} else {
    // Se nenhuma nova imagem for enviada, manter a imagem existente
    $imagem = $_POST['imagem_atual'];
}

// Atualiza os dados da ação no banco de dados
$dados = editarAcaoProjeto($codigo, $titulo, $descricao, $data, $imagem);

if ($dados == 1) {
    $_SESSION['texto_sucesso'] = 'Os dados da ação foram alterados no sistema.';
    header("Location: acoes.php");
} else {
    $_SESSION['texto_erro'] = 'Os dados da ação não foram alterados no sistema!';
    header("Location: editar_acoes.php?cod=$codigo");
}
?>
