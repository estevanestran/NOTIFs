<?php
include_once '../model/conexao.php';
if(isset($_SESSION['id']) && !empty($_SESSION['id'])):

    include_once '../controller/verifica.php';
include_once '../model/Noticia.class.php';
include_once '../model/Categoria_noticia.class.php';
include_once '../model/Categoria.class.php';


$categorias = Categoria::getAll();

if (isset($_GET['id'])){
    $noticiaId = $_GET['id'];

    $noticia = new Noticia();
    
    try{

        $noticiaEncontrada = $noticia->buscarNoticiaPorId($noticiaId);
        
        if($noticiaEncontrada){
        } else {
            echo "Notícia não encontrada.";
        }
    } catch (PDOException $e) {
        // Caso ocorra algum erro na conexão ou na busca, exibir a mensagem de erro
        echo "Erro na conexão com o banco de dados: " . $e->getMessage();
    }
} else {
    echo 'Não há ID.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="Noticia.css">
    <title>Notifs</title>
</head>
<body>
<div class="container">
        <div class="superior">
            <div class="superior_esquerdo">
                <a href="TelaPrincipal.php"><h1 class="nome_site">NOTIFs</h1></a>
            </div>
            <div class="superior_direito">
                <a href="TelaPerfil.html"><h5><?php echo $nomeUser; ?></h5></a>
            </div>
        </div>
        <div class="inferior">
            <div class="inferior_esquerdo">
                <div class="menu_topo">
                <?php foreach($categorias as $categoria){
                echo "<p><a id='menu' href='TelaCategoria.php?id=" . $categoria->getId() . "'>" . $categoria->getNome(); "</a></p>";
                }
                ?>
                </div>
                <div class="menu_baixo">
                <a href="TelaPublicacao.php" id="escrever" >Escrever notícia</a><p><a href="TelaPublicacao.php" id="escrever">Minhas notícias</a></p>
                </div>
            </div>
            <!-- COMANDO DE OCULTAMENTO DAS OPÇÕES ECREVER E MINHAS NOTÍCIAS (ANTES TAVA FUNCIONANDO MAS PAROU POR ALGUM MOTIVO) 
            < ?php session_start(); echo isset($_SESSION['usuario_comum']) && $_SESSION['usuario_comum'] ? 'style="display: inline;"' : 'style="display: none;"'; ?> 
            < ?php echo isset($_SESSION['usuario_comum']) && $_SESSION['usuario_comum'] ? 'style="display: inline;"' : 'style="display: none;"'; ?>-->
            <!--<div class="foto">
            </div>-->
        <div class="inferior_direito_principal">
            <div class="noticia">
            <?php
                $categoria_noticia = new Categoria_noticia();
                $categoria_noticia->setId_noticia($noticiaEncontrada->getId());
                $categoria_nome = $categoria_noticia->getNome();
                ?>
                <nav>
                <?php echo "<h2 id='titulo'>" . $noticiaEncontrada->getTitulo(); "</h2>"?>
                <p id="subtitulo"><?php echo $noticiaEncontrada->getSubtitulo(); ?></p>
                <p id="data"><?php echo $noticiaEncontrada->getData(); ?> &#8226; <?php echo $categoria_nome; ?></p>
                <div class="imagem">
                    <?php echo "<img src='" . $noticiaEncontrada->getFoto() . "'>"; ?>
                </div>
                <div class="corpo">
                <h6><?php echo $noticiaEncontrada->getCorpo(); ?></h6>
                </nav>
                </div>
            </div>

        </div>
    </div>
</body>
</html>
<?php else: header('Location: index.html'); endif;?>