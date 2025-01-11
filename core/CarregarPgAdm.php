<?php

namespace Core;

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

/**
 * Verificar se existe a classe
 * Carregar a Controller

 */
class CarregarPgAdm
{
     /*** @var string $urlController Recebe da URL o nome da controller   */
     private string $urlController;
     /*** @var  $urlMetodo Recebe da URL o nome do metodo   */
     private $urlMetodo; //tava string mas tirei pois esta dando erro pra buscar alguns parametros
     /*** @var string $urlParameter Recebe da URL o parametro   */
     private string $urlParameter;
      /*** @var string $classLoad Controller que deve ser carregada   */
    private string $classLoad;
    /*** @var string $urlSlugController Recebe o controller tratado   */
    private string $urlSlugController;
    /*** @var string $urlSlugMetodo Recebe o metodo tratado   */
    private string $urlSlugMetodo;

    private array $listPgPublic;
    


     public function loadPage(string $urlController, string $urlMetodo, string $urlParameter)
     {
        $this->urlController = $urlController;
        $this->urlMetodo = $urlMetodo;
        $this->urlParameter = $urlParameter;

     

        $this->classLoad = "\\App\\adms\\Controllers\\" . $this->urlController;

        $this->pgPublic();

       
        if(class_exists($this->classLoad)){
            $this->loadMetodo();

        }else{
     
            $this->urlController = $this->slugController(CONTROLLER);
            $this->urlMetodo = $this->slugMetodo(METODO);
            $this->urlParameter = "";
            //abaixo ocorre uma funcao recursiva..uma funcao chamando ela dentro dela mesma
            $this->loadPage($this->urlController, $this->urlMetodo,$this->urlParameter);

        }
        
     }

     private function loadMetodo(): void
     {
        $classLoad = new $this->classLoad();
        if(method_exists($classLoad, $this->urlMetodo)){
            $classLoad->{$this->urlMetodo}($this->urlParameter);
        }else {
            //erro 004 anotei que é um erro que ocorre ao tentar carregar o metodo
            die("Erro 004: Por favor tente novamente, caso o erro persista, entre em contato 
            com o administrador " . EMAILADM);
        }
     }

     private function pgPublic():void
     {
        // neste projeto demonstrativo todas paginas serão publicas
        $this->listPgPublic = ["Usuarios", "EditarUsuario", "DeletarUsuario", "CadastrarUsuario"];
        //se no array acima existir esta urlController faz o que ta ai, caso contrario faz o que ta no else
        if(in_array($this->urlController, $this->listPgPublic)) {
            //se for uma pagina publica carrega
            $this->classLoad= "\\App\\adms\\Controllers\\" . $this->urlController;
        }else{
            $_SESSION['msg'] = "<p class='alert-danger'> Erro: página não encontrada </p>";
            $urlRedirect = URLADM . "Usuarios/index";
            header("Location: $urlRedirect");
        }
     }

     

     /**
     
     * Utilizando as funcoes para converter tudo pra minusculo, traço para espaço, cada
     * letra da primeira palavra para maiusculo e depois retirar espaços em branco
     *
     * @param string $slugController    Nome da classe
     * @return string    retorna a controller "view-users" convertido para o nome da Classe "ViewUsers"
     */
    
     private function slugController(string $slugController): string
    {
        $this->urlSlugController = $slugController;
        //converter tudo para minusculo
        $this->urlSlugController = strtolower($this->urlSlugController);
        //converter o traço para espaço em branco
        $this->urlSlugController = str_replace("-", " ", $this->urlSlugController);
        //converter a primeira letra de cada palavra para maiusculo
        $this->urlSlugController = ucwords($this->urlSlugController);
        //retirar o espaço em branco ...acho que so fez isso agora pra poder transformar as iniciais em maiuscula antes
        $this->urlSlugController = str_replace(" ", "", $this->urlSlugController);

        //var_dump($this->urlSlugController);
        return $this->urlSlugController;
    }

    /**
     * Tratar o método
     *Insstanciar o método que trata a controller
     *Converter a primeira letra para minusculo
     *  
     * @param string $urlSlugMetodo
     * @return string
     */
    private function slugMetodo(string $urlSlugMetodo): string
    {
        $this->urlSlugMetodo = $this->slugController($urlSlugMetodo);
        //Converter para minusculo a primeira letra
        $this->urlSlugMetodo = lcfirst( $this->urlSlugMetodo);
        //var_dump($this->urlSlugMetodo);

        return $this->urlSlugMetodo;
    }
    
}