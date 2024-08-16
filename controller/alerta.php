<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $idNoticia = $_POST['id'];

    include_once '../model/conexao.php';
    include_once '../model/Noticia.class.php';

    $pdo = conexao();

    $sql = "UPDATE noticia SET alerta = 1 WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $idNoticia, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        // Pode retornar algum JSON de sucesso, se necessário
    } else {
        // Pode retornar algum JSON de erro, se necessário
    }
} //teste
?> 