<?php

header("Access-Control-Allow-Origin: *");// Quem usa a API
header("Content-Type: application/json; charset=UTF-8");// Linguagem JSON
header("Access-Control-Allow-Methods: POST");// Metodo Tipo POST
header("Access-Control-Max-Age: 3600"); // Quanto tempos os resultados ficam
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");// Todos os outros Headers 

// Incluir banco de dados
include_once '../config/conexao.php';
include_once '../objetos/servico.php';
error_reporting(0);

// Instanciar banco 
$conexao = new Conexao();
$db = $conexao->getConnection();
 
// Inicializar Objeto
$servico = new Servico($db);
 
// Obter os dados
$data = json_decode(file_get_contents("php://input"));
 
// Setar o dado a ser deletado
$servico->id = $data->id;
 
// Deletar produto
if($servico->delete()){
 
    // Setar 200 - Ok
    http_response_code(200);
 
    // Mostrar o servico em Json
    echo json_encode(array("Mensagem" => "Serviço deletado."));
}
 
// Se não conseguir deletar
else{
 
    // Setar Codigo 503 - Serviço Indisponivel
    http_response_code(503);
 
    // Mostrar o Serviço em Json
    echo json_encode(array("Mensagem" => "Nao foi possivel deletar o Serviço."));
}
?>