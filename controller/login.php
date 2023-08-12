<?php 

if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) && !empty($_POST['senha'])){

    include_once '../model/conexao.php';
    include_once '../model/Usuario.class.php';

    $u = new Usuario();
    

    $email = addslashes($_POST['email']);
    $senha = addslashes($_POST['senha']);
    if($u->login($email, $senha) == true){
        if(isset($_SESSION['id'])){
            header('Location: ../view/TelaPrincipal.php');
        } else {
            header('Location: ../view/index.html');
        }
    } else {
        header('Location: ../view/index.html');
    }
} else {

    header('Location: ../view/index.html');
}



/*if ($acao == 'login'){

    $usuario = new Usuario();
    $usuario->setEmail($_POST['email']);
    $usuario->setSenha($_POST['senha']);
if (isset($_POST['email']) && isset($_POST['senha'])){
    function validate($data){

        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = validate($_POST['email']);
    $senha = validate($_POST['senha']);

        $pdo = conexao();

        $sql = "SELECT FROM usuario WHERE email='$email' AND senha='$senha'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) === 1){
            $row = mysqli_fetch_assoc($result);
            if ($row['email'] === $email && $row['senha'] === $senha){
                $_SESSION['email'] = $row['email'];
                $_SESSION['senha'] = $row['senha'];
                $_SESSION['id'] = $row['id'];
                header('Location:../view/TelaPrincipal.html');
                exit();
            } else{
                header('Location:index.html?error=Email ou senha incorreto');
            }
        } else {
            header('Location:index.html?error=Email ou senha incorreto');
        }
    }*/

?>