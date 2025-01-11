<?php

namespace App\adms\Controllers;

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

/**
 * COntroller da página de cadastrar um novo usuário, neste caso dentro do sistema (e nao de fora sem precisar do login)
 * @author Cristina (assistindo aula do Cesar Celke) <crismgsp@gmail.com>
 */
class CadastrarUsuario
{
    /** 
     * @var $data recebe os dados que devem ser enviados para a view ..o que ta comentado so funciona no php 8 desta forma
     * coloquei do jeito que funciona na minha versao
     */
    //private array|string|null $data; isso funcionaria no php 8

    private $data;

    /** 
     * @var $dataform recebe os dados do formulario de cadastro
     */
    private $dataForm;

    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para a View. Quando o usuario clica no botao cadastrar
     * envia acessa o if e instancia a classe AdmsAddUsers responsavel por cadastrar o usuario no banco de dados. Quando o usuário for cadastrado
     * com sucesso direciona para a pagina listar usuarios , se não , instancia a classe responsavel em carregar a view e enviar os dados para  a view
     *
     * @return void
     */

    
    public function index(): void
    {
        
        $data = [];

        $this->data = $data;

        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);

                      
         if(!empty($this->dataForm['NovoUsuario'])) {
			//faz o unset para tirar os dados do SendNewUser que estavam aparecendo no meio 
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

        //este pedaço abaixo é para carregar a pagina relacionada a esta controller que é a addUser
    private function viewAddUser(): void
    {
       
        $loadView = new \Core\ConfigView("adms/Views/cadastrarUsuario", $this->data);
        $loadView->loadView(); 
    }
        
        
}