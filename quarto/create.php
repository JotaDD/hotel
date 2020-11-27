<?php
header("Access-Control-Allow-Origin: *");// Quem usa a API
header("Content-Type: application/json; charset=UTF-8");// Linguagem JSON
header("Access-Control-Allow-Methods: POST");// Metodo Tipo POST
header("Access-Control-Max-Age: 3600"); // Quanto tempos os resultados ficam
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");// Todos os outros Headers 

 
// Conexao
include_once '../config/conexao.php';
 
// Instanciar CLiente
include_once '../objetos/quarto.php';
 
// Instanciar banco 
$conexao = new Conexao();
$db = $conexao->getConnection();
 
// Inicializar Objeto
$quarto = new Quarto($db);
 
// Obeter os dados  
$data = json_decode(file_get_contents("php://input"));
 
// Verificar se o dado não é vazio
if(
    !empty($data->numero) &&
    !empty($data->andar) &&
    !empty($data->descquarto) &&
    !empty($data->ocupado)
){
 
    // Setar os dados do quarto
    $quarto->numero = $data->numero;
    $quarto->andar = $data->andar;
    $quarto->descquarto = $data->descquarto;
    $quarto->ocupado = $data->ocupado;
 
    // Criar o Quarto
    if($quarto->create()){
 
        // Setar Codigo  201 - Criado
        http_response_code(201);
 
        // Mostrar ao Usuário
        echo json_encode(array("Mensagem" => "Quarto Inserido com Sucesso!"));
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
    echo json_encode(array("Mensagem" => "Impossível criar um Quarto. Dados Incompletos."));
}
?>