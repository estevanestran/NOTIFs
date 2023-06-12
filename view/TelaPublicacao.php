<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="Publicacao.css">
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js"
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
                <p id="menu">Auxílios<br>Bolsas<br>Comunicados<br>Cursos<br>Editais<br>Eventos<br>Oportunidades<br><br><br><br><br><br><br><br><br><br><br><br><a href="TelaPublicacao.php" id="escrever" <?php session_start(); echo isset($_SESSION['usuario_comum']) && $_SESSION['usuario_comum'] ? 'style="display: inline;"' : 'style="display: none;"'; ?>>Escrever notícia</a><br><a href="TelaPublicacao.php" id="escrever" <?php echo isset($_SESSION['usuario_comum']) && $_SESSION['usuario_comum'] ? 'style="display: inline;"' : 'style="display: none;"'; ?>>Minhas notícias</a><br>Favoritos<img src="bookmarkSF.png" id="bookmarkSF"></p>
            </div>
            <div class="inferior_direito">
              <textarea id="tiny" style="width: 80%;">&lt;p&gt;Welcome to the TinyMCE jQuery example!&lt;/p&gt;</textarea>
            </div>
    </div>
    <script>
      $('textarea#tiny').tinymce({
        height: 800,
        menubar: false,
        plugins: [
          'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
          'anchor', 'searchreplace', 'visualblocks', 'fullscreen',
          'insertdatetime', 'media', 'table', 'code', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | blocks | bold italic backcolor | ' +
          'alignleft aligncenter alignright alignjustify | ' +
          'bullist numlist outdent indent | removeformat | help'
      });
    </script>
        </div>
    </div>
</body>
</html>