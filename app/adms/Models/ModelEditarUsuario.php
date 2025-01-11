<?php

namespace App\adms\Models;

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

/**
 * classe responsavel por editar dados dos usuarios no banco de dados
 */
class ModelEditarUsuario
{
    /** @var $result recebe true quando executar o processo com sucesso */
    private bool $result = false;

    /** @var $resultBd recebe dados do banco de dados*/
    private array $resultBd;

    //private $parseString;  /neste nao deve precisar pois tem o parseString, a condicao para colocar no no fullRead , so deixei pra lembrar

    /** @var $id recebe id do usuario,  */
    private $id;

    /** @var $data recebe as informações do formulario que serão salvos (os dados que serão atualizados no banco de dados)  */
    private $data;

    /** @var $dataExitVal recebe os nomes dos campos que será(ao) tirado da validação (no caso sera o campo apelido que nao e obrigatorio estar preenchido)  */
    private $dataExitVal;

    private $parseString;

    private $listRegistryAdd;


    /**array $dataSave criado pra armazenar o dados que irão ser salvos/alterados no banco de dados */
    //private array $dataSave;  //tinha tentado usar isso pra testar se some uma mensgam errada que ta dando

    
    function getResult(): bool
    {
		return $this->result;
    }

    /** retorna os detalhes do registro */
    function getResultBd(): array
    {
        return $this->resultBd;
    }

    /**
     * listar os usuarios por id, vai mostrar os dados de um usuario de cada vez, em cada pagina, pelo id
     *
     * @return void
     */
    public function viewUser($id): void
    {
        $this->id = $id;
		
        
        //instancia o helper generico para obter os dados do banco de dados, ele quer ordernar de forma decrescente pra aparecer os ultimos inseridos primeiro
        $viewUser = new \App\adms\Models\AdmsRead();
        $viewUser->fullRead("SELECT * FROM usuarios WHERE id=:id 
        LIMIT :limit", "id={$this->id}&limit=1");

        $this->resultBd = $viewUser->getResult();
		
				      
        if($this->resultBd){
            		
            $this->result = true;
			
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário não encontrado! linha 75 </p>";
            $this->result = false;
        }
    }

    public function update($data): void
    {
        $this->data = $data;
		
		$this->data['senha'] = password_hash($this->data['senha'], PASSWORD_DEFAULT);
    
        $valEmptyField = new \App\adms\Models\ModelValCampoVazio();
        $valEmptyField->validaCampo($this->data);

        //se getResult retornar true significa que nao houve erro, entao pode cadastar no banco de dados
        if ($valEmptyField->getResult()) {
            $this->valInput();
        } else{
            $this->result = false;     
        }
    }

    private function valInput(): void
    {
        //instancia a classe que valida o email e na outra linha instancia o metodo que ta dentro desta classe
        $valEmail = new \App\adms\Models\ValEmail();
        $valEmail->validaEmail($this->data['email']);

        $valEmailSingle = new \App\adms\Models\ValEmailUnico();
        //ele coloca true pra mostrar que é o editar (e nao o criar usuario)
        $valEmailSingle->validaEmailUnico($this->data['email'], true, $this->data['id']);
              
        
        if(($valEmail->getResult()) and ($valEmailSingle->getResult()))
        {
            //se email for valido isntancia o metodo edit que edita os dados ao banco de dados
            $this->edit();
        }else{
            $this->result = false;
        }
    }

    private function edit(): void
    {
        
                 
        $upUser = new \App\adms\Models\Editar();
        $upUser->exeUpdate("usuarios", $this->data, "WHERE id=:id", "id={$this->data['id']}");
       
        if($upUser->getResult()){
           
            $_SESSION['msg'] = "<p style= 'color: green;'>Usuario editado com sucesso.</p>";
            $this->result = true;
        }else{
            
            $_SESSION['msg'] = "<p style= 'color: #f00;'>Erro: Usuário não editado</p>";
            $this->result = false;
        }

    }

/*
    public function listSelect(): array    
    {
        $this->parseString = "";   //so para colocar como parametro na hora de instanciar o metodo fullRead
        $list = new \App\adms\Models\AdmsRead();
        $list->fullRead("SELECT * FROM usuarios ORDER BY name ASC", $this->parseString);
        //vai atribuir o resultado para o array abaixo...na posicao sit
        $registry['sit']= $list->getResult();

        
              
        //vai atribuir o resultado para o array abaixo..  na posicao lev
        $registry['lev']= $list->getResult();

        $this->listRegistryAdd = ['sit' => $registry['sit'], 'lev' => $registry['lev']];

       
        return $this->listRegistryAdd;
    }  */
}






