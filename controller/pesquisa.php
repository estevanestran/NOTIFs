<?php 

include_once '../model/conexao.php';
include_once '../model/Noticia.class.php';
include_once 'verifica.php';

$resultados=[];

if (isset($_GET['termo_pesquisa'])) {
    $pdo = conexao();
    if($servidor){
    $termo_pesquisa = '%' . $_GET['termo_pesquisa'] . '%'; // Adicione % para corresponder a qualquer parte do título.

    // Construa a consulta SQL para encontrar notícias com o termo de pesquisa no título.
    $sql = "SELECT * FROM noticia WHERE titulo LIKE :termo_pesquisa OR corpo LIKE :termo_pesquisa OR subtitulo LIKE :termo_pesquisa ORDER BY id DESC";

    // Execute a consulta usando prepared statements.
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':termo_pesquisa', $termo_pesquisa);
    $stmt->execute();

    $query = $stmt->fetchAll(); 
    foreach ($query as $linha){
        $timestamp = strtotime($linha['data_noticia']);
        $noticia = new Noticia();
        $noticia->setTitulo($linha['titulo']);
        $noticia->setSubtitulo($linha['subtitulo']);
        $noticia->setCorpo($linha['corpo']);
        $noticia->setId($linha['id']);
        $noticia->setData(date('d-m-Y', $timestamp));
        $noticia->setIdUsuario($linha['id_usuario']);
        $noticia->setFoto($linha['foto']);
        $noticia->setAlerta($linha['alerta']);
        $resultados[] = $noticia;
    }
    } else {
        $termo_pesquisa = '%' . $_GET['termo_pesquisa'] . '%';
        $id = $_SESSION['id'];
        $sql = "SELECT * FROM noticia WHERE titulo LIKE :termo_pesquisa OR corpo LIKE :termo_pesquisa OR subtitulo LIKE :termo_pesquisa AND id IN (SELECT id_noticia FROM curso_noticia WHERE id_curso = (SELECT id_curso FROM usuario WHERE id = :id)) ORDER BY id DESC";
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':termo_pesquisa', $termo_pesquisa);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    
        $query = $stmt->fetchAll(); 
        foreach ($query as $linha){
            $timestamp = strtotime($linha['data_noticia']);
            $noticia = new Noticia();
            $noticia->setTitulo($linha['titulo']);
            $noticia->setSubtitulo($linha['subtitulo']);
            $noticia->setCorpo($linha['corpo']);
            $noticia->setId($linha['id']);
            $noticia->setData(date('d-m-Y', $timestamp));
            $noticia->setIdUsuario($linha['id_usuario']);
            $noticia->setFoto($linha['foto']);
            $noticia->setAlerta($linha['alerta']);
            $resultados[] = $noticia;
        }
    }

}

?>