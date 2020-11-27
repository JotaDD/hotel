<?php

header("Access-Control-Allow-Origin: *");// Quem usa a API
header("Content-Type: application/json; charset=UTF-8");// Linguagem JSON
 
// Incluir banco de dados
include_once '../config/conexao.php';
include_once '../objetos/cliente.php';
 
// Instanciar banco 
$conexao = new Conexao();
$db = $conexao->getConnection();
 
// Inicializar Objeto
$cliente = new Cliente($db);
 
// Consultar Cliente
$var = $cliente->read();
$num = $var->rowCount();
 
// Checar se existe mais de 0 registros
if($num>0){
 
    // Array cliente
    $cliente_arr=array();
    $cliente_arr["Registros"]=array();
 
   
    while ($linha = $var->fetch(PDO::FETCH_ASSOC)){

        extract($linha);
 
        $cliente_item=array(
            "CPF" => $cpf,
            "Nome" => $nome,
            "Sexo" => $sexo,
            "Telefone" => $telefone,
        );
 
        array_push($cliente_arr["Registros"], $cliente_item);
    }
 
    // Setar 200 - Ok
    http_response_code(200);
 
    // Mostrar o cliente em Json
    echo json_encode($cliente_arr);
}
 
else{
 
    // Setar para 404 -  Não Encontrado
    http_response_code(404);
 
    // Mostrar caso o cliente não foi encontrado
    echo json_encode(
        array("Mensagem" => "Cliente nao Encontrado.")
    );
}