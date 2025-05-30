<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

try{
    if(!$_POST){
        throw new Exception("Acesso indevído! Tente novamente.");
    }

    if ($_POST["fornecedorId"] == "") {
        $postfields = array(
            "nome" => $_POST["fornecedorName"],
            "razao_social" => $_POST["fornecedorRazao"],
            "cnpj" => $_POST["fornecedorCNPJ"],
            "whatsapp" => $_POST["fornecedorWhatsapp"],
            "email" => $_POST["fornecedorEmail"],
            "endereco" => array (
            "logradouro" => $_POST["fornecedorAddress"],
            "numero" => $_POST["fornecedorNumber"],
            "complemento" => $_POST["fornecedorComplement"],
            "bairro" => $_POST["fornecedorNeighborhood"],
            "cidade" => $_POST["fornecedorCity"],
            "estado" => $_POST["fornecedorState"],
            "cep" => $_POST["fornecedorCEP"]
        ));
        require("../requests/fornecedores/post.php");
    } else {
        $postfields = array(
            "id_fornecedor" => $_POST["fornecedorId"],
            "nome" => $_POST["fornecedorName"],
            "razao_social" => $_POST["fornecedorRazao"],
            "cnpj" => $_POST["fornecedorCNPJ"],
            "whatsapp" => $_POST["fornecedorWhatsapp"],
            "email" => $_POST["fornecedorEmail"],
            "endereco" => array (
            "logradouro" => $_POST["fornecedorAddress"],
            "numero" => $_POST["fornecedorNumber"],
            "complemento" => $_POST["fornecedorComplement"],
            "bairro" => $_POST["fornecedorNeighborhood"],
            "cidade" => $_POST["fornecedorCity"],
            "estado" => $_POST["fornecedorState"],
            "cep" => $_POST["fornecedorCEP"]
        ));
        require("../requests/fornecedores/put.php");    
    }
    $_SESSION["msg"] = $response["message"]; 

}catch(Exception $e){
    $_SESSION["msg"] = $e->getMessage();
}finally{
    header("Location: ./");
}
