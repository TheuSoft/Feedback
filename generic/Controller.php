<?php
abstract class Controller extends Acao {
    protected $template;
    
    public function __construct() {
        parent::__construct();
        $this->template = new BaseTemplate();
    }
    
    abstract public function listar();
    abstract public function form();
    abstract public function salvar();
    abstract public function editar();
    abstract public function excluir();
}
?>
