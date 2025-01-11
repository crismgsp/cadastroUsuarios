<?php

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

if(isset($this->data['form'])){
    $valorForm = $this->data['form'];
}

?>

<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Listar Usuários</span>
            <div class="top-list-right">
                <?php
               
                    echo "<a href='" . URLADM . "cadastrar-usuario/index' class='btn-success'>Cadastrar</a>";
                ?> 
            </div>
        </div>


        <div class="content-adm-alert">
            <?php
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>
        </div>
        <table class="table table-striped table-list">
            <thead class="list-head">
                <tr>
                    <th class="list-head-content">ID</th>
                    <th class="list-head-content">Nome</th>
                    <th class="list-head-content table-sm-none">E-mail</th>
                    <th class="list-head-content">Ações</th>
                </tr>
            </thead>
            <tbody class="list-body">
                <?php
                foreach ($this->data['listUsers'] as $user) {
                    extract($user);
                ?>
                    <tr>
                        <td class="list-body-content"><?php echo $id; ?></td>
                        <td class="list-body-content"><?php echo $nome; ?></td>
                        <td class="list-body-content table-sm-none"><?php echo $email; ?></td>
                       
                        <td class="list-body-content">
                            <div class="dropdown-action">
                                <button onclick="actionDropdown(<?php echo $id; ?>)" class="dropdown-btn-action">Ações</button>
                                <div id="actionDropdown<?php echo $id; ?>" class="dropdown-action-item">
                                   
                                    
                                 <?php    echo "<a href='" . URLADM . "editar-usuario/index/$id'>Editar</a>"; 
                                    
                                    echo "<a href='" . URLADM . "deletar-usuario/index/$id' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\")'>Apagar</a>";
                                    
                                    
                                    ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>

      
    </div>
</div>
