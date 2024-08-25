<?php
require_once("valida_session.php");
require_once("bd/bd_acoes.php");

$codigo = $_GET['cod'];

// Verifica se o código da ação foi fornecido
if (isset($codigo)) {

    $dados = removeAcaoProjeto($codigo);

    if($dados == 0){
        $_SESSION['texto_erro'] = 'Os dados da ação não foram excluídos do sistema!';
        header("Location: acoes.php");
    } else {
        $_SESSION['texto_sucesso'] = 'Os dados da ação foram excluídos do sistema.';
        header("Location: acoes.php");
    }

} else {
    $_SESSION['texto_erro'] = 'Nenhum código de ação foi fornecido para exclusão!';
    header("Location: acoes.php");
}

?>
