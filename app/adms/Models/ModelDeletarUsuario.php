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
     * Instanciar a classe responsável em carregar a View e enviar os dados para a View. Quando o usuario clica no botao cadastrar
     * envia acessa o if e instancia a classe AdmsEditUsers responsavel por editar o usuario no banco de dados. 
     *
     * @return void
     */

    
        /**
     * listar os usuarios por id, vai mostrar os dados de um usuario de cada vez, em cada pagina, pelo id
     *
     * @return void
     */
    public function deleteUser($id): void
    {
        $this->id = $id;
        
        if($this->viewUser()){
            //se encontrar o usuario pode excluir....vai instanciar a classe helper de deletar e criar um objeto $deleteUser
            $deleteUser = new \App\adms\Models\Deletar();
            //agora pega o objeto pra instanciar o metodo exeDelete..parametros: tabela, condicao(termos), parseString(em que o id vai receber o id do usuario)
            //nas aulas iniciais explicou sobre o parseString...que pega uma string e converte para um array
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
       
        //o professor nao fez isso..to fazendo pq tava dando erro...pedindo 2 argumentos em fullRead ai criei o parseString e coloquei vazio
        $this->parseString = "";
        //instancia o helper generico para obter os dados do banco de dados, ele quer ordernar de forma decrescente pra aparecer os ultimos inseridos primeiro
        $viewUser = new \App\adms\Models\AdmsRead();
        $viewUser->fullRead("SELECT * FROM usuarios
        WHERE id=:id LIMIT :limit", 
        "id={$this->id}&limit=1", $this->parseString);

        $this->resultBd = $viewUser->getResult();
        
        if($this->resultBd){
            
            return true;
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Usuário não encontrado!!!</p>";
            return false;
        }
    }
    
    
       
        
}