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
    <script src="https://kit.fontawesome.com/f61e3910a0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="NoticiaTela.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        <div class="inferior_esquerdo">
                <div class="menu_topo">
                <?php foreach($categorias as $categoria){
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
                <?php foreach($categorias as $categoria): ?>
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
        <div class="inferior_direito_principal">
            <div class="noticia">
            <div class="alerta">
            <button id="alertaButton" type="button" data-noticia-id="<?php echo $noticiaEncontrada->getId(); ?>"><i class="fa-solid fa-triangle-exclamation fa-xl" style="color: #042b52;"></i></button>
            </div>
            <?php
                $categoria_noticia = new Categoria_noticia();
                $categoria_noticia->setId_noticia($noticiaEncontrada->getId());
                $categoria_nome = $categoria_noticia->getNome();
                ?>
                <nav>
                <div class="titulo">
                <h2><?php echo $noticiaEncontrada->getTitulo();?></h2>
                <button id="alertButton" type="button" data-noticia-id="<?php echo $noticiaEncontrada->getId(); ?>"><i class="fa-solid fa-triangle-exclamation fa-xl" style="color: #042b52;"></i></button>
                <br>
                </div>
                <div class="subtitulo">
                <p id="subtitulo"><?php echo $noticiaEncontrada->getSubtitulo(); ?></p>
                </div>
                <p id="data">
                        <?php echo $noticiaEncontrada->getData(); ?> &#8226; 
                        <a href='TelaCategoria.php?id=<?php echo $categoria_noticia->getCategoriaId(); ?>'><?php echo $categoria_nome; ?></a><?php $autorID = $noticiaEncontrada->getIdUsuario(); // Obtém o ID do autor
                                $nomeAutor = $noticiaEncontrada->pegaNomeAutor($autorID); // Obtém o nome do autor
                                if($nomeAutor){
                                echo $nomeAutor;} ?>
                </p>
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
    <script>
    $(document).ready(function() {
        $("#alertButton").on("click", function() {
            console.log("Clique no botão detectado");
            var noticiaId = $(this).data("noticia-id");

            $.ajax({
                type: "POST",
                url: "../controller/alerta.php",
                data: { id: noticiaId },
                success: function(response) {
                    alert("Seu alerta foi encaminhado para análise do administrador.");
                },
                error: function() {
                    alert("Erro ao alertar sobre a notícia");
                }
            });
        });
    });

    $(document).ready(function() {
        $("#alertaButton").on("click", function() {
            console.log("Clique no botão detectado");
            var noticiaId = $(this).data("noticia-id");

            $.ajax({
                type: "POST",
                url: "../controller/alerta.php",
                data: { id: noticiaId },
                success: function(response) {
                    alert("Seu alerta foi encaminhado para análise do administrador.");
                },
                error: function() {
                    alert("Erro ao alertar sobre a notícia");
                }
            });
        });
    });
    </script>
</body>
</html>
<?php else: header('Location: index.html'); endif;?>