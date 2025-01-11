<?php

namespace Core;

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

/**
 * Carregar as páginas da view
 
 * 
 */
class ConfigView
{
    /**
     * Receber o endereco da View e os dados
     * @param string $nameView Endereco da view que deve ser carregada    
     * @param array|string|null $data(estas 3 opcoes juntas no php 8 $data   Dados que a VIEW deve receber*/
    private string $nameView;
    private $data;
     

    public function __construct(string $nameView, $data)
    {
             
       $this->nameView = $nameView;
       $this->data = $data;
        
    }


    /**
     * Carregar a view, verificar se o arquivo existe e carregar caso exista
     * Se nao existir para o carregamento e apresenta mensagem de erro, a unica diferença desta view para a loadviewlogin é que esta carrega o menu
     *
     * @return void
     */
    public function loadView(): void
    {
        if(file_exists('app/' .$this->nameView . '.php')) {
            include 'app/adms/Views/include/head.php';
            include 'app/' .$this->nameView . '.php';
            include 'app/adms/Views/include/footer.php';
        }else{
            //este erro 002 é  para controle proprio...vai dar se nao encontrar uma view com o nome
            die("Erro 002: Por favor tente novamente, caso o erro persista, entre em contato com o administrador
            " . EMAILADM);
        }
    }


}