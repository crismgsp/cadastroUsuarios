<?php

namespace App\adms\Controllers;

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

/**
 * COntroller da página de editar usuario  dentro do sistema 
 * @author Cristina (assistindo aula do Cesar Celke) <crismgsp@gmail.com>
 */
class EditarUsuario
{
    /** 
     * @var $data recebe os dados que devem ser enviados para a view ..o que ta comentado so funciona no php 8 desta forma*/  
    private $data;
    
    /**  @var $dataform recebe os dados do formulario de cadastro*/
    private $dataForm;

    /**  @var $id recebe o id do registro/usuario*/
    private $id;


    /**
     * Instanciar a classe responsável em carregar a View e enviar os dados para a View. Quando o usuario clica no botao cadastrar
     * envia acessa o if e instancia a classe AdmsEditUsers responsavel por editar o usuario no banco de dados. 
     *
     * @return void
     */

    
    public function index($id): void
    {
        //recebe os dados digitados pelo usuario na edicao
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //se o id for diferente de vazio e o botao para enviar os dados de edicao do usuario não foi clicado
        if((!empty($id)) and (empty($this->dataForm['SendEditUser']))){
            $this->id = (int) $id;
            $viewUser= new \App\adms\Models\ModelEditarUsuario();
            $viewUser->viewUser($this->id);
            if($viewUser->getResult()){
                $this->data['form'] = $viewUser->getResultBd();
           
                $this->viewEditUser();
				//$this->editUser();
            }else{
                $urlRedirect = URLADM . "usuarios/index";
                header("Location: $urlRedirect");
                
            }  

        } else{
            
            $this->editUser();
        }
    }    


    //este pedaço abaixo é para carregar a pagina com os dados antes de editar
	
    private function viewEditUser(): void
    {
      

        $loadView = new \Core\ConfigView("adms/Views/editarUsuario", $this->data);
        $loadView->loadView(); 
    } 

    private function editUser(): void
    {
        //se o usuario clicou no botao daquele formulario acessa o if, caso contrario acesse o else
        if(!empty($this->dataForm['SendEditUser'])){
            unset($this->dataForm['SendEditUser']);
            //instancia a model responsavel por editar no banco de dados
            $editUser = new \App\adms\Models\ModelEditarUsuario();
            $editUser->update($this->dataForm);
            if($editUser->getResult()){
                $urlRedirect = URLADM . "editar-usuario/index/" . $this->dataForm['id'];  //arrumei aqui
                header("Location: $urlRedirect");
            }else{
                //caso nao retorne true mantem os dados digitados no formulario e carrrega a view
                $this->data['form'] = $this->dataForm;
                $this->viewEditUser();
            }

        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado </p>";
            $urlRedirect = URLADM . "usuarios/index";
            header("Location: $urlRedirect");
        } 
    }
        
        
}