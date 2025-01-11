<?php

namespace App\adms\Models;

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

/**
 * classe criada para checar se o email a ser cadastrado nao existe ainda no banco de dados
 */
class ValEmailUnico
{
    /** @var string $email criada para receber o email a ser checado no banco de dados     */
    private string $email;
    /** @var string $edit recebe informacao que é usada para verificar se é pra validar email pra cadastro ou edição  */
    private $edit;   //tava tipo bool mas tirei pq tava dando problema ao declarar null
    /** @var string $id recebe o id do usuario que deve ser ignorado quando estiver validando email para edicao  */
    private $id;  // tava tipo int mas tirei pq tava dando problema ao declarar null
     /** @var bool $result recebe os registros do banco de dados ,retorna true se nao for encontrado nenhum usuario com este email */
    private bool $result;
    /** @var bool $resultBd recebe os registros do banco de dados */
    private $resultBd;
    

    function getResult(): bool
    {
        return $this->result;
    }

//esta colocando $edit e $id = null para nao ficar faltando parametros na hora de instanciar este metodo
//fica tipo "parametros opcionais"
//mexi neste pedaço em vez de declarar null diretamente na hora de chamar a função, pois estava dando erro de parametros na hora de usar este validateEmailSingle na hora
// de editar usuarios ...comentei aqui e coloquei onde nao tem id e edit como null...quando usa este adms pq tambem estava dando erro
    public function validaEmailUnico(string $email , $edit = "", $id = ""): void
    {
            
        $this->email = $email;
        $this->edit = $edit;
        $this->id = $id;

        //vai instanciar a classe que seleciona registros no banco de dados
        $valEmailSingle = new \App\adms\Models\AdmsRead();
        //se edit for true é porque o usuario quer editar e se o id for diferente de vazio acessa este if
        if(($this->edit == true) and (!empty($this->id))){
            //quando ele quiser editar algum vai ter que ignorar 
            //para edição se ja existir o id..ele confere se nao tem este email colocado na edicao em um id diferemte pra evitar que na edicao troque o email pra um
			//que ha esta cadastrado em outro id
            $valEmailSingle->fullRead("SELECT id FROM usuarios WHERE (email =:email) AND id <>:id LIMIT :limit", 
            "email={$this->email}&$id={$this->id}&limit=1");

        }else{
            //instancia o metodo que busca no banco de dados um id quando o email la for = ao email digitado 
            //agora ao tentar inserir um novo cadastro
            $valEmailSingle->fullRead("SELECT id FROM usuarios WHERE email =:email LIMIT :limit", 
            "email={$this->email}&limit=1");
        }    

        $this->resultBd = $valEmailSingle->getResult();
		
        //se nao encontrou nenhum usuario com este email, se resultBd nao tiver resultado retorna true
        if(!$this->resultBd){
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: Este email já está cadastrado</p>";
            $this->result = false;
        }

        
    }
    

}