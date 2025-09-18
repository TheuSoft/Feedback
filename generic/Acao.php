<?php
abstract class Acao {
    protected $dados = [];
    
    public function __construct() {
        $this->dados = $_POST;
    }
    
    public function getData($campo, $valorPadrao = null) {
        return $this->dados[$campo] ?? $valorPadrao;
    }
    
    public function redirect($url) {
        header("Location: $url");
        exit;
    }
    
    public function json($dados) {
        header('Content-Type: application/json');
        echo json_encode($dados);
        exit;
    }
}
?>
