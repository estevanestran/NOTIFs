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
}

?>