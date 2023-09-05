<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="EsqueceuTela.css">
    <title>Notifs</title>
</head>
<body>
<?php
include_once "../model/conexao.php";
$pdo = conexao();
if(isset($_POST['email'])){
    $padrao = '/^[\p{L}a-zA-Z0-9\s.,!?@´]+$/u';
    $email = filter_var ($_POST['email'], FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => $padrao)));
    
    $sql = "SELECT * FROM usuario where email = '" . $email . "';"; 
    $sql = $pdo->query($sql);
    $qtd = $sql->rowCount();

    if($qtd==0){
        echo "Email incorreto ou não cadastrado";
    }else{
        $algoritmo = 'sha256'; 
        $new = substr(md5(time()), 0, 6);
        $senha = hash($algoritmo, $new);
        
        // Destinatário (endereço de e-mail do usuário)
        $destinatario = $email; // Defina o destinatário
        
        // Assunto do e-mail
        $assunto = "NOTIFS - Recuperação de Senha";
        
        // Mensagem de e-mail (conteúdo)
        $mensagem = "Sua nova senha é: " . $new; // Inclua a nova senha
        
        // Cabeçalhos
        $headers = "From: notifs2023@gmail.com" . "\r\n" .
                   "Reply-To: no-reply@gmail.com" . "\r\n" . // Corrija o endereço de e-mail de resposta
                   "X-Mailer: PHP/" . phpversion();
                   
        if(mail($destinatario, $assunto, $mensagem, $headers)){
            $sql = "UPDATE usuario SET senha = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $senha, $email);
            
            if ($stmt->execute()) {
                ?>
                <p>E-mail de recuperação de senha enviado com sucesso. <br>Verifique sua caixa de entrada e faça login com a nova senha!</p>
                <br>
                <a href="index.html"><div class="button"><p>Fazer Login</p></div></a>
            <?php
            } else {
                echo "Erro ao atualizar a senha. Tente novamente ou entre em contato através do e-mail notifs2023@gmail.com";
            }

        }
    }
}else{
?>
    <div class="container">
        <div class="superior">
            <div class="superior_esquerdo">
                <a href="index.html"><h1 class="nome_site">NOTIFs</h1></a>
            </div>
            <div class="superior_direito">
                <a href="index.html"><h4>Faça login</h4></a>
            </div>
        </div>
        <div class="inferior">
            <div class="inferior_esquerdo_um">
                <h2>Seja bem-vindo ao NOTIFs!</h2>
            </div>
            <div class="inferior_esquerdo_dois">
                <p id="descTelaIni">Aqui você pode se manter ligado nas<br>últimas notícias do IFRS - Campus Canoas.</p>
            </div>
            <div class="logo">
                <img src="logoNOTIFs.png" id="logo">
            </div>
            <div class="inferior_direito_esqueceu">
                <h3>Recuperação de senha</h3>
                <br>
                <p id="recuperar">Informe o seu e-mail e, então, te enviaremos uma nova senha de recuperação.</p>
                <br>
                <form action="" method="post">
                    <label for="email">E-mail institucional</label><br>
                    <input type="text" id="email" name="email" required><br><br>
                    <input type="submit" id="botao" value="Enviar"><br><br>
                </form>
                <p id="naotem">Não tem uma conta? <a id="caminhoAlt" href="TelaCadastro.html">Cadastre-se</a></p>
            </div>
        </div>
    </div>
    <?php } ?>
</body>
</html>