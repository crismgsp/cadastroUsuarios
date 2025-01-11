<?php

namespace App\adms\Models;

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

/**
 * classe responsavel por apagar usuarios no banco de dados
 */
class ModelDeletarUsuario
{
    
    /**  @var $id recebe o id do registro/usuario*/
    private $id;
    
  /** @var $result recebe true quando executar o processo com sucesso */
    private bool $result = false;

    private $parseString;  


    
        /**
     * listar os usuarios por id, vai mostrar os dados de um usuario de cada vez, em cada pagina, pelo id
     *
     * @return void
     */
    public function deleteUser($id): void
    {
        $this->id = $id;
        
        if($this->viewUser()){
            //se encontrar o usuario pode excluir....vai instanciar a classe de deletar e criar um objeto $deleteUser
            $deleteUser = new \App\adms\Models\Deletar();
            //agora pega o objeto pra instanciar o metodo exeDelete..parametros: tabela, condicao(termos), parseString(em que o id vai receber o id do usuario)
    
            $deleteUser->exeDelete("usuarios", "WHERE id=:id", "id={$this->id}" );

            if($deleteUser->getResult()){
                //instancia o metodo que deleta a pasta e a imagem
                $_SESSION['msg'] = "<p class='alert-success'>Usuario apagado com sucesso</p>";
                $this->result = true;
            }else{
                $_SESSION['msg'] = "<p class='alert-danger'>Usuario não apagado</p>";
                $this->result = false;
            }
        }else{
            $this->result = false;
        }

    } 
	
	private function viewUser(): bool
    {
       
        $viewUser = new \App\adms\Models\AdmsRead();
        $viewUser->fullRead("SELECT * FROM usuarios
        WHERE id=:id LIMIT :limit", 
		"id={$this->id}&limit=1");
        

        $this->resultBd = $viewUser->getResult();
        
        if($this->resultBd){
            
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário não encontrado!!!</p>";
            return false;
        }
    }
    
    
       
        
}