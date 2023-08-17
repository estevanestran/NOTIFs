<?php 
if(isset($_SESSION['id']) && !empty($_SESSION['id'])){

    include_once '../model/Usuario.class.php';
    $u = new Usuario();

    $idUser = $u->pegaId($_SESSION['id']);

}
$acao = $_GET['acao'];
include_once '../model/Noticia.class.php';
include_once '../model/Curso_noticia.class.php';
include_once '../model/Categoria_noticia.class.php';

if($acao === 'publicar'){

    $noticia = new Noticia();
    $noticia->setTitulo($_POST['titulo']);
    $noticia->setSubtitulo($_POST['subtitulo']);
    $noticia->setCorpo($_POST['corpo']);
    $noticia->setData($noticia->getCurrentDate());
    $noticia->setFoto($_FILES['foto']['tmp_name']);
    $noticia->setIdUsuario($idUser);
    $noticia->setAlerta($_POST['alerta']);
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
            if ($resultado) {
                $idCurso = $resultado['id'];
                $CursoNoticia->setId_curso($idCurso);
                $CursoNoticia->setId_noticia($ultimoID);
                $CursoNoticia->save();
            }
        }
    }
    header('Location:../view/TelaPrincipal.php');

}
?>