<?php 

    include_once 'conexao.php';

    class Curso_noticia{

    private $id_curso;
    private $id_noticia;

    public function getId_curso(){
        return $this->id_curso;
    }

    public function setId_curso($id_curso){
        $this->id_curso = $id_curso;
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
            $stmt = $pdo->prepare('INSERT INTO curso_noticia (id_curso, id_noticia) VALUES (:id_curso, :id_noticia)');

            $stmt->execute([
                ':id_curso' => $this->id_curso,
                ':id_noticia' => $this->id_noticia,
            ]);

            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}
?>