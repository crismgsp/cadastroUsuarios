<?php

namespace App\adms\Controllers;


if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

/**
 * COntroller da página de apagar usuario  dentro do sistema 
 * @author Cristina (assistindo aula do Cesar Celke) <crismgsp@gmail.com>
 */
class DeletarUsuario
{
    
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
        
        //se o id for diferente de vazio
        if(!empty($id)){
            $this->id = (int) $id;
            $deleteUser = new \App\adms\Models\ModelDeletarUsuario();
            $deleteUser->deleteUser($this->id);
                     
        } else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Necessario selecionar um usuario</p>";
           
        }

        //vai redirecionar para listar usuarios se der certo ou nao o delete
        $urlRedirect = URLADM . "usuarios/index";
        header("Location: $urlRedirect");
    }  
    
    
       
        
}