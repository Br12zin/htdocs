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
            <th style="background:gray;font-weight:bold;border:1px solid black" scope="col">#</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:300px" scope="col">Produto</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:100px" scope="col">Descrição</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:250px" scope="col">Código da Marca</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:120px" scope="col">Quantidade</th>
            <th style="background:gray;font-weight:bold;border:1px solid black;width:120px" scope="col">Preco</th>
        </tr>
    </thead>
    <tbody id="clientTableBody">
        <!-- Os clientes serão carregados aqui via PHP -->
        <?php
        // SE HOUVER CLIENTES NA SESSÃO, EXIBIR
        require("../requests/produtos/get.php");
        if(!empty($response)) {
            foreach($response["data"] as $key => $product) {
                echo '
                <tr>
                    <th style="border:1px solid black" scope="row">'.$product["id_produto"].'</th>
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
                <td colspan="4">Nenhum Produto cadastrado</td>
            </tr>
            ';
        }
        ?>
    </tbody>
</table>