<?php

namespace Core;

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

abstract class Config
{

    /**
     * Possui as constantes com as configurações.
     * Configurações de endereço do projeto.
     * Página principal do projeto.
     * Credenciais de acesso ao banco de dados
     * E-mail do administrador.
     * 
     * @return void
     */
    protected function configAdmin(): void
    {
        define('URL', 'https://localhost/');
        define('URLADM', 'https://localhost/usuarios2/');

       
		define('CONTROLLER', 'Usuarios');
        define('METODO', 'index');
       
	   define('CONTROLLERERRO', 'Usuarios');

        define('HOST', 'localhost');
        define('USER', 'root');
        define('PASS', '');
        define('DBNAME', 'usuariosteste');
        define('PORT', '3306');

        define('EMAILADM', 'emailficticio@gmail.com');
    }
}
