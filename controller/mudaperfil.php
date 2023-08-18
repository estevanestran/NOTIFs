<?php 

include_once '../model/Usuario.class.php';

if(isset($_SESSION['id']) && !empty($_SESSION['id'])){

    if(isset($_POST['id']) && !empty($_POST['id'])){
        $usuario = new Usuario();
        $usuario->setId($_POST['id']);
        $usuario->setNome($_POST['nome']);
        $usuario->setSenha($_POST['senha']);
        $usuario->editar();
    }
}

header("Location: ../view/TelaPerfil.php");
?>