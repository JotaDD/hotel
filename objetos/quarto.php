<?php


class Quarto{
    
 
    // Conexão com o banco e nome da tabela
    private $con;
    private $table_name = "quarto";
 
    // Objetos
    public $numero;
    public $andar;
    public $descquarto;
    public $ocupado;
 
 
    // Construtor com $db como base de conexão
    public function __construct($db){
        $this->con = $db;
    }

    // Ler cliente
    function read(){
    
        // SQL
        $consulta = "SELECT
                    numero, andar, descquarto, ocupado
                FROM
                    " . $this->table_name . " 
                ORDER BY
                    numero ASC";
    
        // Declarar consulta
        $var = $this->con->prepare($consulta);
    
        // Executar Consulta
        $var->execute();
    
        return $var;
    }

    // Criar Quarto
    function create(){

        // SQL
        $consulta = "INSERT INTO
                    " . $this->table_name . "
                SET
                    numero =:numero,
                    andar=:andar,
                    descquarto=:descquarto,
                    ocupado=:ocupado";
                 
        // Declarar Consulta
        $var = $this->con->prepare($consulta);
    
        // Converte Caracter especial e Retira as Tags - 
        $this->numero=htmlspecialchars(strip_tags($this->numero));
        $this->andar=htmlspecialchars(strip_tags($this->andar));
        $this->descquarto=htmlspecialchars(strip_tags($this->descquarto));
        $this->ocupado=htmlspecialchars(strip_tags($this->ocupado));
      

        // Não deixar ninguem de fora alterar os dados
        $var->bindParam(":numero", $this->numero);
        $var->bindParam(":andar", $this->andar);
        $var->bindParam(":descquarto", $this->descquarto);
        $var->bindParam(":ocupado", $this->ocupado);
      
    
        // Executar a Consulta
        if($var->execute()){
            return true;
        }
    
        return false;
        
    }



    // Atualizar
    function update(){
    
        // Consulta Update
        $consulta = "UPDATE
                    " . $this->table_name . "
                SET
                    numero = :numero,
                    andar = :andar,
                    descquarto = :descquarto,
                    ocupado = :ocupado
                WHERE
                    numero = :numero";
    
        // Declarar Consulta
        $var = $this->con->prepare($consulta);
     
        // Converte Caracter especial e Retira as Tags - 1
        $this->numero=htmlspecialchars(strip_tags($this->numero));
        $this->andar=htmlspecialchars(strip_tags($this->andar));
        $this->descquarto=htmlspecialchars(strip_tags($this->descquarto));
        $this->ocupado=htmlspecialchars(strip_tags($this->ocupado));
       

        // Não deixar ninguem de fora alterar os dados
        $var->bindParam(":numero", $this->numero);
        $var->bindParam(":andar", $this->andar);
        $var->bindParam(":descquarto", $this->descquarto);
        $var->bindParam(":ocupado", $this->ocupado);
    
    
        // Executar a Consulta
        if($var->execute()){
            return true;
        }
     
        return false;
         
    }
        // Deletar Produto
    function delete(){
    
        // Consulta Delete
        $consulta = "DELETE FROM " . $this->table_name . " WHERE numero = ?";
    
        // Peparar a Consulta
        $var = $this->con->prepare($consulta);
    
        // Converte Caracter especial e Retira as Tags
        $this->numero=htmlspecialchars(strip_tags($this->numero));
    
        // Vincular o Numero
        $var->bindParam(1, $this->numero);
    
        // Executar Consulta
        if($var->execute()){
            return true;
        }
    
        return false;
    }

    // Usado ao preencher o formulário de atualização do produto
    function readOne(){

    // Contulta para ler um unico dado
    $consulta = "SELECT
                numero, andar, descquarto, ocupado
            FROM
                " . $this->table_name . " 
            
            WHERE
                numero = ?
            LIMIT
                0,1";

    // Preparar declaração de consulta
    $var = $this->con->prepare( $consulta );

    // Não deixar ninguem de fora alterar os dados
    $var->bindParam(1, $this->numero);

    // Executar consulta
    $var->execute();

    // Obter linha recuperada
    $linha = $var->fetch(PDO::FETCH_ASSOC);

    // Definir os valores
    $this->numero = $linha['numero'];
    $this->andar = $linha['andar'];
    $this->descquarto = $linha['descquarto'];
    $this->ocupado = $linha['ocupado'];



    }


    

}


?>