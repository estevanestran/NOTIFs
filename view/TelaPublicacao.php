<?php 
include_once '../model/Noticia.class.php';
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
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.tiny.cloud/1/p6cepsntwtf4gffjxl409dppeu7zzg5e0hrohycxu9ldemig/tinymce/6/tinymce.min.js"
      referrerpolicy="origin"
    ></script>
    <script src="https://cdn.jsdelivr.net/npm/@tinymce/tinymce-jquery@2/dist/tinymce-jquery.min.js"></script>
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
                <p id="menu">Auxílios<br>Bolsas<br>Comunicados<br>Cursos<br>Editais<br>Eventos<br>Oportunidades<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><a href="TelaPublicacao.php" id="escrever" <?php session_start(); echo isset($_SESSION['usuario_comum']) && $_SESSION['usuario_comum'] ? 'style="display: inline;"' : 'style="display: none;"'; ?>>Escrever notícia</a><br><a href="TelaPublicacao.php" id="escrever" <?php echo isset($_SESSION['usuario_comum']) && $_SESSION['usuario_comum'] ? 'style="display: inline;"' : 'style="display: none;"'; ?>>Minhas notícias</a><br>Favoritos<img src="bookmarkSF.png" id="bookmarkSF"></p>
            </div>
            <div class="inferior_direito">
              <form action="../controller/noticia.php?acao=publicar" method="post">
                <label for="titulo">TÍTULO DA NOTÍCIA</label><br>
                  <input type="text" id="titulo" name="titulo"> <br><br>
                <label for="subtitulo">SUBTÍTULO DA NOTÍCIA</label><br>
                  <input type="text" id="subtitulo" name="subtitulo"> <br><br>
                <label for="corpo">CORPO DA NOTÍCIA</label><br>
                <textarea id="corpo" name="corpo" style="width: 85%;"></textarea>
                <br>
                <label for="categoria">CATEGORIA DA NOTÍCIA</label>
                <select name="categoria" id="categoria">
                  <option value="">Selecione...</option>
                  <option value="Auxilios">Auxílios</option>
                  <option value="Bolsas">Bolsas</option>
                  <option value="Comunicados">Comunicados</option>
                  <option value="Cursos">Cursos</option>
                  <option value="Editais">Editais</option>
                  <option value="Eventos">Eventos</option>
                  <option value="Oportunidades">Oportunidades</option>
                </select>
                <br><br>
                <label for="imagem">IMAGEM DE CAPA</label>
                <input type="file">
                <fieldset>
                <label for="curso" style="color: #042B52; font-size: larger;">CURSOS ALVO</label><br>
                <input class="caixas" type="checkbox" name="curso" value="ADM"><label for="curso">ADM</label>
                <input class="caixas" type="checkbox" name="curso" value="DS"><label for="curso">DS</label>
                <input class="caixas" type="checkbox" name="curso" value="Eletronica"><label for="curso">Eletrônica</label>
                <input class="caixas" type="checkbox" name="curso" value="EngEle"><label for="curso">EngEle</label>
                <br>
                <input class="caixas" type="checkbox" name="curso" value="TADS"><label for="curso">TADS</label>
                <input class="caixas" type="checkbox" name="curso" value="Logistica"><label for="curso">Logística</label>
                <input class="caixas" type="checkbox" name="curso" value="Matematica"><label for="curso">Matemática</label>
                <br>
                <input class="caixas" type="checkbox" name="curso" value="Comercio"><label for="curso">Comércio</label>
                <input class="caixas" type="checkbox" name="curso" value="TMSI"><label for="curso">TMSI</label>
                <input class="caixas" type="checkbox" name="curso" value="GPI"><label for="curso">GPI</label>
                <input class="caixas" type="checkbox" name="curso" value="EIS"><label for="curso">EIS</label>
                <br>
                <input class="caixas" type="checkbox" name="curso" value="LCE"><label for="curso">LCE</label>
                <input class="caixas" type="checkbox" name="curso" value="PROFMAT"><label for="curso">PROFMAT</label>
                </fieldset> <br><br><br><br>
                <input type="hidden" id="id" name="id">
                <input type="submit" id="botao" value="PUBLICAR" onclick="validarFormulario()">
              </form>
            </div>
    </div>
    <script>
      $('textarea#corpo').tinymce({
        height: 500,
        menubar: false,
        plugins: [
          'advlist', 'autolink', 'link', 'lists', 'image', 'charmap', 'preview',
          'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
          'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic backcolor | ' +
          'alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist outdent indent | removeformat | help'
      });
    </script>

<script>
  function validarFormulario() {
    var checkboxes = document.getElementsByName("curso");
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