<?php

namespace App\adms\Models;

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

/**
 * classe criada para validar o email a ser cadastrado no banco de dados
 */
class ValEmail
{
    /** @var string criada para receber o email a ser validado     */
    private string $email;
    /** @var result vai retornar verdadeiro se o resultado for valido     */
    private bool $result;

    function getResult(): bool
    {
        return $this->result;
    }

    public function validaEmail(string $email): void
    {
        $this->email = $email;
        if(filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            //se email for valido vai retornar true
            $this->result = true;
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'>Erro: E-mail inválido</p>";
            $this->result = false;
        }
    }
    

}