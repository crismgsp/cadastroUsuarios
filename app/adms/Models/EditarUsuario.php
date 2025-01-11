<?php


    /** 
     * @var $data recebe os dados que devem ser enviados para a view ..o que ta comentado so funciona no php 8 desta forma*/  
    private $data;
    
    /**  @var $dataform recebe os dados do formulario de cadastro*/
    private $dataForm;

    /**  @var $id recebe o id do registro/usuario*/
    private $id;



    public function index($id): void
    {
        //recebe os dados digitados pelo usuario na edicao
        $this->dataForm = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        //se o id for diferente de vazio e o botao para enviar os dados de edicao do usuario não foi clicado
        if((!empty($id)) and (empty($this->dataForm['SendEditUser']))){
            $this->id = (int) $id;
            $viewUser= new \App\adms\Models\AdmsEditUsers();
            $viewUser->viewUser($this->id);
            if($viewUser->getResult()){
                $this->data['form'] = $viewUser->getResultBd();
                //var_dump($this->data['form'][0]['name']);
                //após confirmar que os dados relativos a este id foram recebidos do banco de dados instancia a view relativa a edicao de dados
                $this->viewEditUser();
            }else{
                $urlRedirect = URLADM . "list-users/index";
                header("Location: $urlRedirect");
                
            }  

        } else{
            //$_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado</p>";
            //$urlRedirect = URLADM . "list-users/index";
            //header("Location: $urlRedirect");
            $this->editUser();
        }
    }    


    //este pedaço abaixo é para carregar a pagina relacionada a esta controller que é a editUsers
    private function viewEditUser(): void
    {
        $select = new \App\adms\Models\AdmsEditUsers();
        $this->data['select'] = $select->listSelect();

        
        $listMenu = new \App\adms\Models\helper\AdmsMenu();
        $this->data['menu'] = $listMenu->itemMenu();

        $loadView = new \Core\ConfigView("adms/Views/users/editUsers", $this->data);
        $loadView->loadView(); 
    }

    private function editUser(): void
    {
        //se o usuario clicou no botao daquele formulario acessa o if, caso contrario acesse o else
        if(!empty($this->dataForm['SendEditUser'])){
            unset($this->dataForm['SendEditUser']);
            //instancia a model responsavel por editar no banco de dados
            $editUser = new \App\adms\Models\AdmsEditUsers();
            $editUser->update($this->dataForm);
            if($editUser->getResult()){
                $urlRedirect = URLADM . "view-users/index/" . $this->dataForm['id'];  //arrumei aqui
                header("Location: $urlRedirect");
            }else{
                //caso nao retorne true mantem os dados digitados no formulario e carrrega a view
                $this->data['form'] = $this->dataForm;
                $this->viewEditUser();
            }

        }else{
            $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuário não encontrado EditUsers linha 84</p>";
            $urlRedirect = URLADM . "list-users/index";
            header("Location: $urlRedirect");
        } 
    }
        
        
}