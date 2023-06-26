<?php 

include_once 'conexao.php';

    class Categoria_noticia{

        private $id_categoria;
        private $id_noticia;

        public function getId_categoria(){
            return $this->id_categoria;
        }
    
        public function setId_categoria($id_categoria){
            $this->id_categoria = $id_categoria;
        }

        public function getId_noticia(){
            return $this->id_noticia;
        }
    
        public function setId_noticia($id_noticia){
            $this->id_noticia = $id_noticia;
        }

        public function getNome() {
              /*$pdo = conexao();
              $pdo->query('SELECT nome FROM categoria where id = (SELECT id_categoria from categoria_noticia where id_noticia = :id_noticia)');
              return true;*/

              $pdo = conexao();
              $stmt = $pdo->prepare('SELECT c.nome FROM categoria c INNER JOIN categoria_noticia cn ON c.id = cn.id_categoria WHERE cn.id_noticia = :id_noticia');
              $stmt->bindValue(':id_noticia', $this->id_noticia);
              $stmt->execute();

              $result = $stmt->fetch(PDO::FETCH_ASSOC);
              return $result['nome'] ?? '';
        }

        public function save() {
            $pdo = conexao();
    
            try {
                $stmt = $pdo->prepare('INSERT INTO categoria_noticia (id_categoria, id_noticia) VALUES (:id_categoria, :id_noticia)');
    
                $stmt->execute([
                    ':id_categoria' => $this->id_categoria,
                    ':id_noticia' => $this->id_noticia,
                ]);
    
                return true;
            } catch (Exception $e) {
                return false;
            }
        }

        public static function getAll(){
            $pdo = conexao();
            $lista = [];
            foreach($pdo->query('SELECT * FROM categoria_noticia') as $linha){
                $Categoria_noticia = new Categoria_noticia();
                $Categoria_noticia->setId_categoria($linha['id_categoria']);
                $Categoria_noticia->setId_noticia($linha['id_noticia']);
                $lista[] = $Categoria_noticia;
            }
    
            return $lista;
        }
}

?>