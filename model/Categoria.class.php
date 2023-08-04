(<?php 

include_once 'conexao.php';

    class Categoria{

        private $id;
        private $nome;

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

        public static function getAll(){
            $pdo = conexao();
            $lista = [];
            foreach($pdo->query('SELECT * FROM categoria') as $linha){
                $categoria = new Categoria();
                $categoria->setId($linha['id']);
                $categoria->setNome($linha['nome']);
                $lista[] = $categoria;
            }
    
            return $lista;
        }
    }

?>)