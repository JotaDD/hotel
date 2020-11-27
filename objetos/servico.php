<?php


class Servico{
    
 
    // Conexão com o banco e nome da tabela
    private $con;
    private $table_name = "servico";
 
    // Objetos
    //public $id;
    public $tipo;
    public $valor;
    public $desc;
 
    // Construtor com $db como base de conexão
    public function __construct($db){
        $this->con = $db;
    }

    // Ler servico
    function read(){
    
        // SQL
        $consulta = "SELECT
                    s.id, s.tipo, s.valor, s.desc
                FROM
                    " . $this->table_name . " s 
                ORDER BY
                s.id ASC";
    
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
                tipo=:tipo, valor=:valor , desc=:desc";

    // Declarar Consulta
    $var = $this->con->prepare($consulta);

    // Converte Caracter especial e Retira as Tags 
    $this->tipo=htmlspecialchars(strip_tags($this->tipo));
    $this->valor=htmlspecialchars(strip_tags($this->valor));
    $this->desc=htmlspecialchars(strip_tags($this->desc));

    // Não deixar ninguem de fora alterar os dados
    $var->bindParam(":tipo", $this->tipo);
    $var->bindParam(":valor", $this->valor);
    $var->bindParam(":desc", $this->desc);

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
                    " . $this->table_name . "s
                SET
                    id = :id,
                    tipo = :tipo,
                    valor = :valor,
                    desc = :desc
                WHERE
                    id = :id";
    
        // Declarar Consulta
        $var = $this->con->prepare($consulta);
     
        // Converte Caracter especial e Retira as Tags 
        $this->id=htmlspecialchars(strip_tags($this->id));
        $this->tipo=htmlspecialchars(strip_tags($this->tipo));
        $this->valor=htmlspecialchars(strip_tags($this->valor));
        $this->desc=htmlspecialchars(strip_tags($this->desc));

        // Bindar os Valores
        $var->bindParam(":id", $this->id);
        $var->bindParam(":tipo", $this->tipo);
        $var->bindParam(":valor", $this->valor);
        $var->bindParam(":desc", $this->desc);
    
        // Executar a Consulta
        if($var->execute()){
            return true;
        }
     
        return false;
         
    }
        // Deletar Produto
    function delete(){
    
        // Consulta Delete
        $consulta = "DELETE FROM " . $this->table_name . " WHERE id = ?";
    
        // Peparar a Consulta
        $var = $this->con->prepare($consulta);
    
        // Converte Caracter especial e Retira as Tags
        $this->id=htmlspecialchars(strip_tags($this->id));
    
        // Vincular o id
        $var->bindParam(1, $this->id);
    
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
                s.id, s.tipo, s.valor, s.desc
            FROM
                " . $this->table_name . " s
            
            WHERE
                id = ?
            LIMIT
                0,1";

    // Preparar declaração de consulta
    $var = $this->con->prepare( $consulta );

    // Vincular o id do Serviço a ser atualizado
    $var->bindParam(1, $this->id);

    // Executar consulta
    $var->execute();

    // Obter linha recuperada
    $linha = $var->fetch(PDO::FETCH_ASSOC);

    // Definir os valores
    $this->id = $linha['id'];
    $this->tipo = $linha['tipo'];
    $this->valor = $linha['valor'];
    $this->desc = $linha['desc'];


    }


    

}


?>