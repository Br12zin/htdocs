<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "home";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistema de Gestão</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --danger-color: #e74a3b;
            --dark-color: #5a5c69;
        }
        
        body {
            background-color: #f8f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .dashboard-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 1.5rem 0 rgba(58, 59, 69, 0.2);
        }
        
        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }
        
        .card-title {
            font-weight: 600;
            color: var(--dark-color);
        }
        
        .card-count {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
        }
        
        .btn-access {
            background-color: var(--primary-color);
            border: none;
            border-radius: 5px;
            padding: 8px 20px;
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-access:hover {
            background-color: #2e59d9;
            transform: translateY(-2px);
        }
        
        .page-header {
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #e3e6f0;
        }
        .acess_color{
        background: #1a1a2e !important; /* Adicionei !important para forçar a cor */
    }
    
    .acess_color .btn-access {
        background-color: white !important;
        color: #1a1a2e !important;
    }
    
    
    </style>
</head>

<body>
    <?php
    include "mensagens.php";
    include "navbar.php";
    ?>

    <!-- Conteúdo principal -->
    <div class="container py-5">
        
        <div class="row g-4">
            <!-- Card Clientes -->
            <div class="col-lg-4 col-md-6">
                <div class="dashboard-card card h-100">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-people-fill card-icon"></i>
                        <h5 class="card-title">Clientes</h5>
                        <div class="card-count mb-3">
                            <?php require("./requests/clientes/get.php"); ?>
                            <?php echo isset($response["data"]) ? count($response["data"]) : 0; ?>
                        </div>
                        <p class="text-muted">Cadastros ativos</p>
                    </div>
                    <div class="card-footer acess_color text-center py-3">
                        <a href="<?php echo $_SESSION["url"]; ?>/clientes" class="btn btn-bg-#1a1a2e text-white">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card Fornecedores -->
            <div class="col-lg-4 col-md-6">
                <div class="dashboard-card card h-100">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-truck card-icon"></i>
                        <h5 class="card-title">Fornecedores</h5>
                        <div class="card-count mb-3">
                            <?php require("./requests/fornecedores/get.php") ?>
                            <?php echo isset($response["data"]) ? count($response["data"]) : 0; ?>
                        </div>
                        <p class="text-muted">Parceiros comerciais</p>
                    </div>
                    <div class="card-footer acess_color text-center py-3">
                        <a href="<?php echo $_SESSION["url"]; ?>/fornecedores" class="btn btn-bg-#1a1a2e  text-white">Acessar</a>
                    </div>
                </div>
            </div>

            <!-- Card Produtos -->
            <div class="col-lg-4 col-md-6">
                <div class="dashboard-card card h-100">
                    <div class="card-body text-center p-4">
                        <i class="bi bi-box-seam-fill card-icon"></i>
                        <h5 class="card-title">Produtos</h5>
                        <div class="card-count mb-3">
                            <?php require("./requests/produtos/get.php")?>
                            <?php echo isset($response["data"]) ? count($response["data"]) : 0; ?>
                        </div>
                        <p class="text-muted">Itens cadastrados</p>
                    </div>
                    <div class="card-footer acess_color text-center py-3">
                        <a href="<?php echo $_SESSION["url"]; ?>/produtos" class="btn btn-bg-#1a1a2e  text-white">Acessar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>