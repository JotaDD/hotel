<?php

header("Access-Control-Allow-Origin: *");// Quem usa a API
header("Content-Type: application/json; charset=UTF-8");// Linguagem JSON
header("Access-Control-Allow-Methods: POST");// Metodo Tipo POST
header("Access-Control-Max-Age: 3600"); // Quanto tempos os resultados ficam
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");// Todos os outros Headers 

// Incluir banco de dados
include_once '../config/conexao.php';
include_once '../objetos/quarto.php';
error_reporting(0);

// Instanciar banco 
$conexao = new Conexao();
$db = $conexao->getConnection();
 
// Inicializar Objeto
$quarto = new Quarto($db);
 
// Obter os dados
$data = json_decode(file_get_contents("php://input"));
 
// Setar o dado a ser deletado
$quarto->numero = $data->numero;
 
// Deletar produto
if($quarto->delete()){
 
    // Setar 200 - Ok
    http_response_code(200);
 
    // Mostrar o quarto em Json
    echo json_encode(array("Mensagem" => "Quarto deletado."));
}
 
// Se não conseguir deletar
else{
 
    // Setar Codigo 503 - Servico Indisponivel
    http_response_code(503);
 
    // Mostrar o quarto em Json
    echo json_encode(array("Mensagem" => "Nao foi possivel deletar o quarto."));
}
?>