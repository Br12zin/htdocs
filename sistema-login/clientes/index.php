<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "clientes";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    // BUSCA O CLIENTE PELO ID
    require("../requests/clientes/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
        $client = $response["data"][0]; //se houver dados Pega o primeiro e único cliente na posição[0]
    } else {
        $client = null; // Se não encontrar, define como nulo
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de Clientes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css" rel="stylesheet">
</head>

<body>
    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <!-- Conteúdo principal -->
    <div class="container-fluid mt-5 vh-full">
        <div class="row">
            <div class="col-md">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h2>
                            Clientes Cadastrados

                        </h2>
                        <div>
                            <a href="/clientes/formulario.php" class="btn btn-primary btn-sm">Novo Cliente</a>
                            <a href="/clientes/exportar.php" class="btn btn-success btn-sm float-left">Excel</a>
                            <a href="/clientes/exportar_pdf.php" class="btn btn-danger btn-sm float-left">PDF</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Tabela de clientes cadastrados -->

                        <table id="myTable" class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Imagem</th>
                                    <th scope="col">Nome</th>
                                    <th scope="col">CPF</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Whatsapp</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody id="clientTableBody">
                                <!-- Os clientes serão carregados aqui via PHP -->
                                <?php
                        // SE HOUVER CLIENTES NA SESSÃO, EXIBIR                        
                        $key = null; //limpar a variável $key para trazer todos os clientes
                        require("../requests/clientes/get.php");
                        if (!empty($response)) {
                            foreach ($response["data"] as $key => $client) {
                                echo '
                                <tr>
                                    <th scope="row">' . $client["id_cliente"] . '</th>
                                    <td><img width="60" src="/clientes/imagens/' . $client["imagem"] . '"></td>
                                    <td>' . $client["nome"] . '</td>
                                    <td>' . $client["cpf"] . '</td>
                                    <td>' . $client["email"] . '</td>
                                    <td>' . $client["whatsapp"] . '</td>
                                    <td>
                                        <a href="/clientes/formulario.php?key=' . $client["id_cliente"] . '" class="btn btn-warning">Editar</a>
                                        <a href="/clientes/remover.php?key=' . $client["id_cliente"] . '" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '
                            <tr>
                                <td colspan="7">Nenhum cliente cadastrado</td>
                            </tr>
                            ';
                        }
                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- datatables -->
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
    let table = new DataTable('#myTable', {
        language: {
            url: 'https://cdn.datatables.net/plug-ins/2.3.2/i18n/pt-BR.json',
        }
    });
    </script>



</body>

</html>