<?php

 
// URL da Home Page
$home="http://localhost/apihotel/";
 
//  Página fornecida no parâmetro de URL, setar paginina padrão 1
$pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
 
// Setar o numero de registro por pagina
$registroPagina = 5;
 
// Calcular para o LIMIT
$numRegistor = ($registroPagina * $pagina) - $registroPagina;
?>