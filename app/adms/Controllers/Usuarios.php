<?php

namespace App\adms\Controllers;

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

/**
 * Controller da pagina listar usuarios
 */
class Usuarios
{
    /** @var $data recebe os dados que devem ser enviados */
    private $data;

    /** @var $page Recebe o numero da pagina que o usuario está */
    private $page;

    /** @var $dataForm */
    private $dataForm;

    private $searchName;
    private $searchEmail;

    public function index()
    {
       

        $listUsers = new \App\adms\Models\ModelListarUsuarios();
		//$listUsers = $listUsers->listarUsuarios();
		$listUsers->listarUsuarios();
         
        if($listUsers->getResult()){
            
            $this->data['listUsers'] = $listUsers->getResultBd();
          
        }else{
            //caso nao receba nada recebe um vazio
            $this->data['listUsers'] = [];
            
        }

        
        //instanciando a classe ConfigView, criando um objeto da classe chamado $loadView
        $loadView = new \Core\ConfigView("adms/Views/usuarios", $this->data);
        //instanciando o método loadView que fica na classe ConfigView
        $loadView->loadView();
    }
}