<?php 
include_once '../model/Noticia.class.php';
include_once '../model/Categoria_noticia.class.php';

$noticias = Noticia::getAll();
$categorias = Categoria_noticia::getAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="PrincipalTela.css">
    <title>Notifs</title>
</head>
<body>
    <div class="container">
        <div class="superior">
            <div class="superior_esquerdo">
                <a href="TelaPrincipal.php"><h1 class="nome_site">NOTIFs</h1></a>
            </div>
            <div class="superior_direito">
                <a href="TelaPerfil.html"><h5>Nome usuário</h5></a>
            </div>
        </div>
    <div class="inferior">
            <div class="inferior_esquerdo">
                <p id="menu">Auxílios<br>Bolsas<br>Comunicados<br>Cursos<br>Editais<br>Eventos<br>Oportunidades<br><br><br><br><br><br><br><br><br><br><br><br><a href="TelaPublicacao.php" id="escrever" >Escrever notícia</a><br><a href="TelaPublicacao.php" id="escrever">Minhas notícias</a><br>Favoritos<img src="bookmarkSF.png" id="bookmarkSF"></p>
            </div>
            <!-- COMANDO DE OCULTAMENTO DAS OPÇÕES ECREVER E MINHAS NOTÍCIAS (ANTES TAVA FUNCIONANDO MAS PAROU POR ALGUM MOTIVO) 
            < ?php session_start(); echo isset($_SESSION['usuario_comum']) && $_SESSION['usuario_comum'] ? 'style="display: inline;"' : 'style="display: none;"'; ?> 
            < ?php echo isset($_SESSION['usuario_comum']) && $_SESSION['usuario_comum'] ? 'style="display: inline;"' : 'style="display: none;"'; ?>-->
            <div class="pesquisa">
                
            </div>
        <div class="foto">
            <?php foreach ($noticias as $noticia){?>
                <img src="cor-marrom.jpg" id="marrom">
                <br>
                <br>
            <?php }?>
        </div>
        <div class="inferior_direito_principal">
            <div class="noticia">
            <?php foreach ($noticias as $noticia){?>
              <section><h2><?php echo $noticia->getTitulo(); ?></h2></section>
              <article><p id="subtitulo"><?php echo $noticia->getSubtitulo(); ?></p></article>
              <aside><p id="data"><?php echo $noticia->getData(); ?></p></aside>
              <br><br>
            <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>