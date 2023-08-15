<?php 
$acao = $_GET['acao'];
$idUsuario = $_GET['id'];

include_once '../model/conexao.php';

if ($acao == 'aprovar'){
    $pdo = conexao();

    $sql = "UPDATE usuario SET estado = 'promovido' WHERE id = $idUsuario";
    $sql = $pdo->prepare($sql);
    $sql->execute();
    $sql = "UPDATE usuario SET pedido = 0 WHERE id = $idUsuario";
    $sql = $pdo->prepare($sql);
    $sql->execute();
    header("Location:../view/TelaSolicitacoes.php");
} elseif ($acao == 'negar'){
    $pdo = conexao();

    $sql = "UPDATE usuario SET pedido = 0 WHERE id = $idUsuario";
    $sql = $pdo->prepare($sql);
    $sql->execute();
    header("Location:../view/TelaSolicitacoes.php");
} elseif ($acao == 'remover'){
    $pdo = conexao();

    $sql = "UPDATE usuario SET estado = 'comum' WHERE id = $idUsuario";
    $sql = $pdo->prepare($sql);
    $sql->execute();
    header("Location:../view/TelaSolicitacoes.php");
}
?>