<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// DEFINE TIMEZONE PARA BRASIL
date_default_timezone_set('America/Sao_Paulo');
$filename = "clientes_".date('YmdHis').".xls";

// CABEÇALHO PARA EXPORTAR O ARQUIVO EM EXCEL
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$filename");
header("Pragma: no-cache");

?>
<head>
    <meta charset="utf-8">
</head>
<table>
    <thead>
        <tr>
            <th style="background:gray;font-weight:bold;border:1px solid black" scope="col">Id</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:300px" scope="col">Nome</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:100px" scope="col">Razao Social</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:250px" scope="col">CNPJ</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:120px" scope="col">Whatsapp</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:120px" scope="col">Email</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:120px" scope="col">Endereço</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:120px" scope="col">Número</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:120px" scope="col">Complemento</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:120px" scope="col">Bairro</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:120px" scope="col">Cidade</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:120px" scope="col">Estado(UF)</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:120px" scope="col">CEP</th>
        </tr>
    </thead>
    <tbody id="clientTableBody">
        <!-- Os clientes serão carregados aqui via PHP -->
        <?php
        // SE HOUVER CLIENTES NA SESSÃO, EXIBIR
        require("../requests/fornecedores/get.php");
        if(!empty($response)) {
            foreach($response["data"] as $key => $fornecedor) {
                echo '
                <tr>
                    <th style="border:1px solid black" scope="row">'.$fornecedor["id_fornecedor"].'</th>
                    <td style="border:1px solid black">'.$fornecedor["nome"].'</td>
                    <td style="border:1px solid black">'.$fornecedor["razao_social"].'</td>
                    <td style="border:1px solid black">'.$fornecedor["cnpj"].'</td>
                    <td style="border:1px solid black">'.$fornecedor["whatsapp"].'</td>
                    <td style="border:1px solid black">'.$fornecedor["email"].'</td>
                    <td style="border:1px solid black">'.$fornecedor["endereco"]["logradouro"].'</td>
                    <td style="border:1px solid black">'.$fornecedor["endereco"]["numero"].'</td>
                    <td style="border:1px solid black">'.$fornecedor["endereco"]["complemento"].'</td>
                    <td style="border:1px solid black">'.$fornecedor["endereco"]["bairro"].'</td>
                    <td style="border:1px solid black">'.$fornecedor["endereco"]["cidade"].'</td>
                    <td style="border:1px solid black">'.$fornecedor["endereco"]["estado"].'</td>
                    <td style="border:1px solid black">'.$fornecedor["endereco"]["cep"].'</td>
                </tr>
                ';
            }
        } else {
            echo '
            <tr>
                <td colspan="4">Nenhum cliente cadastrado</td>
            </tr>
            ';
        }
        ?>
    </tbody>
</table>