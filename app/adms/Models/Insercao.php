<?php

namespace App\adms\Models;

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

use PDOException;


/**
 *  classe genérica para cadastrar registro no banco de dados
 */
class Insercao extends Conexao
{
    //vai receber os dados da tabela onde quer cadastrar os dados
    private string $table;
    //dados que serao inseridos
    private $data;
    //pra receber o resultado se conseguir cadastrar com sucesso
    private string $result;
    //vai inserir a query preparada
    private object $insert;
    private string $query;
    private object $conn;

    function getResult(): string
    {
        return $this->result;
    }

    //funcao para executar o cadastro, recebe o nome da tabela e os dados a inserir 
    public function exeCreate(string $table, $data): void
    {
        $this->table = $table;
        $this->data = $data;
        
        $this->prepararQuery();
        
    }   

    private function prepararQuery():void
    {
        //abaixo é pra receber os dados, e criar um array, separando eles pela virgula, 
        // no caso o que vai sobrar sao os nomes das colunas que tem no banco
        $coluns = implode(',', array_keys($this->data));
        
        $values = ':'. implode(', :', array_keys($this->data));
        
        $this->query = "INSERT INTO {$this->table} ($coluns) VALUES ($values)";
        //var_dump($this->query);
        $this->exeInstruction();
    }

    private function exeInstruction(): void
    {
        //instanciando a conexao
        $this->connection();
        try{
            //se der certo a conexao executa a o atributo que recebeu a query preparada
            $this->insert->execute($this->data);
            //para recuperar o ultimo id inserido usa lastInsertId
            $this->result = $this->conn->lastInsertId();
        }catch(PDOException $err){
            $this->result = null;
           
        }
    }

    private function connection(): void
    {
        $this->conn = $this->connectDb();
        //preparando a query e atribuindo para o atributo $this->insert
        $this->insert = $this->conn->prepare($this->query);
    }



}