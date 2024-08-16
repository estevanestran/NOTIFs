<?php 
include_once '../model/conexao.php';
if(isset($_SESSION['id']) && !empty($_SESSION['id'])):

include_once '../controller/verifica.php';

if ($isAdmin || $isPromoted){
include_once '../model/Noticia.class.php';
include_once '../model/Categoria.class.php';

$categorias = Categoria::getAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="PublicacaoTela.css">
    <script
      src="https://cdn.tiny.cloud/1/p6cepsntwtf4gffjxl409dppeu7zzg5e0hrohycxu9ldemig/tinymce/6/tinymce.min.js"
      referrerpolicy="origin"
    ></script>
    <script src="https://kit.fontawesome.com/f61e3910a0.js" crossorigin="anonymous"></script>
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
                <a href="TelaPrincipal.php"><h1 class="nome_site">NOTIFs</h1></a>
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
            <div class="inferior_direito">
              <form action="../controller/noticia.php?acao=publicar" method="post" enctype="multipart/form-data">
                <label for="titulo">TÍTULO DA NOTÍCIA</label><br>
                  <input type="text" id="titulo" name="titulo" required> <br><br>
                <label for="subtitulo">SUBTÍTULO DA NOTÍCIA</label><br>
                  <input type="text" id="subtitulo" name="subtitulo"> <br><br>
                <label for="corpo">CORPO DA NOTÍCIA</label><br>
                <textarea id="corpo" name="corpo"></textarea>
                <br>
                <label for="curso" style="color: #042B52; font-size: larger;">CURSOS ALVO</label><br>
                <input class="caixas" type="checkbox" name="curso[]" value="Administração"><label for="curso" class="nomecurso">ADM</label>
                <input class="caixas" type="checkbox" name="curso[]" value="Desenvolvimento de sistemas"><label for="curso" class="nomecurso">DS</label>
                <input class="caixas" type="checkbox" name="curso[]" value="Eletrônica"><label for="curso" class="nomecurso">Eletrônica</label>
                <input class="caixas" type="checkbox" name="curso[]" value="Engenharia eletrônica"><label for="curso" class="nomecurso">EngEle</label>
                <br>
                <input class="caixas" type="checkbox" name="curso[]" value="Análise e desenvolvimento de sistemas"><label for="curso" class="nomecurso">TADS</label>
                <input class="caixas" type="checkbox" name="curso[]" value="Logística"><label for="curso" class="nomecurso">Logística</label>
                <input class="caixas" type="checkbox" name="curso[]" value="Matemática"><label for="curso" class="nomecurso">Matemática</label>
                <br>
                <input class="caixas" type="checkbox" name="curso[]" value="Comércio"><label for="curso" class="nomecurso">Comércio</label>
                <input class="caixas" type="checkbox" name="curso[]" value="Manutenção e suporte em informática"><label for="curso" class="nomecurso">TMSI</label>
                <input class="caixas" type="checkbox" name="curso[]" value="Gestão de projetos e inovação"><label for="curso" class="nomecurso">GPI</label>
                <input class="caixas" type="checkbox" name="curso[]" value="Educação: integração de saberes"><label for="curso" class="nomecurso">EIS</label>
                <br>
                <input class="caixas" type="checkbox" name="curso[]" value="Linguagens contemporâneas e ensino"><label for="curso" class="nomecurso">LCE</label>
                <input class="caixas" type="checkbox" name="curso[]" value="Automação industrial"><label for="curso" class="nomecurso">TAI</label>
                <input class="caixas" type="checkbox" name="curso[]" value="PROFMAT"><label for="curso" class="nomecurso">PROFMAT</label>
                <br>
                <label for="categoria">CATEGORIA DA NOTÍCIA</label>
                <select name="categoria" id="categoria" required>
                  <option value="">Selecione...</option>
                  <option value="Auxílios">Auxílios</option>
                  <option value="Bolsas">Bolsas</option>
                  <option value="Comunicados">Comunicados</option>
                  <option value="Cursos">Cursos</option>
                  <option value="Editais">Editais</option>
                  <option value="Eventos">Eventos</option>
                  <option value="Oportunidades">Oportunidades</option>
                </select>
                <br>
                <label for="foto">IMAGEM DE CAPA</label>
                <input type="file" id="foto" name="foto">
                <input type="hidden" id="id" name="id">
                <input type="hidden" id="alerta" name="alerta" value="0">
                <input type="submit" id="botao" value="PUBLICAR" onclick="validarFormulario(event)">
              </form>
            </div>
    </div>
    <script>
        tinymce.init({
        height: 500,
        menubar: false,
        selector: 'textarea',
        plugins: 'anchor autolink charmap codesample emoticons link lists searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | charmap | removeformat',
        })
    </script>

<script>
  function validarFormulario(event) {
    var checkboxes = document.getElementsByName("curso[]");
    var selecionado = false;

    for (var i = 0; i < checkboxes.length; i++) {
      if (checkboxes[i].checked) {
        selecionado = true;
        break;
      }
    }

    if (!selecionado) {
      event.preventDefault();
      alert("Selecione pelo menos um curso!");
      return;
    }
  }
</script>
        </div>
    </div>
</body>
</html>
<?php } else {
  header('Location: TelaPrincipal.php');
}?>
<?php else: header('Location: index.html'); endif;?>