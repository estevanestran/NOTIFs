<?php 
include_once 'conexao.php';

    class Usuario{

        private $id;
        private $email;
        private $nome;
        private $senha;

        public function getId(){
            return $this->id;
        }
    
        public function setId($id){
            $this->id = $id;
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
                $stmt = $pdo->prepare('INSERT INTO usuario (id, nome, senha, email) VALUES(:id, :nome, :senha, :email)');

                $stmt->execute([
                    ':id' => $this->id,
                    ':nome' => $this->nome,
                    ':senha' => $this->senha,
                    ':email' => $this->email,
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
    }
?>