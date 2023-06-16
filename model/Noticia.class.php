<?php 

include_once 'conexao.php';

class Noticia{

    private $id;
    private $titulo;
    private $subtitulo;
    private $corpo;
    private $data_noticia;
    private $id_usuario;

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getIdUsuario(){
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario){
        $this->id_usuario = $id_usuario;
    }

    public function getTitulo(){
        return $this->titulo;
    }

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }

    public function getSubtitulo(){
        return $this->subtitulo;
    }

    public function setSubtitulo($subtitulo){
        $this->subtitulo = $subtitulo;
    }

    public function getCorpo(){
        return $this->corpo;
    }

    public function setCorpo($corpo){
        $this->corpo = $corpo;
    }

    public function getData(){
        return $this->data_noticia;
    }

    public function setData($data_noticia){
        $this->data_noticia = $data_noticia;
    }

    public function getCurrentDate(){
        return date('Y-m-d H:i:s');
    }

    public function save(){
        $pdo = conexao();

        try{
            $stmt = $pdo->prepare('INSERT INTO usuario (id, titulo, subtitulo, corpo, data_noticia, id_usuario) VALUES(:id, :titulo, :subtitulo, :corpo, :data_noticia, :id_usuario)');

            $stmt->execute([
                ':id' => $this->id,
                ':titulo' => $this->titulo,
                ':subtitulo' => $this->subtitulo,
                ':corpo' => $this->corpo,
                ':data_noticia' => $this->data_noticia,
                ':id_usuario' => $this->id_usuario,
            ]);
            
            return true;
        }catch(Exception $e){
            return false;
        }
        
    }
}

?>