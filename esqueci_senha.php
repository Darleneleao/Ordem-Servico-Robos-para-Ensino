<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .reset-password-container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
        }
        .form-group label {
            font-weight: bold;
        }
        .btn-custom {
            width: 120px;
        }
        
    </style>
</head>
<body class="bg-light">

    <div class="container reset-password-container mt-5">
        <div class="card shadow-lg">
            <div class="card-header text-primary font-weight-bold">RECUPERAR SENHA</div>
            <div class="card-body">
                <form action="processa_recuperacao.php" method="post">
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Endereço de Email..." required>
                    </div>
                    <div class="form-group">
                        <label for="new_password">Nova Senha:</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Nova Senha" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <button type="button" class="btn btn-success btn-custom" onclick="history.back()">Voltar</button>
                        </div>
                        <div class="form-group col-md-6 text-right">
                            <button type="submit" class="btn btn-primary btn-custom">Trocar Senha</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
