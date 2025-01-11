<?php

if(!defined('CONST123TESTE')){
    //pausa o processamento se nao tiver passado pelo arquivo index..se tentar acessar direto pelo caminho...
    die("Erro: pagina não encontrada");
}

if(isset($this->data['form'])) {
    $valorForm = $this->data['form'];
    
}

?>

    <div class="wrapper">
        <div class="row">
            <div class="top-list">
                <span class="title-content">Cadastrar Usuário</span>
                <div class="top-list-right">
                <?php
                echo "<a href='" . URLADM . "usuarios/index' class='btn-info'>Listar</a> ";
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
                <form method="POST" action="" id="form-add-user" class="form-adm">
                    <div class="row-input">
                        <div class="column">
                        <?php 
                        $nome = "";
                        if(isset($valorForm['nome'])){
                             $nome = $valorForm['nome'];
                            }
                        ?>
                            <label class="title-input">Nome: <span class="text-danger">*</span></label>
                            <input type="text" name="nome" id="nome" class="input-adm" placeholder="Digite o nome completo" value="<?php echo $nome; ?>"
                            required>
                        </div>
                        <?php 
                        $email = "";
                            
                        if(isset($valorForm['email'])){
                            $email= $valorForm['email'];
                        }    ?>
                        <div class="column">
                            <label class="title-input">E-mail: <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="input-adm" placeholder="Digite o melhor e-mail" value="<?php echo $email; ?>"
                            required>
                        </div>
                    </div>                        
             
                        <?php 
                        $senha = "";
                            
                        if(isset($valorForm['senha'])){
                            $senha = $valorForm['senha'];
                        } ?>     
                            
                        <div class="column">
                            <label class="title-input">Senha: <span class="text-danger">*</span></label>
                            <input type="password" name="senha" id="senha" class="input-adm" placeholder="Digite a senha"
                            onkeyup="passwordStrength()" autocomplete= "on" value="<?php echo $senha; ?>" required>
                            <span id="msgViewStrength"><br><br></span>
                        </div>
                    </div>

                    <button type="submit" name="NovoUsuario" class="btn-success" value="Cadastrar">Cadastrar</button>                        
                        
                </form>
            </div>
        </div>
    </div>
        
