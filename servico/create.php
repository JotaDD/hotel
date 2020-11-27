<?php
header("Access-Control-Allow-Origin: *");// Quem usa a API
header("Content-Type: application/json; charset=UTF-8");// Linguagem JSON
header("Access-Control-Allow-Methods: POST");// Metodo Tipo POST
header("Access-Control-Max-Age: 3600"); // Quanto tempos os resultados ficam
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");// Todos os outros Headers 

 
// Conexao
include_once '../config/conexao.php';
 
// Instanciar Serviço
include_once '../objetos/servico.php';
 
// Instanciar banco 
$conexao = new Conexao();
$db = $conexao->getConnection();
 
// Inicializar Objeto
$servico = new Servico($db);
 
// Obeter os dados  
$data = json_decode(file_get_contents("php://input"));
 
// Verificar se o dado não é vazio
if(
    !empty($data->tipo) &&
    !empty($data->valor) &&
    !empty($data->desc)
){
 
    // Setar os dados do cliente
    $servico->tipo = $data->tipo;
    $servico->valor = $data->valor;
    $servico->desc = $data->desc;
 
    // Criar o Cliente
    if($servico->create()){
 
        // Setar Codigo  201 - Criado
        http_response_code(201);
 
        // Mostrar ao Usuário
        echo json_encode(array("Mensagem" => "Serviço Inserido com Sucesso!"));
    }
 
    // Se a criação do servico não estiver disponivel
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
    echo json_encode(array("Mensagem" => "Impossível criar um Serviço. Dados Incompletos."));
}
?>