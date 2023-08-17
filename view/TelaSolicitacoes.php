<?php 
include_once '../model/conexao.php';
if(isset($_SESSION['id']) && !empty($_SESSION['id'])):

include_once '../controller/verifica.php';

if ($isAdmin) {
include_once '../model/Categoria.class.php';
include_once '../model/Usuario.class.php';

$categoriasMenu = Categoria::getAll();
$usuarios = Usuario::getPedidos();
$promovidos = Usuario::getPromovidos();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/f61e3910a0.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="SolicitacoesTela.css">
    <title>Notifs</title>
</head>
<body>
    <div class="container">
        <div class="superior">
            <div class="superior_esquerdo">
                <a href="TelaPrincipal.php"><h1 class="nome_site">NOTIFs</h1></a>
            </div>
            <div class="superior_direito">
                <a href="TelaPerfil.html"><h5><?php echo $nomeUser; ?>  <i class="fa-solid fa-user fa-lg" style="color: #d9d7d7;"></i></h5></a>
            </div>
        </div>
        <div class="inferior">
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
                    <?php if ($isAdmin): ?>
                    <p><a href="TelaSolicitacoes.php" id="solicitacoes">Gerenciar cargos</a></p>
                    <p><a href="TelaDenuncias.php" id="denuncias">Denúncias</a></p>
                    <?php endif; ?>
                    <?php if ($isAdmin || $isPromoted): ?>
                    <p><a href="TelaPublicacao.php" id="escrever">Escrever notícia</a></p>
                    <p><a href="TelaPublicacao.php" id="minhas">Minhas notícias</a></p>
                    <?php endif; ?>
                </div>
            </div>
        <div class="inferior_direito_principal">
            <h2>Solicitações de promoção</h2>
            <div class="pedidos">
                <?php foreach ($usuarios as $usuario) {?>
                    <div class="pedido">
                            <p class="nome">
                                <?php echo "<strong>Nome:</strong> " . $usuario->getNome() . " (" . $usuario->getEmail() . ") " . $usuario->getNomeCurso();?>
                                <div class="links">
                                <?php echo "<a class='acao' href='../controller/cargos.php?acao=aprovar&id=" . $usuario->getId() . "'>Aprovar</a>" ?>
                                <?php echo "<a class='acao' href='../controller/cargos.php?acao=negar&id=" . $usuario->getId() . "'>Negar</a>" ?>
                                </div>
                            </p>
                    </div>
                <?php } ?>
            </div>
            <h2>Usuários promovidos</h2>
            <div class="promovidos">
                    <?php foreach ($promovidos as $usuario) {?>
                        <div class="pedido">
                            <p class="nome">
                            <?php echo "<strong>Nome:</strong> " . $usuario->getNome() . " (" . $usuario->getEmail() . ") " . $usuario->getNomeCurso();?>
                            <div class="links">
                            <?php echo "<a class='acao' href='../controller/cargos.php?acao=remover&id=" . $usuario->getId() . "'>Remover</a>" ?>
                            </div>
                            </p>
                        </div>
                    <?php } ?>
                    
            </div>
        </div>
    </div>
    </div>
</body>
</html>
<?php } else {
  header('Location: TelaPrincipal.php');
}?>
<?php else: header('Location: index.html'); endif;?>