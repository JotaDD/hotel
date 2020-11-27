<?php

header("Access-Control-Allow-Origin: *");// Quem usa a API
header("Access-Control-Allow-Headers: access"); //Permitir
header("Access-Control-Allow-Methods: GET");// Metodo Tipo GET
header("Access-Control-Allow-Credentials: true"); // Permitir Credencial
header('Content-Type: application/json');// Linguagem JSON
  
// Incluir banco de dados
include_once '../config/conexao.php';
include_once '../objetos/quarto.php';
//error_reporting(0);

// Instanciar banco 
$conexao = new Conexao();
$db = $conexao->getConnection();
  
// Inicializar Objeto
$quarto = new Quarto($db);
  
// // Setar o dado a ser lido
$quarto->numero = isset($_GET['numero']) ? $_GET['numero'] : die();
  
// Ler um
$quarto->readOne();
  
if($quarto->numero!=null){
    // Criar Array
    $quarto_arr = array(
        "numero" =>  $quarto->numero,
        "andar" => $quarto->andar,
        "descquarto" => $quarto->descquarto,
        "ocupado" => $quarto->ocupado,
  
    );
  
    // Setar 200 - Ok
    http_response_code(200);
  
    // Mostrar o quarto em Json
    echo json_encode($quarto_arr);
}
  
else{
    // Setar para 404 -  Não Encontrado
    http_response_code(404);
 
    // Mostrar caso o quarto não foi encontrado
    echo json_encode(
        array("Mensagem" => "Quarto nao Encontrado.")
    );
}
?>