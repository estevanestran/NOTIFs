<?php 

include_once 'conexao.php';

class Noticia{

    private $id;
    private $titulo;
    private $subtitulo;
    private $corpo;
    private $data;
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
        return $this->data;
    }

    public function setData($data){
        $this->data = $data;
    }

    }

?>