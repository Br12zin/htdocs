<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Estilo personalizado da navbar */
        .custom-navbar {
            background-color: #1a1a2e;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            padding: 0;
            min-height: 70px;
        }

        .custom-container {
            padding: 0 40px;
        }

        .custom-brand {
            font-weight: 700;
            font-size: 1.8rem;
            color: #fff !important;
            letter-spacing: 1px;
            padding: 10px 0;
            margin-right: 40px;
            position: relative;
        }

        .custom-brand::after {
            content: '';
            position: absolute;
            right: -20px;
            top: 50%;
            transform: translateY(-50%);
            height: 30px;
            width: 2px;
            background-color: rgba(255, 255, 255, 0.2);
        }

        .custom-nav {
            gap: 10px;
        }

        .custom-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            font-size: 1.1rem;
            padding: 10px 20px !important;
            border-radius: 6px;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            position: relative;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .custom-link:hover {
            color: #fff !important;
            background-color: rgba(255, 255, 255, 0.15);
            transform: translateY(-2px);
        }

        .custom-link.active {
            color: #fff !important;
            background-color: rgba(255, 255, 255, 0.25);
            font-weight: 600;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .custom-exit {
            background-color: rgba(104, 55, 49, 0);
            margin-left: 20px;
        }

        .custom-exit:hover {
            background-color: rgba(231, 76, 60, 0.4);
        }

        .custom-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 3px;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            background-color: #fff;
            transition: width 0.3s ease, left 0.3s ease;
        }

        .custom-link:hover::after,
        .custom-link.active::after {
            width: 70%;
            left: 50%;
            transform: translateX(-50%);
        }

        .custom-toggler {
            border: none;
            padding: 0.5rem;
        }

        .custom-toggler:focus {
            box-shadow: none;
        }
    </style>
</head>
<body>
    <!-- Barra de navegação -->
    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid custom-container">
            <a class="navbar-brand custom-brand" href="<?php echo $_SESSION['url'];?>/">Dashboard</a>
            <button class="navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav custom-nav">
                    <li class="nav-item">
                        <a class="nav-link custom-link <?php echo $pagina == 'clientes' ? 'active' : ''; ?>"
                            href="<?php echo $_SESSION['url'];?>/clientes">Clientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-link <?php echo $pagina == 'fornecedores' ? 'active' : ''; ?>"
                            href="<?php echo $_SESSION['url'];?>/fornecedores">Fornecedores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-link <?php echo $pagina == 'produtos' ? 'active' : ''; ?>"
                            href="<?php echo $_SESSION['url'];?>/produtos">Produtos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link custom-link custom-exit" href="<?php echo $_SESSION['url'];?>/encerrar-sessao.php">Sair</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>