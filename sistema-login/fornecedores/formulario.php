<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "fornecedores";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    // BUSCA O fornecedorE PELO ID
    require("../requests/fornecedores/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
        $fornecedor = $response["data"][0]; //se houver dados Pega o primeiro e único fornecedore na posição[0]
    } else {
        $fornecedor = null; // Se não encontrar, define como nulo
    }
}

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Cadastro de fornecedores</title>
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
            <div class="col-md-">
                <div class="card">
                    <div class="card-header">
                        <h2>
                            Cadastrar Fornecedor
                        </h2>
                    </div>
                    <div class="card-body">
                        <!-- Formulário de cadastro de fornecedores -->
                        <div class="row">
                            <div class="col-md-3">
                                <form id="fornecedorForm" action="/fornecedores/cadastrar.php" method="POST"
                                    enctype="multipart/form-data">
                                    <label for="fornecedorId" class="form-label">Código do fornecedor</label>
                                    <input type="text" class="form-control" id="fornecedorId" name="fornecedorId"
                                        readonly
                                        value="<?php echo isset($fornecedor) ? $fornecedor['id_fornecedor'] : ""; ?>">
                            </div>
                            <div class="col-md-9">
                                <label for="fornecedorName" class="form-label">Nome do fornecedor</label>
                                <input onblur="teste()" type="text" class="form-control" id="fornecedorName"
                                    name="fornecedorName" required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["nome"] : ""; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="fornecedorRazao" class="form-label">Razão Social</label>
                                <input type="text" class="form-control" id="fornecedorRazao" name="fornecedorRazao"
                                    required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["razao_social"] : ""; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="fornecedorEmail" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="fornecedorEmail" name="fornecedorEmail"
                                    required value="<?php echo isset($fornecedor) ? $fornecedor["email"] : ""; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label for="fornecedorCNPJ" class="form-label">CNPJ</label>
                                <input data-mask="00.000.000/0000-00" type="text" class="form-control"
                                    id="fornecedorCNPJ" name="fornecedorCNPJ" required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["cnpj"] : ""; ?>">
                            </div>
                            <div class="col-md-6">
                                <label for="fornecedorWhatsapp" class="form-label">Whatsapp</label>
                                <input data-mask="(00) 0 0000-0000" type="text" class="form-control"
                                    id="fornecedorWhatsapp" name="fornecedorWhatsapp" required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["whatsapp"] : ""; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="fornecedorCEP" class="form-label">CEP</label>
                                <input data-mask="00000-000" type="text" class="form-control" id="fornecedorCEP"
                                    name="fornecedorCEP" required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["cep"] : ""; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="fornecedorAddress" class="form-label">Logradouro</label>
                                <input type="text" class="form-control" id="fornecedorAddress" name="fornecedorAddress"
                                    required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["logradouro"] : ""; ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="fornecedorNumber" class="form-label">Número</label>
                                <input type="text" class="form-control" id="fornecedorNumber" name="fornecedorNumber"
                                    required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["numero"] : ""; ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label for="fornecedorComplement" class="form-label">Complemento</label>
                                <input type="text" class="form-control" id="fornecedorComplement"
                                    name="fornecedorComplement"
                                    value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["complemento"] : ""; ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="fornecedorNeighborhood" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="fornecedorNeighborhood"
                                    name="fornecedorNeighborhood" required
                                    value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["bairro"] : ""; ?>">
                            </div>
                            <div class="col-md-3">
                                <label for="fornecedorCity" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="fornecedorCity" name="fornecedorCity"
                                    readonly
                                    value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["cidade"] : ""; ?>">
                            </div>
                            <div class="col-md-1">
                                <label for="fornecedorState" class="form-label">Estado (UF)</label>
                                <input type="text" class="form-control" id="fornecedorState" name="fornecedorState"
                                    readonly
                                    value="<?php echo isset($fornecedor) ? $fornecedor["endereco"]["estado"] : ""; ?>">
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="card-footer">
                        <a href="/fornecedores" class="btn btn-danger btn-sm p-2">Cancelar</a>
                        <button type="submit" class="btn btn-primary" form="fornecedorForm">Salvar</button>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
    $('#fornecedorCEP').on('blur', function() {
        var cep = $(this).val().replace(/\D/g, '');
        // Verifica se o CEP tem 8 dígitos
        if (cep.length === 8) {
            // Faz a requisição para a API ViaCEP
            $.getJSON('https://viacep.com.br/ws/' + cep + '/json/?callback=?', function(data) {
                if (!data.erro) {
                    $('#fornecedorAddress').val(data.logradouro);
                    $('#fornecedorNeighborhood').val(data.bairro);
                    $('#fornecedorCity').val(data.localidade);
                    $('#fornecedorState').val(data.uf);
                } else {
                    alert('CEP não encontrado.');
                    $("#fornecedorCEP").val("");
                    $("#fornecedorAddress").val("");
                    $("#fornecedorNeighborhood").val("");
                    $("#fornecedorCity").val("");
                    $("#fornecedorState").val("");
                }
            });
        } else {
            alert('Formato de CEP inválido.');
            // Limpa os campos de endereço
            $("#fornecedorCEP").val("");
            $("#fornecedorAddress").val("");
            $("#fornecedorNeighborhood").val("");
            $("#fornecedorCity").val("");
            $("#fornecedorState").val("");
        }
    });
    </script>

</body>

</html>