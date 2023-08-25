<?php 
include_once '../model/conexao.php';
if(isset($_SESSION['id']) && !empty($_SESSION['id'])):

include_once '../controller/verifica.php';
include_once '../model/Noticia.class.php';
include_once '../model/Categoria_noticia.class.php';
include_once '../model/Categoria.class.php';

if($servidor){
    $noticias = Noticia::getAll();
} else {
    $id = $_SESSION['id'];
    $noticias = Usuario::getNoticiaPorCurso($id);
}
$categorias = Categoria_noticia::getAll();
$categoriasMenu = Categoria::getAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f61e3910a0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="Principal.css">
    <script>
        function toggleMenu() {
        const mobileMenu = document.querySelector('.mobile-menu');
        mobileMenu.classList.toggle('show-menu');
        }
    </script>
    <title>Notifs</title>
</head>
<body>
    <div class="container">
        <div class="superior">
            <div class="superior_esquerdo">
                <a href="TelaPrincipal.php"><h1 class="nome_site">NOTIFs</h1></a>
            </div>
            <div class="menu-toggle" onclick="toggleMenu()">
                    <div class="bar"></div>
                    <div class="bar"></div>
                    <div class="bar"></div>
            </div>
            <div class="superior_direito">
                <a href="TelaPerfil.php"><h5><?php echo $nomeUser; ?>  <i class="fa-solid fa-user fa-lg" style="color: #d9d7d7;"></i></h5></a>
            </div>
        </div>
        <div class="inferior">
            <div class="pesquisa">
                <form action="TelaPesquisa.php" method="GET">
                  <button id="botao-pesquisa"><i class="fa fa-search"></i></button>
                  <input type="text" id="pesquisado" name="termo_pesquisa" class="form-control form-input" placeholder="Pesquise aqui">
                </form>
            </div>
            <div class="inferior_esquerdo">
                <div class="menu_topo">
                <?php foreach($categoriasMenu as $categoria){
                echo "<p><a id='menu' href='TelaCategoria.php?id=" . $categoria->getId() . "'>" . $categoria->getNome(); "</a></p>";
                }
                ?>
                </div>
                <div class="menu_baixo">
                    <?php if ($isComum): ?>
                    <p><a href="TelaPedir.php" id="pedido">Solicitar cargo</a></p>
                    <?php endif; ?>
                    <?php if ($isAdmin || $isPromoted): ?>
                    <p><a href="TelaPublicacao.php" id="escrever">Escrever notícia</a></p>
                    <p><a href="TelaMinhas.php" id="minhas">Minhas notícias</a></p>
                    <?php endif; ?>
                    <?php if ($isAdmin): ?>
                    <p><a href="TelaSolicitacoes.php" id="solicitacoes">Gerenciar cargos</a></p>
                    <p><a href="TelaDenuncias.php" id="denuncias">Denúncias</a></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mobile-menu">
            <div class="mobile-links">
                <!-- Coloque os links do menu aqui -->
                <a href="TelaPerfil.php"><h5><i class="fa-solid fa-user fa-lg" style="color: #042B52;"></i><?php echo $nomeUser; ?> </h5></a><br>
                <div class="opcoes">
                <?php foreach($categoriasMenu as $categoria): ?>
                    <p><a class="menu" href="TelaCategoria.php?id=<?php echo $categoria->getId(); ?>"><?php echo $categoria->getNome(); ?></a></p>
                <?php endforeach; ?>
                <div class="menu-baixo-mobile">
                <?php if ($isComum): ?>
                    <p><a class="menu" href="TelaPedir.php">Solicitar cargo</a></p>
                <?php endif; ?>
                <?php if ($isAdmin || $isPromoted): ?>
                    <p><a class="menu" href="TelaPublicacao.php">Escrever notícia</a></p>
                    <p><a class="menu" href="TelaMinhas.php">Minhas notícias</a></p>
                <?php endif; ?>
                <?php if ($isAdmin): ?>
                    <p><a class="menu" href="TelaSolicitacoes.php">Gerenciar cargos</a></p>
                    <p><a class="menu" href="TelaDenuncias.php">Denúncias</a></p>
                <?php endif; ?>
                </div>
                </div>
            </div>
            </div>
        </div>
        <div class="inferior_direito_principal">
            <div class="noticia">
                <?php foreach ($noticias as $noticia) {
                $categoria_noticia = new Categoria_noticia();
                $categoria_noticia->setId_noticia($noticia->getId());
                $categoria_nome = $categoria_noticia->getNome();
                
                ?>
                <?php echo "<a class='titulo' href='TelaNoticia.php?id=" . $noticia->getId() . "'><img src='" . $noticia->getFoto() . "'></a>"; ?>
                <nav>
                <section><a class='titulo' href='TelaNoticia.php?id=<?php echo $noticia->getId(); ?>'><?php echo $noticia->getTitulo(); ?></a></section>
                <article><p class="subtitulo"><?php echo $noticia->getSubtitulo(); ?></p></article>
                <aside><p class="data">
                        <?php echo $noticia->getData(); ?> &#8226; 
                        <a href='TelaCategoria.php?id=<?php echo $categoria_noticia->getCategoriaId(); ?>'><?php echo $categoria_nome; ?></a>
                        </p>
                </aside>
                </nav>
                <?php } ?>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
<?php else: header('Location: index.html'); endif;?>