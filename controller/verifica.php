<?php 

if(isset($_SESSION['id']) && !empty($_SESSION['id'])){

    include_once '../model/Usuario.class.php';
    $u = new Usuario();

    $listlogged = $u->pegaNome($_SESSION['id']);
    $nomeUser = $listlogged['nome'];

    $listlogged = $u->pegaEmail($_SESSION['id']);
    $emailUser = $listlogged['email'];

    $listlogged = $u->pegaNomeCurso($_SESSION['id']);
    $cursoUser = $listlogged['nome'];

    $userState = $u->pegaEstado($_SESSION['id']);
    $isAdmin = $userState === 'administrador';
    $isPromoted = $userState === 'promovido';
    $isComum = $userState === 'comum';

    $pedidoUser = $u->pegaPedido($_SESSION['id']);
    $naoPediu = $pedidoUser == 0;
    $pediu = $pedidoUser == 1;
}
?>