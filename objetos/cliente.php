<?php


class Cliente{
    
 
    // Conexão com o banco e nome da tabela
    private $con;
    private $table_name = "cliente";
 
    // Objetos
    public $cpf;
    public $nome;
    public $sexo;
    public $telefone;
 
    // Construtor com $db como base de conexão
    public function __construct($db){
        $this->con = $db;
    }

    // Ler cliente
    function read(){
    
        // SQL
        $consulta = "SELECT
                    c.cpf, c.nome, c.sexo, c.telefone
                FROM
                    " . $this->table_name . " c 
                ORDER BY
                    c.cpf ASC";
    
        // Declarar consulta
        $var = $this->con->prepare($consulta);
    
        // Executar Consulta
        $var->execute();
    
        return $var;
    }

    // Criar Cliente
    function create(){

        // SQL
        $consulta = "INSERT INTO
                    " . $this->table_name . "
                SET
                    cpf=:cpf, nome=:nome , sexo=:sexo, telefone=:telefone";
    
        // Declarar Consulta
        $var = $this->con->prepare($consulta);
    
        // Converte Caracter especial e Retira as Tags 
        $this->cpf=htmlspecialchars(strip_tags($this->cpf));
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->sexo=htmlspecialchars(strip_tags($this->sexo));
        $this->telefone=htmlspecialchars(strip_tags($this->telefone));

        // Não deixar ninguem de fora alterar os dados
        $var->bindParam(":cpf", $this->cpf);
        $var->bindParam(":nome", $this->nome);
        $var->bindParam(":sexo", $this->sexo);
        $var->bindParam(":telefone", $this->telefone);
    
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
                    cpf = :cpf,
                    nome = :nome,
                    sexo = :sexo,
                    telefone = :telefone
                WHERE
                    cpf = :cpf";
    
        // Declarar Consulta
        $var = $this->con->prepare($consulta);
     
        // Converte Caracter especial e Retira as Tags 
        $this->cpf=htmlspecialchars(strip_tags($this->cpf));
        $this->nome=htmlspecialchars(strip_tags($this->nome));
        $this->sexo=htmlspecialchars(strip_tags($this->sexo));
        $this->telefone=htmlspecialchars(strip_tags($this->telefone));

        // Não deixar ninguem de fora alterar os dados
        $var->bindParam(":cpf", $this->cpf);
        $var->bindParam(":nome", $this->nome);
        $var->bindParam(":sexo", $this->sexo);
        $var->bindParam(":telefone", $this->telefone);
    
        // Executar a Consulta
        if($var->execute()){
            return true;
        }
     
        return false;
         
    }
        // Deletar Produto
    function delete(){
    
        // Consulta Delete
        $consulta = "DELETE FROM " . $this->table_name . " WHERE cpf = ?";
    
        // Peparar a Consulta
        $var = $this->con->prepare($consulta);
    
        // Converte Caracter especial e Retira as Tags
        $this->cpf=htmlspecialchars(strip_tags($this->cpf));
    
        // Não deixar ninguem de fora alterar os dados
        $var->bindParam(1, $this->cpf);
    
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
                cpf, nome, sexo, telefone
            FROM
                " . $this->table_name . " c
            
            WHERE
                cpf = ?
            LIMIT
                0,1";

    // Preparar declaração de consulta
    $var = $this->con->prepare( $consulta );

   // Não deixar ninguem de fora alterar os dados
    $var->bindParam(1, $this->cpf);

    // Executar consulta
    $var->execute();

    // Obter linha recuperada
    $linha = $var->fetch(PDO::FETCH_ASSOC);

    // Definir os valores
    $this->cpf = $linha['cpf'];
    $this->nome = $linha['nome'];
    $this->sexo = $linha['sexo'];
    $this->telefone = $linha['telefone'];


    }


    

}


?>