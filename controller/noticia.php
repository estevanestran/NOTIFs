<?php 

$acao = $_GET['acao'];
include_once '../model/Noticia.class.php';
include_once '../model/Curso_noticia.class.php';
include_once '../model/Categoria_noticia.class.php';
include_once '../model/Usuario.class.php';

if($acao=='publicar'){
    //$ultimoUsuario = $usuario->getId();

    $noticia = new Noticia();
    $noticia->setTitulo($_POST['titulo']);
    $noticia->setSubtitulo($_POST['subtitulo']);
    $noticia->setCorpo($_POST['corpo']);
    $noticia->setData($noticia->getCurrentDate());
    //$noticia->setIdUsuario($_POST[$ultimoUsuario]);
    $noticia->save();

    $ultimoID = $noticia->getId();
    var_dump($noticia);

}
?>