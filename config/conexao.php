<?php
class Conexao{
 
    // Especificar as Credenciais para o Banco de Dados
    private $host = "localhost";
    private $db_name = "hotel";
    private $username = "root";
    private $password = "";
    public $conn;
 
    // Conexão do banco de dados
    public function getConnection(){
 
        $this->conn = null;
 
        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Erro de Conexão: " . $exception->getMessage();
        }
 
        return $this->conn;
    }
}
?>