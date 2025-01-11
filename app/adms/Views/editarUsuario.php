<?php

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

if(isset($this->data['form'])) {
    //var_dump($this->data['form']);
    $valorForm = $this->data['form'];
  
}
//var_dump($this->data['form']);
if(isset($this->data['form'][0])) {
    $valorForm = $this->data['form'][0];
    
}
?>

<!-- Inicio do conteudo do administrativo -->
<div class="wrapper">
    <div class="row">
        <div class="top-list">
            <span class="title-content">Editar Usuário</span>
            <div class="top-list-right">
                <?php
                echo "<a href='" . URLADM . "usuarios/index' class='btn-info'>Listar usuários</a> ";
               
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
            <span id="msg"></span>
        </div>

        <div class="content-adm">
            <form method="POST" action="" id="form-edit-user" class="form-adm">
                <?php
                $id = "";
                if (isset($valorForm['id'])) {
                    $id = $valorForm['id'];
                }
                ?>
                <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">

                <div class="row-input">
                    <div class="column">
                        <?php
                        $nome = "";
                        if (isset($valorForm['nome'])) {
                            $nome = $valorForm['nome'];
                        }
                        ?>
                        <label class="title-input">Nome:<span class="text-danger">*</span></label>
                        <input type="text" name="nome" id="nome" class="input-adm" placeholder="Digite o nome completo" value="<?php echo $nome; ?>" required>
                    </div>
                    
                </div>

                <div class="row-input">
                    <div class="column">
                        <?php
                        $email = "";
                        if (isset($valorForm['email'])) {
                            $email = $valorForm['email'];
                        }
                        ?>
                        <label class="title-input">E-mail:<span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="input-adm" placeholder="Digite o seu melhor e-mail" value="<?php echo $email; ?>" required>

                    </div>
                  
                </div>
				
				<div class="row-input">
                    <div class="column">
                        <?php
                        $senha = "";
                        if (isset($valorForm['senha'])) {
                            $senha = $valorForm['senha'];
                        }
                        ?>
                        <label class="title-input">Senha:<span class="text-danger">*</span></label>
                        <input type="password" name="senha" id="senha" class="input-adm" placeholder="Se quiser trocar sua senha digite aqui" value="<?php echo $senha; ?>" required>

                    </div>
                  
                </div>

              
             
                <p class="text-danger mb-5 fs-4">* Campo Obrigatório</p>

                <button type="submit" name="SendEditUser" class="btn-warning" value="Salvar">Salvar</button>

            </form>
        </div>
    </div>
</div>
<!-- Fim do conteudo do administrativo -->

       