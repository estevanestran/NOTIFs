<?php 

require_once './TCC/model/Usuario.class.php';

use PHPUnit\Framework\TestCase;

class UsuarioTest extends TestCase{

    /**
     * Summary of testSave
     * @return void
     */
    public function testSave(){
        $usuario = new Usuario();

        $usuario->setNome("Estevan Estran Pinheiro");
        $usuario->setId(71);
        $usuario->setEmail("estevanestran@aluno.canoas.ifrs.edu.br");
        $usuario->setIdCurso(2);
        $usuario->setSenha(1234);
        $usuario->setEstado("comum");

        $this->assertEquals("Estevan Estran Pinheiro", $usuario->getNome());
        $this->assertEquals(71, $usuario->getId());
        $this->assertEquals("estevanestran@aluno.canoas.ifrs.edu.br", $usuario->getEmail());
        $this->assertEquals(2, $usuario->getIdCurso());
        $this->assertEquals(1234, $usuario->getSenha());
        $this->assertEquals("comum", $usuario->getEstado());
    }
}

?>