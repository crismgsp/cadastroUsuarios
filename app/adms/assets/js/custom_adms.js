
console.log("js importado");

//permitir retorno no navegador no formulário após o erro, email não cadastrado
if(window.history.replaceState){
    window.history.replaceState(null, null, window.location.href);
}

function actionDropdown(id) {
    closeDropdownAction();
    document.getElementById("actionDropdown" + id).classList.toggle("show-dropdown-action");
}

window.onclick = function(event) {
    if (!event.target.matches(".dropdown-btn-action")) {
        document.getElementById("actionDropdown").classList.remove("show-dropdown-action");
        closeDropdownAction();
    }
}

function closeDropdownAction() {
    var dropdowns = document.getElementsByClassName("dropdown-action-item");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i]
        if (openDropdown.classList.contains("show-dropdown-action")) {
            openDropdown.classList.remove("show-dropdown-action");
        }
    }
}

//selecionando os formularios que serão validados

const formAddUser = document.getElementById("form-add-user");
if(formAddUser){
    //ao receber o evento que no caso é ao ser apertado o botao de submit
    //so vai acessar este se tiver na pagina do newUser
    formAddUser.addEventListener("submit", async(e) =>{
        
        //Receber o valor do campo name, coloca # porque vai pegar o id pra buscar o valor do campo
        var nome = document.querySelector("#nome").value;   
        //verificar se o campo está vazio
        if(nome === ""){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessario preencher o campo nome</p>";
            return;
        }

        

        //Receber o valor do campo email, coloca # porque vai pegar o id pra buscar o valor do campo
        var email = document.querySelector("#email").value;   
        //verificar se o campo está vazio
        if(email === ""){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessario preencher o campo email</p>";
            return;
        }
        
        
        var senha = document.querySelector("senha").value;   
        //verificar se o campo está vazio
        if(senha === ""){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: Necessario digitar a senha</p>";
            return;
        }
        //Verificar se o campo senha possui 6 caracteres
        if(senha.lenght < 6){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p class='alert-danger'>Erro: A senha deve ter no minimo 6 caracteres</p>";
            return;
        }
        
    });    

} 

const formEditUser = document.getElementById("form-edit-user");
if(formEditUser){
    //ao receber o evento que no caso é ao ser apertado o botao de submit
    //so vai acessar este se tiver na pagina do newUser

    formEditUser.addEventListener("submit", async(e) =>{
        
        
        //Receber o valor do campo name, coloca # porque vai pegar o id pra buscar o valor do campo
        var nome = document.querySelector("#nome").value;   
        //verificar se o campo está vazio
        if(nome === ""){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style= 'color: #f00;'>Erro: Necessario preencher o campo nome</p>";
            return;
        }

        

        //Receber o valor do campo email
        var email = document.querySelector("#email").value;   
        //verificar se o campo está vazio
        if(email === ""){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style= 'color: #f00;'>Erro: Necessario preencher o campo email</p>";
            return;
        }

        //Receber o valor da senha
        var senha = document.querySelector("#senha").value;   
        //verificar se o campo está vazio
        if(senha === ""){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style= 'color: #f00;'>Erro: Necessario preenchera senha</p>";
            return;
        }
		
		 //Verificar se o campo senha possui 6 caracteres após edição
        if(senha.lenght < 6){
            e.preventDefault();
            document.getElementById("msg").innerHTML = "<p style= 'color: #f00;'>Erro: A senha deve ter no minimo 6 caracteres</p>";
            return;
        }
         
    });    

} 















