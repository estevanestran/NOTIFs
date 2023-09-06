<?php 

if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){

    include_once '../model/conexao.php';
    include_once '../model/Usuario.class.php';

    $u = new Usuario();
    
    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    if($u->login($email, $senha) == true){
        if(isset($_SESSION['id'])){
            header('Location: ../view/TelaPrincipal.php');
        } else {
            header('Location: ../view/index.html');
        }
    } else {        
        header('Location: ../view/index.html');
    }
} else {
    header('Location: ../view/index.html');
}

?>