<?php

header("Access-Control-Allow-Origin: *");// Quem usa a API
header("Access-Control-Allow-Headers: access"); //Permitir
header("Access-Control-Allow-Methods: GET");// Metodo Tipo GET
header("Access-Control-Allow-Credentials: true"); // Permitir Credencial
header('Content-Type: application/json');// Linguagem JSON
  
// Incluir banco de dados
include_once '../config/conexao.php';
include_once '../objetos/servico.php';
//error_reporting(0);

// Instanciar banco 
$conexao = new Conexao();
$db = $conexao->getConnection();
  
// Inicializar Objeto
$servico = new Servico($db);
  
// // Setar o dado a ser lido
$servico->id = isset($_GET['id']) ? $_GET['id'] : die();
  
// Ler um
$servico->readOne();
  
if($servico->id!=null){
    // Criar Array
    $servico_arr = array(
        "id" =>  $servico->id,
        "tipo" => $servico->tipo,
        "valor" => $servico->valor,
        "desc" => $servico->desc,
  
    );
  
    // Setar 200 - Ok
    http_response_code(200);
  
    // Mostrar o Serviço em Json
    echo json_encode($servico_arr);
}
  
else{
    // Setar para 404 -  Não Encontrado
    http_response_code(404);
 
    // Mostrar caso o Serviço não foi encontrado
    echo json_encode(
        array("Mensagem" => "Serviço nao Encontrado.")
    );
}
?>