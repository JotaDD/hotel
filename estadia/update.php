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


// Instanciar banco 
$conexao = new Conexao();
$db = $conexao->getConnection();
 
// Inicializar Objeto
$cliente = new Cliente($db);
 
//Pegar o CPF que será atualizado
$data = json_decode(file_get_contents("php://input"));
 
$cliente->cpf = $data->cpf;
$cliente->nome = $data->nome;
$cliente->sexo = $data->sexo;
$cliente->telefone = $data->telefone;
 
// Update
if($cliente->update()){
 
    // Setar Codigo - 200 ok
    http_response_code(200);
 
    // Mostrar para o usuário
    echo json_encode(array("Mensagem" => "Cliente Atualizado."));
}
 
// Se não for possivel
else{
 
    // Setar Codigo- 503 Serviço Indisponivel
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("Mensagem" => "Não foi possivel atualizar o cliente."));
}
?>