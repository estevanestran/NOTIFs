<?php
session_start();
if(isset($_SESSION['id']) && !empty($_SESSION['id'])){

    include_once '../model/Usuario.class.php';
    $u = new Usuario();

    $pedidoUser = $u->pegaPedido($_SESSION['id']);
    $naoPediu = $pedidoUser == 0;
    $pediu = $pedidoUser == 1;

    if ($naoPediu) {
        $pdo = conexao();
        $sql = "UPDATE usuario SET pedido = 1 WHERE id = :id";
        $sql = $pdo->prepare($sql);
        $sql->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
        $sql->execute();
        header("Location:../view/TelaPrincipal.php");
    } else {
        header("Location:../view/TelaPrincipal.php");
    }
}
?>