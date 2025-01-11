<?php

namespace App\adms\Models;

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}


/**
 * classe responsavel por cadastrar usuarios novos no banco de dados, é instanciada no arquivo CadastrarUsuario
 
 */
class ModelNovoUsuario
{
    /**@var $dados recebe os dados enviados pelo usuario, quem deve enviar estes dados é a controller Login */
    private $data;
  
    private $result;

    //retorna valores do BD
    private $resultBd;
    
   
    function getResult(){
        return $this->result;
    }

    /** 
     * Recebe os valores do formulário.
     * Instancia o "ModelValCampoVazio" para verificar se todos os campos estão preenchidos 
     * Verifica se todos os campos estão preenchidos e instancia o método "validaCampo" para validar os dados dos campos
   
     * @param array $data Recebe as informações do formulário
     * 
     * @return void
     */
    public function criar($data)
    {
        //$this->data é o atribuido que irá receber os dados
        $this->data = $data;
      
    
        $validaCampo = new \App\adms\Models\ModelValCampoVazio();
        $validaCampo->validaCampo($this->data);

        //se getResult retornar true significa que nao houve erro, entao pode cadastar no banco de dados
        if ($validaCampo->getResult()) {
            $this->validaEntrada();
        } else{
            $this->result = false;     
        }
    }  
    
    /** 
     * Instanciar  "ValEmail" para verificar se o e-mail válido
     * Instanciar  "ValEmailUnico" para verificar se o e-mail não está cadastrado no banco de dados, não permitido cadastro com e-mail duplicado
     * Instanciar  "ValidarSenha" para validar a senha, deve ter no minimo 6 digitos     
     * chamar a funcao "adiciona" quando não houver nenhum erro de preenchimento 
     * Retorna FALSE quando houver algum erro
     * 
     * @return void
     */
    private function validaEntrada(): void
    {
        //instancia a classe que valida o email e na outra linha instancia o metodo que ta dentro desta classe
        $valEmail = new \App\adms\Models\ValEmail();
        $valEmail->validaEmail($this->data['email']);
	
        //instancia a classe e metodo  que validam se ainda nao tem o email cadastrado no BD 
        $valEmailUnico = new \App\adms\Models\ValEmailUnico();
        $valEmailUnico->validaEmailUnico($this->data['email']);
		

        $valSenha = new \App\adms\Models\ValidarSenha();
        $valSenha->validaSenha($this->data['senha']);

       
        if($valEmail->getResult() and ($valEmailUnico->getResult()) and ($valSenha->getResult()))
       {
            //se email for valido isntancia o metodo add que adiciona os dados ao banco de dados
			
            $this->adiciona();
        }else{
            $this->result = false;
        }

    }
    
    /** 
     * Cadastrar usuário no banco de dados
     * Retorna TRUE quando cadastrar o usuário com sucesso
     * Retorna FALSE quando não cadastrar o usuário
     * 
     * @return void
     */
    private function adiciona(): void
    {
			
            $this->data['senha'] = password_hash($this->data['senha'], PASSWORD_DEFAULT);
            			
		

            //vai instanciar agora o Insercao e atribuir para um objeto chamado createUser

            $createUser = new \App\adms\Models\Insercao();
            $createUser->exeCreate("usuarios", $this->data);

           
            //se teve getResult() conseguiu cadastrar com sucesso
            if($createUser->getResult()){
				 $_SESSION['msg'] = "<p style= 'color: green;'>Usuário cadastrado.</p>";
                $this->result = true;
               
            }else{
                $_SESSION['msg'] = "<p style= 'color: #f00;'>Erro: Usuário não cadastrado.</p>";
                $this->result = false;
            }
	}		


}



