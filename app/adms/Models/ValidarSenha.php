<?php

namespace App\adms\Models;

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

/**
 * classe criada para validar(pelo lado do servidor) a senha a ser cadastrada no banco de dados
 
 */
class ValidarSenha
{
    /** @var string $senhacriada para receber a senha a ser validada     */
    private string $senha;
    /** @var bool $result vai retornar verdadeiro se o resultado for valido     */
    private bool $result;
	
	

    function getResult(): bool
    {
        return $this->result;
    }

    /** 
    
     * @return void
     */
    public function validaSenha(string $senha): void
    {
		$this->senha = $senha;
    
        if(strlen($this->senha) < 6){
            ?>
            <script> alert("A senha deve ter no mínimo 6 digitos"); </script> <?php
                $this->result = false;
        }else{
             $this->result = true;
        }
    }
    
    
}