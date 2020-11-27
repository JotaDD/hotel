<?php

header("Access-Control-Allow-Origin: *"); // Quem usa a API
header("Content-Type: application/json; charset=UTF-8"); // Linguagem JSON
header("Access-Control-Allow-Methods: POST"); // Metodo Tipo POST
header("Access-Control-Max-Age: 3600"); // Quanto tempos os resultados ficam
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With"); // Todos os outros Headers 
 
// Conexao
include_once '../config/conexao.php';
 
// Instanciar CLiente
include_once '../objetos/cliente.php';
 
// Instanciar banco 
$conexao = new Conexao();
$db = $conexao->getConnection();
 
// Inicializar Objeto
$cliente = new Cliente($db);
 
// Obeter os dados  
$data = json_decode(file_get_contents("php://input"));
 
// Verificar se o dado não é vazio
if(
    !empty($data->cpf) &&
    !empty($data->nome) &&
    !empty($data->sexo) &&
    !empty($data->telefone)
){
 
    // Setar os dados do cliente
    $cliente->cpf = $data->cpf;
    $cliente->nome = $data->nome;
    $cliente->sexo = $data->sexo;
    $cliente->telefone = $data->telefone;
 
    // Criar o Cliente
    if($cliente->create()){
 
        // Setar Codigo  201 - Criado
        http_response_code(201);
 
        // Mostrar ao Usuário
        echo json_encode(array("Mensagem" => "Cliente Inserido com Sucesso!"));
    }
 
    // Se a criação do cliente não estiver disponivel
    else{
 
        // Setar Codigo 503 - Servico Indisponivel
        http_response_code(503);
 
        // Mostrar ao Usuário
        echo json_encode(array("Mensagem" => "Serviço Indisponivel."));
    }
}
 
// Mostrar que o dado está incompleto
else{
 
    // Setar Codigo 400 - Bad Request - Requisição má formada
    http_response_code(400);
 
    // tell the user
    echo json_encode(array("Mensagem" => "Impossível criar o cliente. Dados Incompletos."));
}
?>