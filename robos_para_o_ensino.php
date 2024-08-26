<?php
// Conecta ao banco de dados e busca as ações
require_once("bd/bd_acoes.php");

$acoes = listaAcoes();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Robôs para o Ensino</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .hero {
            background: url('banner.jpg') no-repeat center center;
            background-size: cover;
            color: white;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .gallery img {
            width: 100%;
            height: auto;
            padding: 10px;
            border-radius: 8px;
        }

        .partners img {
            max-width: 150px;
            margin: 20px;
        }

        footer {
            background: #333;
            color: #fff;
            padding: 40px 0;
        }

        footer .social {
            margin-bottom: 20px;
        }

        footer .social a {
            color: #fff;
            margin: 0 10px;
            font-size: 24px;
            text-decoration: none;
        }

        footer .social a:hover {
            color: #ddd;
        }

        .navbar-brand img {
            max-width: 50px;
            margin-right: 10px;
        }
    </style>
</head>

<body>

    <!-- Cabeçalho e Menu de Navegação -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="./img/logo_libertaMinas.png" alt="Logo" class="rounded-circle" style="max-width: 50px;">
            Robôs para o Ensino
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#apresentacao">Apresentação</a></li>
                <li class="nav-item"><a class="nav-link" href="#acoes">Ações</a></li>
                <li class="nav-item"><a class="nav-link" href="#contato">Contato</a></li>
                <li class="nav-item">
                    <a class="btn btn-primary" href="index.php">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>


    <!-- Seção Apresentação -->
<section id="apresentacao" class="py-5 mt-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <!-- Coluna de Imagem -->
            <div class="col-lg-6 text-center">
                <img src="img/logo_libertaMinas_semfundo.png" alt="Robótica e Educação" class="img-fluid">
            </div>
            <!-- Coluna de Texto -->
            <div class="col-lg-6">
                <h1 class="display-4 text-primary">Projeto Robôs para o Ensino</h1>
                <p class="lead text-secondary">Através da emenda parlamentar Liberta Minas aprovada no início de 2022, o projeto Autobots de robótica e automação ganhou força e obteve diversas aquisições que complementaram o projeto e sobretudo o aprendizado de seus participantes sejam eles internos ou externos à instituição.</p>

                <h4 class="mt-4">O que Oferecemos:</h4>
                <ul class="list-unstyled">
                    <li class="mb-3"><i class="bi bi-lightbulb text-primary me-2"></i> <strong>Educação Interativa</strong>: Desenvolvemos currículos que incentivam o pensamento crítico e a criatividade através da robótica.</li>
                    <li class="mb-3"><i class="bi bi-gear text-primary me-2"></i> <strong>Laboratórios Modernos</strong>: Equipamos escolas com laboratórios de última geração para experimentação prática.</li>
                    <li class="mb-3"><i class="bi bi-people text-primary me-2"></i> <strong>Workshops e Treinamentos</strong>: Oferecemos capacitação contínua para professores e alunos, alinhando práticas educativas às demandas do futuro.</li>
                </ul>
                <a href="#acoes" class="btn btn-primary btn-lg mt-3">Descubra Nossas Ações</a>
            </div>
        </div>
    </div>
</section>

<!-- Inclua os ícones do Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Seção Ações do Projeto -->
    <div id="acoes" class="container mt-5">
        <h1 class="mb-4">Ações do Projeto</h1>
        <div class="row">
            <?php if (empty($acoes)): ?>
                <p class="col-12">Nenhuma ação disponível no momento.</p>
            <?php else: ?>
                <?php foreach ($acoes as $acao): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <?php if ($acao['imagem']): ?>
                                <img src="uploads/<?= $acao['imagem'] ?>" class="card-img-top" alt="<?= $acao['titulo'] ?>">
                            <?php endif; ?>
                            <div class="card-body">
                                <h5 class="card-title"><?= $acao['titulo'] ?></h5>
                                <p class="card-text"><?= $acao['descricao'] ?></p>
                                <p class="card-text"><small class="text-muted">Data: <?= date("d/m/Y", strtotime($acao['data'])) ?></small></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Seção Rodapé -->
<footer id="contato" class="bg-dark text-white py-3">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <h5>autobotsifmachado</h5>
                <div class="social mt-2">
                    <a href="https://www.instagram.com/autobotsifmachado/" target="_blank" class="text-white me-3">
                        <i class="fab fa-instagram fa-lg"></i>
                    </a>
                </div>
                <p class="mt-3 mb-0">Endereço: Rod. Machado - Paraguaçu, s/n - Santo Antonio, Machado - MG, 37750-000</p>
            </div>
        </div>
        <p class="text-center mt-3 mb-0">&copy; 2024 Robôs para o Ensino. Todos os direitos reservados. <a href="#top" class="text-white">Voltar ao topo</a></p>
    </div>
</footer>

<!-- Inclua os ícones do Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/js/all.min.js"></script>
</body>

</html>