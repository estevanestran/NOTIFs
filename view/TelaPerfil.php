<?php 
include_once '../model/conexao.php';
if(isset($_SESSION['id']) && !empty($_SESSION['id'])):

include_once '../controller/verifica.php';
include_once '../model/Categoria.class.php';

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
    <link rel="stylesheet" href="PerfilTela.css">
    <script>
        function habilitarEdicao() {
    var senhaElement = document.getElementById("senha");
    var nomeElement = document.getElementById("nome");
    var labelSenhaElement = document.getElementById("labelsenha");
    var botaoElement = document.getElementById("botao");
    
    if (senhaElement.style.display === "none") {
        nomeElement.removeAttribute("readonly");
        senhaElement.style.display = "block";
        labelSenhaElement.style.display = "block";
        botaoElement.style.display = "block";
    } else {
        nomeElement.setAttribute("readonly", true);
        senhaElement.style.display = "none";
        labelSenhaElement.style.display = "none";
        botaoElement.style.display = "none";

        nomeElement.value = "<?php echo $nomeUser; ?>";
        senhaElement.value = "";
    }
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
            <div class="superior_direito">
                <a href="TelaPerfil.php"><h5><?php echo $nomeUser; ?>  <i class="fa-solid fa-user fa-lg" style="color: #d9d7d7;"></i></h5></a>
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
                    <?php if ($isAdmin || $isPromoted): ?>
                    <p><a href="TelaPublicacao.php" id="escrever">Escrever notícia</a></p>
                    <p><a href="TelaPublicacao.php" id="minhas">Minhas notícias</a></p>
                    <?php endif; ?>
                    <?php if ($isAdmin): ?>
                    <p><a href="TelaSolicitacoes.php" id="solicitacoes">Gerenciar cargos</a></p>
                    <p><a href="TelaDenuncias.php" id="denuncias">Denúncias</a></p>
                    <?php endif; ?>
                </div>
            </div>
        <div class="inferior_direito_principal">
            <div class="perfil">
            <h2>MEU PERFIL</h2>
                <button id="editar" onclick="habilitarEdicao()">Editar perfil</button>
                <form action="../controller/mudaperfil.php" method="POST">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                    <label for="nome">Nome completo</label><br>
                    <input type="text" id="nome" name="nome" placeholder="<?php echo $nomeUser; ?>" readonly><br>
                    <label for="email">E-mail institucional</label><br>
                    <input type="text" id="email" name="email" placeholder="<?php echo $emailUser; ?>" readonly><br>
                    <label for="curso" id="labelcurso">Curso</label><br>
                    <input type="text" id="curso" name="curso" placeholder="<?php echo $cursoUser; ?>" readonly><br>
                    <label for="senha" id="labelsenha" style="display: none;">Senha</label>
                    <input type="password" id="senha" name="senha" style="display: none;"><br>
                    <input type="submit" id="botao" value="Salvar mudanças" style="display: none;">
                </form>
                <a href="../controller/logout.php">Sair</a>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
<?php else: header('Location: index.html'); endif;?>