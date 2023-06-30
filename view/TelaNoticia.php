<?php
include_once '../model/Noticia.class.php';
include_once '../model/Categoria_noticia.class.php';

$noticias = Noticia::getAll();
$categorias = Categoria_noticia::getAll();
var_dump($noticia);
?>