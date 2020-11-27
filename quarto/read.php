<?php
header("Access-Control-Allow-Origin: *");// Quem usa a API
header("Content-Type: application/json; charset=UTF-8");// Linguagem JSON
 
// Incluir banco de dados
include_once '../config/conexao.php';
include_once '../objetos/quarto.php';
 
// Instanciar banco 
$conexao = new Conexao();
$db = $conexao->getConnection();
 
// Inicializar Objeto
$quarto = new Quarto($db);
 
// Consultar Cliente
$var = $quarto->read();
$num = $var->rowCount();
 
// Checar se existe mais de 0 registros
if($num>0){
 
    // Array quarto
    $quarto_arr=array();
    $quarto_arr["Registros"]=array();
 
   //
    while ($linha = $var->fetch(PDO::FETCH_ASSOC)){

        extract($linha);
 
        $quarto_item=array(
            "Numero" => $numero,
            "Andar" => $andar,
            "Descrição" => $descquarto,
            "Ocupado" => $ocupado,
        );
 
        array_push($quarto_arr["Registros"], $quarto_item);
    }
 
    // Setar 200 - Ok
    http_response_code(200);
 
    // Mostrar o quarto em Json
    echo json_encode($quarto_arr);
}
 
else{
 
    // Setar para 404 -  Não Encontrado
    http_response_code(404);
 
    // Mostrar caso o cliente não foi encontrado
    echo json_encode(
        array("Mensagem" => "Quarto nao Encontrado.")
    );
}