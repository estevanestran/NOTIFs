<?php 

include_once '../model/conexao.php';
include_once '../model/Noticia.class.php';
include_once 'verifica.php';

if (isset($_GET['termo_pesquisa'])) {
    $pdo = conexao();
    if($servidor){
    $termo_pesquisa = '%' . $_GET['termo_pesquisa'] . '%'; // Adicione % para corresponder a qualquer parte do título.

    // Construa a consulta SQL para encontrar notícias com o termo de pesquisa no título.
    $sql = "SELECT * FROM noticia WHERE titulo LIKE :termo_pesquisa";

    // Execute a consulta usando prepared statements.
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':termo_pesquisa', $termo_pesquisa, PDO::PARAM_STR);
    $stmt->execute();

    $resultados = $stmt->fetchAll(PDO::FETCH_CLASS, 'Noticia');

    // Agora, você tem os resultados da pesquisa em $resultados.
    } else {
        $termo_pesquisa = '%' . $_GET['termo_pesquisa'] . '%'; // Adicione % para corresponder a qualquer parte do título.

        // Construa a consulta SQL para encontrar notícias com o termo de pesquisa no título.
        $sql = "SELECT * FROM noticia WHERE titulo LIKE :termo_pesquisa";
    
        // Execute a consulta usando prepared statements.
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':termo_pesquisa', $termo_pesquisa, PDO::PARAM_STR);
        $stmt->execute();
    
        $resultados = $stmt->fetchAll(PDO::FETCH_CLASS, 'Noticia');
    
        // Agora, você tem os resultados da pesquisa em $resultados.
    }

    $_SESSION['resultados_pesquisa'] = $resultados;
    header('Location:../view/TelaPesquisa.php');
    exit();
}

?>