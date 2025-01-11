<?php

namespace App\adms\Models;

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

use PDOException;
use PDO;


/**
 * Conexão com o banco de dados

 */

abstract class Conexao
{
   /*** @var string $host Recebe o host da constante HOST*/
    private string $host = HOST;
    /*** @var string $user Recebe o usuario da constante USER*/
    private string $user = USER;
    /*** @var string $pass Recebe a senha da constante PASS*/
    private string $pass = PASS;
    /*** @var string $dbname Recebe o nome da base de dados da constante DBNAME*/
    private string $dbname = DBNAME;
    /*** @var string $port Recebe a porta da constante PORT*/
    private string $port = PORT;
    /*** @var string $connect Recebe a conexao com o banco de dados*/
    private object $connect;

    /**
     * Realiza a conexão com o banco de dados.
     * Não realizando o conexão corretamente, para o processamento da página e apresenta a mensagem de erro, com o e-mail de contato do administrador
     * @return object retorna a conexão com o banco de dados
     */
    protected function connectDb(): object
    {
        try{
           
            //Conexao sem a porta
            $this->connect = new PDO("mysql:host={$this->host};dbname=" . $this->dbname, $this->user, $this->pass);

            return $this->connect;

        }catch(PDOException $err){
            //colocquei erro 001 pra controle do programador...caso haja este erro é problema na conexao
            die("Erro 001: Por favor tente novamente, caso o erro persista, entre em contato com o administrador
            " . EMAILADM);
        }
    }
}