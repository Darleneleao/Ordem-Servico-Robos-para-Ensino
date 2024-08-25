<?php
require_once('valida_session.php');
require_once('header.php'); 
require_once('sidebar.php'); 
require_once("bd/bd_acoes.php");

$codigo = $_GET['cod'];
$dados = buscaAcaoProjeto($codigo);
$titulo = $dados["titulo"];
$descricao = $dados["descricao"];
$data = $dados["data"];
$imagem = $dados["imagem"];
?>

<!-- Main Content -->
<div id="content">

    <?php require_once('navbar.php');?>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <div class="card shadow mb-2">
            <div class="card-header py-3">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="m-0 font-weight-bold text-primary" id="title">ATUALIZAR AÇÃO DO PROJETO</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form class="user" action="editar_acoes_envia.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="cod" value="<?=$codigo?>">
                    
                    <div class="form-group row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control form-control-user" id="titulo" name="titulo" value="<?= $titulo ?>" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="data">Data</label>
                            <input type="date" class="form-control form-control-user" id="data" name="data" value="<?= $data ?>" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="descricao">Descrição</label>
                        <textarea class="form-control form-control-user" id="descricao" name="descricao" rows="4" required><?= $descricao ?></textarea>
                    </div>

                    <div class="form-group">
                        <label for="imagem">Imagem Atual</label><br>
                        <?php if ($imagem): ?>
                            <img src="uploads/<?= $imagem ?>" alt="Imagem da ação" class="img-fluid mb-2">
                        <?php else: ?>
                            <p>Nenhuma imagem carregada</p>
                        <?php endif; ?>
                        <label for="imagem">Alterar Imagem</label>
                        <input type="file" class="form-control-file" id="imagem" name="imagem" accept="image/*">
                    </div>

                    <div class="card-footer text-muted" id="btn-form">
                        <div class="text-right">
                            <a title="Voltar" href="acoes.php"><button type="button" class="btn btn-success"><i class="fas fa-arrow-circle-left"></i>&nbsp;Voltar</button></a>
                            <button type="submit" name="updatebtn" class="btn btn-primary"><i class="fas fa-edit">&nbsp;</i>Atualizar</button>
                        </div>
                    </div>
                </form>  
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
require_once('footer.php');
?>
