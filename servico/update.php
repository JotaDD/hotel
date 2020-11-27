<?php
header("Access-Control-Allow-Origin: *");// Quem usa a API
header("Content-Type: application/json; charset=UTF-8");// Linguagem JSON
header("Access-Control-Allow-Methods: POST");// Metodo Tipo POST
header("Access-Control-Max-Age: 3600"); // Quanto tempos os resultados ficam
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");// Todos os outros Headers 


// Incluir banco de dados
include_once '../config/conexao.php';
include_once '../objetos/servico.php';


// Instanciar banco 
$conexao = new Conexao();
$db = $conexao->getConnection();
 
// Inicializar Objeto
$servico = new Servico($db);
 
//Pegar o CPF que será atualizado
$data = json_decode(file_get_contents("php://input"));
 
$servico->id = $data->id;
$servico->tipo = $data->tipo;
$servico->valor = $data->valor;
$servico->desc = $data->desc;
 
// Update
if($servico->update()){
 
    // Setar Codigo - 200 ok
    http_response_code(200);
 
    // Mostrar para o usuário
    echo json_encode(array("Mensagem" => "Serviço Atualizado."));
}
 
// Se não for possivel
else{
 
    // Setar Codigo- 503 Serviço Indisponivel
    http_response_code(503);
 
    // tell the user
    echo json_encode(array("Mensagem" => "Não foi possivel atualizar o Serviço."));
}
?>