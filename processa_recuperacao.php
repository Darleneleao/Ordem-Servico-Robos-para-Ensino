<?php
include './bd/conecta_bd.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];

    // Hash da nova senha usando md5
    $hashed_password = md5($new_password);

    $conexao = conecta_bd();

    // Função para verificar e executar a consulta
    function verifica_usuario($conexao, $query) {
        $result = mysqli_query($conexao, $query);
        if (!$result) {
            echo "Erro na consulta: " . mysqli_error($conexao);
            exit();
        }
        return $result;
    }

    // Verifique se o e-mail pertence a um usuario, cliente ou terceirizado
    $query_user = "SELECT * FROM usuario WHERE email='$email'";
    $query_client = "SELECT * FROM cliente WHERE email='$email'";
    $query_third_party = "SELECT * FROM terceirizado WHERE email='$email'";

    $result_user = verifica_usuario($conexao, $query_user);
    $result_client = verifica_usuario($conexao, $query_client);
    $result_third_party = verifica_usuario($conexao, $query_third_party);

    if (mysqli_num_rows($result_user) > 0) {
        $update_query = "UPDATE usuario SET senha='$hashed_password' WHERE email='$email'";
    } elseif (mysqli_num_rows($result_client) > 0) {
        $update_query = "UPDATE cliente SET senha='$hashed_password' WHERE email='$email'";
    } elseif (mysqli_num_rows($result_third_party) > 0) {
        $update_query = "UPDATE terceirizado SET senha='$hashed_password' WHERE email='$email'";
    } else {
        echo "E-mail não encontrado.";
        exit();
    }

    // Executa a consulta de atualização
    if (mysqli_query($conexao, $update_query)) {
        echo "Senha alterada com sucesso.";
    } else {
        echo "Erro ao alterar a senha: " . mysqli_error($conexao);
    }

    mysqli_close($conexao);
} else {
    echo "Método de requisição inválido.";
}
?>
