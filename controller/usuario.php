<?php 
session_start();
$acao = $_GET['acao'];
include_once '../model/Usuario.class.php';

if ($acao == 'cadastrar'){
    $usuario = new Usuario();
    $usuario->setNome($_POST['nome']);
    $usuario->setEmail($_POST['email']);
    $usuario->setSenha($_POST['senha']);
    $usuario->setEstado($_POST['estado']);
    // Obtém o nome do curso selecionado
    $nomeCurso = $_POST['curso'];

    // Verifica se o campo foi preenchido (o valor será vazio se a opção padrão "Selecione..." for selecionada)
    if (!empty($nomeCurso)) {
    // Consulta o banco de dados para obter o ID do curso com base no nome
    $pdo = conexao();
    $stmt = $pdo->prepare('SELECT id FROM curso WHERE nome = :curso');
    $stmt->execute([':curso' => $nomeCurso]);
    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verifica se foi encontrado o ID do curso
    if ($resultado) {
        $idCurso = $resultado['id'];
        // Define o ID do curso no objeto Usuario
        $usuario->setIdCurso($idCurso);
    } else {
        // Curso não encontrado, trata o erro conforme necessário
    }
} else {
    // Define o ID do curso como nulo
    $usuario->setIdCurso(null);
}
    $usuario->save();
    if ($usuario->save()) {
        $_SESSION['usuario_comum'] = true;
        header('Location: ../view/TelaPrincipal.php ');
        exit;
    }
    } else if($acao == 'deletar') {
        Usuario::deletar($_REQUEST['id']);
    }
?>