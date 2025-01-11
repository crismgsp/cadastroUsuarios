<?php

namespace App\adms\Models;

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

/**
 * classe responsavel por receber dados dos usuarios cadastrados no banco de dados, é instanciada no controller Usuarios que lista os usuarios cadastrados
 */
class ModelListarUsuarios
{
    /** @var bool $result recebe true quando executar o processo com sucesso */
    private bool $result;   

    /** @var $resultBd recebe dados do banco de dados*/
    private $resultBd;

  
    private $parseString;
	
       
    function getResult(): bool
    {
				
        return $this->result;
    }

    function getResultBd()
    {
        return $this->resultBd;
    }
   
    /**
     * listar os usuarios
     *
     * @return void
     */
    public function listarUsuarios(): void
    {
        $parseString = "";
        
     
        $this->parseString = $parseString;
        
        $listUsers = new \App\adms\Models\AdmsRead();
        $listUsers->fullRead("SELECT * from usuarios", $parseString);

        $this->resultBd = $listUsers->getResult();
        
        if($this->resultBd){
           
		    $this->result = true;
			
			
        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Nenhum usuário encontrado!!!</p> ";
            $this->result = false;
        }
    }

   
}




