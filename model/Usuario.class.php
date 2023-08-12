<?php 
include_once 'conexao.php';

    class Usuario{

        private $id;
        private $email;
        private $nome;
        private $senha;
        private $estado;
        private $id_curso;

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

        public function setEmail($email){
            if(str_contains($email, 'canoas.ifrs.edu.br')){
                $this->email = $email;
            }
        }

        public function getEmail(){
            return $this->email;
        }

        public function save(){
            $pdo = conexao();

            try{
                $stmt = $pdo->prepare('INSERT INTO usuario (id, nome, senha, email, estado, id_curso) VALUES(:id, :nome, :senha, :email, :estado, :id_curso)');

                $stmt->execute([
                    ':id' => $this->id,
                    ':nome' => $this->nome,
                    ':senha' => $this->senha,
                    ':email' => $this->email,
                    ':estado' => 'comum',
                    ':id_curso' => $this->id_curso,
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

        public function login($email, $senha){
            $pdo = conexao();

            $sql = "SELECT * FROM usuario WHERE email = :email AND senha = :senha";
            $sql = $pdo->prepare($sql);
            $sql->bindValue("email", $email);
            $sql->bindValue("senha", $senha);
            $sql->execute();

            if($sql->rowCount() > 0){
                $dado = $sql->fetch();

                $_SESSION['id'] = $dado['id'];

                return true;
            } else {
                return false;
            }
        }

    }
?>