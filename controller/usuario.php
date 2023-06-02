<?php 
$acao = $_GET['acao'];
include_once '../model/Usuario.class.php';

if ($acao == 'cadastrar'){
    $usuario = new Usuario();
    $usuario->setNome($_POST['nome']);
    $usuario->setEmail($_POST['email']);
    $usuario->setSenha($_POST['senha']);
    $usuario->save();
    header('Location: ../view/TelaPrincipal.html ');
    } else if($acao == 'deletar') {
        Usuario::deletar($_REQUEST['id']);
    }
?>