<?php
session_start();
//vai acrescentar a função abaixo pra evitar possiveis erros se for usar hospedagem compartilhada
ob_start();

define('CONST123TESTE', true);
    
//carregar o Composer
require './vendor/autoload.php';
//Instanciar a classe ConfigController, responsável por tratar a URL
$home = new Core\ConfigController();
//Instanciar o método para carregar a página/controller
$home->loadPage();

      
 