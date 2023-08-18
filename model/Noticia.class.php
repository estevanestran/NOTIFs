<?php 

include_once 'conexao.php';

class Noticia{

    private $id;
    private $titulo;
    private $subtitulo;
    private $corpo;
    private $data_noticia;
    private $id_usuario;
    private $foto;
    private $alerta;

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

    public function getFoto(){
        return $this->foto;
    }

    public function setFoto($foto){
        $this->foto = $foto;
    }

    public function getAlerta(){
        return $this->alerta;
    }

    public function setAlerta($alerta){
        $this->alerta = $alerta;
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
        if(isset($_FILES['foto'])){
                        
            $foto = $_FILES['foto'];

            if($foto['error']){
                die("Falha ao enviar arquivo");
            }

            $pasta = "../uploads/";
            $name = $foto['name'];
            $nomeArquivo = uniqid();
            $extensao = strtolower(pathinfo($name, PATHINFO_EXTENSION));
            $endereco = $pasta . $nomeArquivo . "." . $extensao;

            if($extensao != "jpg" && $extensao != "png"){
                die("Tipo de arquivo não aceito");
            }

            $deu_certo = move_uploaded_file($foto["tmp_name"], $pasta . $nomeArquivo . "." . $extensao);

        if($deu_certo){

            $this->setFoto($endereco);
            try{
            $stmt = $pdo->prepare('INSERT INTO noticia (titulo, subtitulo, corpo, data_noticia, id_usuario, foto, alerta) VALUES(:titulo, :subtitulo, :corpo, :data_noticia, :id_usuario, :foto, :alerta)');

            $stmt->execute([
                ':titulo' => $this->titulo,
                ':subtitulo' => $this->subtitulo,
                ':corpo' => $this->corpo,
                ':data_noticia' => $this->data_noticia,
                ':id_usuario' => $this->id_usuario,
                ':foto' => $this->foto,
                ':alerta' => 0,
            ]);

            $this->id = $pdo->lastInsertId();
            
            return true;
        }catch(Exception $e){
            return false;
        }
        }
        }
        
    }

    public static function getAll(){
        $pdo = conexao();
        $lista = [];
        foreach($pdo->query('SELECT * FROM noticia') as $linha){
            $noticia = new Noticia();
            $noticia->setTitulo($linha['titulo']);
            $noticia->setSubtitulo($linha['subtitulo']);
            $noticia->setCorpo($linha['corpo']);
            $noticia->setId($linha['id']);
            $noticia->setData($linha['data_noticia']);
            $noticia->setIdUsuario($linha['id_usuario']);
            $noticia->setFoto($linha['foto']);
            $noticia->setAlerta($linha['alerta']);
            $lista[] = $noticia;
        }

        return $lista;
    }

    public static function getAlertas(){
        $pdo = conexao();
        $lista = [];
        foreach($pdo->query('SELECT * FROM noticia WHERE alerta = 1') as $linha){
            $noticia = new Noticia();
            $noticia->setTitulo($linha['titulo']);
            $noticia->setSubtitulo($linha['subtitulo']);
            $noticia->setCorpo($linha['corpo']);
            $noticia->setId($linha['id']);
            $noticia->setData($linha['data_noticia']);
            $noticia->setIdUsuario($linha['id_usuario']);
            $noticia->setFoto($linha['foto']);
            $noticia->setAlerta($linha['alerta']);
            $lista[] = $noticia;
        }

        return $lista;
    }

    public function buscarNoticiaPorId($id){
        try {
        $pdo = conexao();

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT id, titulo, subtitulo, corpo, data_noticia, id_usuario, foto, alerta FROM noticia WHERE id = ?";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $noticiaEncontrada = $stmt->fetchObject('Noticia');

            $pdo = null;

            return $noticiaEncontrada;
        } else {
            $pdo = null;

            return null;
        }
    } catch (PDOException $e) {
        die("Erro na conexão com o banco de dados: " . $e->getMessage());
    }
    }

    public static function getByCategoryId($categoria_id) {
        $pdo = conexao();
        $sql = "SELECT * FROM noticia n 
                INNER JOIN categoria_noticia cn ON n.id = cn.id_noticia
                WHERE cn.id_categoria = :categoria_id";
    
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':categoria_id', $categoria_id, PDO::PARAM_INT);
        $stmt->execute();
    
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Noticia');
    }

    public function pegaNomeAutor($id){
        $pdo = conexao();

        $sql = "SELECT nome FROM usuario WHERE id = :id_usuario";
        $sql = $pdo->prepare($sql);
        $sql->bindValue(':id_usuario', $id, PDO::PARAM_INT);
        $sql->execute();

        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return " &#8226; Publicado por " . $result['nome'];
    }
}

?>