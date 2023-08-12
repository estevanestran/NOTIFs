<?php 

if(isset($_SESSION['id']) && !empty($_SESSION['id'])){

    include_once '../model/Usuario.class.php';
    $u = new Usuario();

    $listlogged = $u->pegaNome($_SESSION['id']);

    $nomeUser = $listlogged['nome'];
}
?>