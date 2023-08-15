<?php 
include_once 'conexao.php';

    class Usuario{

        private $id;
        private $email;
        private $nome;
        private $senha;
        private $estado;
        private $id_curso;
        private $pedido;

        public function getId(){
            return $this->id;
        }
    
        public function setId($id){
            $this->id = $id;
        }

        public function getIdCurso(){
            return $this->id_curso;
        }
    
        public function setIdCurso($id_curso){
            $this->id_curso = $id_curso;
        }

        public function getNome(){
            return $this->nome;
        }
    
        public function setNome($nome){
            $this->nome = $nome;
        }

        public function setSenha($senha){
            $this->senha = $senha;
        }

        public function getSenha(){
            return $this->senha;
        }

        public function setEstado($estado){
            $this->estado = $estado;
        }

        public function getEstado(){
            return $this->estado;
        }

        public function setPedido($pedido){
            $this->pedido = $pedido;
        }

        public function getPedido(){
            return $this->pedido;
        }

        public function setEmail($email){
            if(str_contains($email, 'canoas.ifrs.edu.br')){
                $this->email = $email;
            }
        }

        public function getEmail(){
            return $this->email;
        }

        public function getNomeCurso(){
            $pdo = conexao();

            $sql = $pdo->prepare("SELECT nome FROM curso WHERE id = :id_curso");
            $sql->bindValue(":id_curso", $this->getIdCurso());
            $sql->execute();

            $result = $sql->fetch(PDO::FETCH_ASSOC);
            if ($result !== false && isset($result['nome'])) {
                return " - " . $result['nome'];
            } else {
                return " - Servidor";
            }
        }

        public function save(){
            $pdo = conexao();

            try{
                $senhaHash = password_hash($this->senha, PASSWORD_DEFAULT); // Gera um hash da senha
                $stmt = $pdo->prepare('INSERT INTO usuario (id, nome, senha, email, estado, id_curso, pedido) VALUES(:id, :nome, :senha, :email, :estado, :id_curso, :pedido)');

                $stmt->execute([
                    ':id' => $this->id,
                    ':nome' => $this->nome,
                    ':senha' => $senhaHash,
                    ':email' => $this->email,
                    ':estado' => 'comum',
                    ':id_curso' => $this->id_curso,
                    ':pedido' => 0,
                ]);
                
                return true;
            }catch(Exception $e){
                return false;
            }
            
        }

        public static function deletar($id){
            $pdo = conexao();

            $stmt = $pdo->prepare('DELETE FROM usuario WHERE id = :id');
            $stmt->execute([
                ':id' => $id
            ]);
        }

        public static function getAll(){
            $pdo = conexao();
            $lista = [];
            foreach($pdo->query('SELECT * FROM usuario') as $linha){
                $usuario = new Usuario();
                $usuario->setNome($linha['nome']);
                $usuario->setEmail($linha['email']);
                $usuario->setSenha($linha['senha']);
                $usuario->setId($linha['id']);
                $usuario->setEstado($linha['estado']);
                $usuario->setIdCurso($linha['id_curso']);
                $lista[] = $usuario;
            }
    
            return $lista;
        }

        public static function getPedidos(){
            $pdo = conexao();
            $lista = [];
            foreach($pdo->query('SELECT * FROM usuario WHERE pedido = 1') as $linha){
                $usuario = new Usuario();
                $usuario->setNome($linha['nome']);
                $usuario->setEmail($linha['email']);
                $usuario->setSenha($linha['senha']);
                $usuario->setId($linha['id']);
                $usuario->setEstado($linha['estado']);
                $usuario->setIdCurso($linha['id_curso']);
                $lista[] = $usuario;
            }
    
            return $lista;
        }

        public static function getPromovidos(){
            $pdo = conexao();
            $lista = [];
            foreach($pdo->query('SELECT * FROM usuario WHERE estado = "administrador"') as $linha){
                $usuario = new Usuario();
                $usuario->setNome($linha['nome']);
                $usuario->setEmail($linha['email']);
                $usuario->setSenha($linha['senha']);
                $usuario->setId($linha['id']);
                $usuario->setEstado($linha['estado']);
                $usuario->setIdCurso($linha['id_curso']);
                $lista[] = $usuario;
            }
    
            return $lista;
        }

        public function login($email, $senha) {
            $pdo = conexao();
        
            $sql = "SELECT id, senha FROM usuario WHERE email = :email";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(":email", $email);
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
            if ($user && password_verify($senha, $user['senha'])) {
                $_SESSION['id'] = $user['id'];
                return true;
            } else {
                return false;
            }
        }

        public function pegaNome($id){
            $pdo = conexao();

            $array = array();

            $sql = "SELECT nome FROM usuario WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindValue("id", $id);
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetch();
            }

            return $array;
        }

        public function pegaEstado($id) {
            $pdo = conexao();
            $query = "SELECT estado FROM usuario WHERE id = :id";
            $stmt = $pdo->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['estado'];
        }

        public function pegaPedido($id) {
            $pdo = conexao();
            $sql = "SELECT pedido FROM usuario WHERE id = :id";
            $sql = $pdo->prepare($sql);
            $sql->bindParam(':id', $id, PDO::PARAM_INT);
            $sql->execute();

            $result = $sql->fetch(PDO::FETCH_ASSOC);
            return $result['pedido'];
        }

    }
?>