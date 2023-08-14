<?php 

if(isset($_SESSION['id']) && !empty($_SESSION['id'])){

    include_once '../model/Usuario.class.php';
    $u = new Usuario();

    $listlogged = $u->pegaNome($_SESSION['id']);

    $nomeUser = $listlogged['nome'];

    $listlogged = $u->pegaEstado($_SESSION['id']);

    $userState = $u->pegaEstado($_SESSION['id']);

    $isAdmin = $userState === 'administrador';

    $isPromoted = $userState === 'promovido';

    $isComum = $userState === 'comum';
}
?>