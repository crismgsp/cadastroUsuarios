<?php

namespace App\adms\Controllers;

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

/**
 * COntroller da página de cadastrar um novo usuário
 
 */
class CadastrarUsuario
{
    /** 
     * @var $data recebe os dados que devem ser enviados para a view ..
     */
    

    private $data;

    /** 
     * @var $dataform recebe os dados do formulario de cadastro
     */
    private $dataForm;

    /**
     * 
     *
     * @return void
     */

    
    public function index(): void
    {
        
        $data = [];

        $this->data = $data;

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                      
         if(!empty($this->dataForm['NovoUsuario'])) {
		
			//dos dados a cadastrar no banco de dados
			unset($this->dataForm['NovoUsuario']);   
			
				
			$criarNovoUsuario = new \App\adms\Models\ModelNovoUsuario();
				
			$criarNovoUsuario->criar($this->dataForm);
					
			if($criarNovoUsuario->getResult()){
				$urlRedirect = URLADM;
				header("Location: $urlRedirect");
			}else {
				$this->data['form'] = $this->dataForm;
				$this->viewAddUser();
			}
		}else{
			$this->viewAddUser();
		}   
    }  

       
    private function viewAddUser(): void
    {
       
        $loadView = new \Core\ConfigView("adms/Views/cadastrarUsuario", $this->data);
        $loadView->loadView(); 
    }
        
        
}