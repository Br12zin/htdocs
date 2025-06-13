<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// CARREGAR BIBLIOTECA MPDF
require_once '../mpdf/vendor/autoload.php';

$lista = "";
require("../requests/produtos/get.php");
if(!empty($response)) {
    foreach($response["data"] as $key => $product) {
        // .= ADICIONA ITENS NA VARIÁVEL $lista
        $lista .= '
        <tr>
            <th style="border:1px solid black" scope="row">'.$product["id_produto"].'</th>
            <td style="border:1px solid black"><img src="imagens/'.$product["imagem"].'" width="100"></td>
            <td style="border:1px solid black">'.$product["produto"].'</td>
            <td style="border:1px solid black">'.$product["descricao"].'</td>
            <td style="border:1px solid black">'.$product["id_marca"].'</td>
            <td style="border:1px solid black">'.$product["quantidade"].'</td>
            <td style="border:1px solid black">'.$product["preco"].'</td>
        </tr>
        ';
    }
} else {
    echo '
    <tr>
        <td colspan="4">Nenhum produto cadastrado</td>
    </tr>
    ';
}

$html = '
<html>
<head>
    <meta charset="utf-8">
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border: 1px solid black;
    }
    </style>
</head>
<body>
    <h1 style="text-align:center">Lista de produtos</h1>
    <p style="text-align:center">Data: '.date('d/m/Y').'</p>
    <p style="text-align:center">Total de produtos: '.count($response["data"]).'</p>
    <table>
        <thead>
            <tr>
                <th style="background:gray;font-weight:bold" scope="col">id</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:300px" scope="col">Imagem</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:300px" scope="col">Produto</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:100px" scope="col">Descrição</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:250px" scope="col">Código da Marca</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:120px" scope="col">Quantidade</th>
                <th style="background:gray;font-weight:bold;border:1px solid black;width:120px" scope="col">Preco</th>
            </tr>
        </thead>
        <tbody id="productTableBody">
            '.$lista.'
        </tbody>
    </table>
</body>
</html>
';

// Cria uma instância do MPDF
$mpdf = new \Mpdf\Mpdf();

// Escreve o conteúdo HTML no PDF
$mpdf->WriteHTML($html);

// Define o nome do arquivo PDF para download
$nomeArquivo = 'produtos_'.date('YmdHis').'.pdf';
// Define as dimensões do PDF
$mpdf->SetDisplayMode('fullpage');
$mpdf->SetMargins(10, 10, 10);
$mpdf->SetDefaultBodyCSS('background', '#FFF');
// Gera o PDF e força o download
$mpdf->Output($nomeArquivo, \Mpdf\Output\Destination::DOWNLOAD);