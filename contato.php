<?php
require_once('valida_session.php');
require_once('header.php'); 
require_once('sidebar.php');
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Acessando os dados do usuário logado armazenados na sessão
$nomeUsuario = $_SESSION['nome_usuario'];
$emailUsuario = $_SESSION['email_usuario'];

if (isset($_POST["send"])) {
    $mail = new PHPMailer(true);

    try {
        // Configurações do servidor SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'darlene.leao.souza10@gmail.com'; // Substitua pelo seu e-mail
        $mail->Password   = 'htvtqgwvgqwqlvlg';           // Substitua pela sua senha
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        // Configurações de destinatários
        $mail->setFrom($emailUsuario, $nomeUsuario);
        $mail->addAddress('darlene.leao.souza10@gmail.com'); // Substitua pelo e-mail do destinatário
        $mail->addReplyTo($emailUsuario, $nomeUsuario);

        // Verifica se um arquivo foi enviado e o anexa
        if (isset($_FILES['pdf']) && $_FILES['pdf']['error'] == UPLOAD_ERR_OK) {
            $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['pdf']['name']));
            move_uploaded_file($_FILES['pdf']['tmp_name'], $uploadfile);
            $mail->addAttachment($uploadfile, $_FILES['pdf']['name']);
        }

        // Conteúdo do email
        $mail->isHTML(true);
        $mail->Subject = $_POST["subject"];
        $mail->Body    = $_POST["message"];

        // Envia o email
        $mail->send();
        echo "<script>alert('Mensagem enviada com sucesso!');document.location.href = 'contato.php';</script>";
    } catch (Exception $e) {
        echo "<script>alert('Erro ao enviar a mensagem: {$mail->ErrorInfo}');</script>";
    }
}
?>

<!-- Main Content -->
<div id="content">
    <?php require_once('navbar.php'); ?>

    <!-- Begin Page Content -->
    <div class="container-fluid">
        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-primary" id="title">CONTATO</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="user" action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label> Nome Completo </label>
                        <input type="text" class="form-control form-control-user" id="name" name="name" value="<?php echo $nomeUsuario; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label> Email </label>
                        <input type="text" class="form-control form-control-user" id="email" name="email" value="<?php echo $emailUsuario; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label> Assunto </label>
                        <input type="text" class="form-control form-control-user" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label> Mensagem </label>
                        <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label> Anexar PDF (opcional) </label>
                        <input type="file" name="pdf" class="form-control-file">
                    </div>
                    <div class="card-footer text-muted" id="btn-form">
                        <div class=text-right>
                            <a title="Voltar" href="home.php"><button type="button" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i>&nbsp;</i>Voltar</button></a>
                            <button type="submit" name="send" class="btn btn-primary"><i class="fas fa-paper-plane"></i>&nbsp;Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Page Content -->
</div>
<!-- End of Main Content -->
