<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "produtos";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    // BUSCA O CLIENTE PELO ID
    require("../requests/produtos/get.php");
    $key = null; //limpar a variável $key para trazer todos os clientes
    if (isset($response["data"]) && !empty($response["data"])) {
        $product = $response["data"][0]; //se houver dados Pega o primeiro e único cliente na posição[0]
    } else {
        $product = null; // Se não encontrar, define como nulo
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
    <!-- <link href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css" rel="stylesheet"> -->
</head>

<body>
    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

<!-- Conteúdo principal -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md">
                <!-- Tabela de clientes cadastrados -->
                <h2>
                    Produtos Cadastrados
                    <a href="/produtos/formulario.php" class="btn btn-primary btn-sm">Novo Produto</a>
                    <a href="exportar.php" class="btn btn-success btn-sm float-left">Excel</a>
                    <a href="exportar_pdf.php" class="btn btn-danger btn-sm float-left">PDF</a>
                </h2>
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Imagem</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Marca</th>
                            <th scope="col">Quantidade</th>
                            <th scope="col">Preço</th>
                            <th scope="col"></th>


                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <!-- Os clientes serão carregados aqui via PHP -->
                        <?php
                        // SE HOUVER CLIENTES NA SESSÃO, EXIBIR                        
                        require("../requests/produtos/get.php");
                        if (!empty($response)) {
                            foreach ($response["data"] as $key => $product) {
                                echo '
                                <tr>
                                    <th scope="row">' . $product["id_produto"] . '</th>
                                    <td><img width="60" src="/produtos/imagens/' . $product["imagem"] . '"></td>
                                    <td>' . $product["produto"] . '</td>
                                    <td>' . $product["descricao"] . '</td>
                                    <td>' . $product["marca"] . '</td>
                                    <td>' . $product["quantidade"] . '</td>
                                    <td>' . $product["preco"] . '</td>
                                    <td>
                                        <a href="/produtos/formulario.php?key=' . $product["id_produto"] . '" class="btn btn-warning">Editar</a>
                                        <a href="/produtos/remover.php?key=' . $product["id_produto"] . '" class="btn btn-danger">Excluir</a>
                                    </td>
                                </tr>
                                ';
                            }
                        } else {
                            echo '
                            <tr>
                                <td colspan="7">Nenhum Produto cadastrado</td>
                            </tr>
                            ';
                        }
                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <!-- datatables -->
    <!-- <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable', {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.3.2/i18n/pt-BR.json',
            }
        });
    </script> -->
</body>

</html>