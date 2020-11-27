<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
  
// Incluir banco de dados
include_once '../config/conexao.php';
include_once '../objetos/cliente.php';
//error_reporting(0);

// Instanciar banco 
$conexao = new Conexao();
$db = $conexao->getConnection();
  
// Inicializar Objeto
$cliente = new Cliente($db);
  
// // Setar o dado a ser lido
$cliente->cpf = isset($_GET['cpf']) ? $_GET['cpf'] : die();
  
// Ler um
$cliente->readOne();
  
if($cliente->nome!=null){
    // Criar Array
    $cliente_arr = array(
        "cpf" =>  $cliente->cpf,
        "nome" => $cliente->nome,
        "sexo" => $cliente->sexo,
        "telefone" => $cliente->telefone,
  
    );
  
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
?>