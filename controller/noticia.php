<?php 

$acao = $_GET['acao'];
include_once '../model/Noticia.class.php';
include_once '../model/Curso_noticia.class.php';
include_once '../model/Categoria_noticia.class.php';
include_once '../model/Usuario.class.php';

if($acao=='publicar'){
    //$ultimoUsuario = $usuario->getId();

    $noticia = new Noticia();
    $noticia->setTitulo($_POST['titulo']);
    $noticia->setSubtitulo($_POST['subtitulo']);
    $noticia->setCorpo($_POST['corpo']);
    $noticia->setData($noticia->getCurrentDate());
    $noticia->setFoto($_FILES['foto']['tmp_name']);
    //$noticia->setIdUsuario($_POST[$ultimoUsuario]);
    $noticia->save();

    $ultimoID = $noticia->getId();

    $nomeCategoria = $_POST['categoria'];

    $categoriaNoticia = new Categoria_noticia();
    $categoriaNoticia->setId_noticia($ultimoID);
    if (!empty($nomeCategoria)) {
    $pdo = conexao();
    $stmt = $pdo->prepare('SELECT id FROM categoria WHERE nome = :categoria');
    $stmt->execute([':categoria' => $nomeCategoria]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            $idCategoria = $resultado['id'];
            $categoriaNoticia->setId_categoria($idCategoria);
                } else {
        }
    } else {
    $categoriaNoticia->setId_categoria(null);
    }
    $categoriaNoticia->save();

    $nomeCursos = $_POST['curso'];

    $CursoNoticia = new Curso_noticia();

    if (!empty($nomeCursos)) {
        foreach ($nomeCursos as $nomeCurso){
        $pdo = conexao();
        $stmt = $pdo->prepare('SELECT id FROM curso WHERE nome = :curso');
        $stmt->execute([':curso' => $nomeCurso]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
    
        // Verifica se foi encontrado o ID do curso
            if ($resultado) {
                $idCurso = $resultado['id'];
            // Define o ID do curso no objeto Usuario
                $CursoNoticia->setId_curso($idCurso);
                $CursoNoticia->setId_noticia($ultimoID);
                $CursoNoticia->save();
            } else {
            // Curso não encontrado, trata o erro conforme necessário
            }
        }
    }
    //var_dump($noticia);
    header('Location:../view/TelaPrincipal.php');

}
?>