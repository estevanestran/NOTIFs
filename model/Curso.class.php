<?php
include_once 'conexao.php';

class Curso {
    private $id;
    private $nome;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public static function getAll() {
        $pdo = conexao();
        $lista = [];

        foreach ($pdo->query('SELECT * FROM curso') as $linha) {
            $papel = new Curso();
            $papel->setId($linha['id']);
            $papel->setNome($linha['nome']);
            $lista[] = $papel;
        }

        return $lista;
    }
}
?>
