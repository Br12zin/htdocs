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
                <!-- Formulário de cadastro de clientes -->
                <h2>
                    Cadastrar Produto
                </h2>
                <form id="clientForm" action="/produtos/cadastrar.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="productId" class="form-label">Código do produto</label>
                        <input type="text" class="form-control" id="productId" name="productId" readonly value="<?php echo isset($product) ? $product["id_produto"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="productName" class="form-label">Nome do produto</label>
                        <input onblur="teste()" type="text" class="form-control" id="productName" name="productName" required value="<?php echo isset($product) ? $product["produto"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="productImage" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="productImage" name="productImage" accept="image/*" value="<?php echo isset($product) ? $product["imagem"] : ""; ?>">
                    </div>
                    <?php
                    // SE HOUVER IMAGEM NO CLIENTE, EXIBIR MINIATURA
                    if (isset($product["imagem"])) {
                        echo '
                        <div class="mb-3">
                            <input type="hidden" name="currentProductImage" value="' . $product["imagem"] . '">
                            <img width="100" height="100" src="/produtos/imagens/' . $product["imagem"] . '">
                        </div>
                        ';
                    }
                    ?>
                    <div class="mb-3">
                        <label for="productDescription" class="form-label">Descrição</label>
                        <textarea class="form-control" id="productDescription" name="productDescription" placeholder="Descrição produto..." rows="3" required><?php echo isset($product) ? $product["descricao"] : ""; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="productBrand" class="form-label">Marca</label>
                        <select class="form-select" id="productBrand" name="productBrand" required>
                            <option value="" disabled selected>Selecione uma marca...</option>
                            <?php
                            require("../requests/marcas/get.php");
                            if (!empty($response)) {
                                foreach ($response["data"] as $marca) {
                                    $selected = (isset($product) && $product["id_marca"] == $marca["id_marca"]) ? "selected" : "";
                                    echo '<option '.$selected.' value="' . $marca["id_marca"] . '">' . $marca["marca"] . '</option>';
                                }
                            } else {
                                echo '<option value="" disabled>Nenhuma Marca cadastrada</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="productQuantity" class="form-label">Quantidade</label>
                        <input type="number" min="0" class="form-control" id="productQuantity" name="productQuantity" required value="<?php echo isset($product) ? $product["quantidade"] : ""; ?>">
                    </div>
                    <div class="mb-3">
                        <label for="productPrice" class="form-label">Preço</label>
                        <input type="text" class="form-control" id="productPrice" name="productPrice" required value="<?php echo isset($product) ? $product["preco"] : ''; ?>" placeholder="0,00">
                    </div>

                    <a href="/produtos" class="btn btn-danger btn-sm p-2">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

</body>

</html>