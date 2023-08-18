<?php 
$acao = $_GET['acao'];
$idNoticia = $_GET['id'];

include_once '../model/conexao.php';

if ($acao == 'apagar'){
    $pdo = conexao();

    $sql = "DELETE FROM noticia WHERE id = $idNoticia";
    $sql = $pdo->prepare($sql);
    $sql->execute();
    header("Location:../view/TelaDenuncias.php");
} elseif ($acao == 'ignorar'){
    $pdo = conexao();

    $sql = "UPDATE noticia SET alerta = 0 WHERE id = $idNoticia";
    $sql = $pdo->prepare($sql);
    $sql->execute();
    header("Location:../view/TelaDenuncias.php");
}
?>