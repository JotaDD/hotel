<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
 
// Incluir banco de dados
include_once '../config/conexao.php';
include_once '../objetos/cliente.php';
error_reporting(0);

// Instanciar banco 
$conexao = new Conexao();
$db = $conexao->getConnection();
 
// Inicializar Objeto
$cliente = new Cliente($db);
 
// Obter os dados
$data = json_decode(file_get_contents("php://input"));
 
// Setar o dado a ser deletado
$cliente->cpf = $data->cpf;
 
// Deletar produto
if($cliente->delete()){
 
    // Setar 200 - Ok
    http_response_code(200);
 
    // Mostrar o cliente em Json
    echo json_encode(array("Mensagem" => "Cliente deletado."));
}
 
// Se não conseguir deletar
else{
 
    // Setar Codigo 503 - Servico Indisponivel
    http_response_code(503);
 
    // Mostrar o cliente em Json
    echo json_encode(array("Mensagem" => "Nao foi possivel deletar o Cliente."));
}
?>