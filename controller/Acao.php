<?php
// Classe abstrata que fornece funcionalidades comuns para todas as ações/controladores
abstract class Acao {
    protected $dados = []; // Armazena os dados da requisição (POST)
    
    // Construtor: ao instanciar, já captura todos os dados enviados via POST
    public function __construct() {
        $this->dados = $_POST;
    }
    
    // Retorna o valor de um campo enviado pelo POST
    public function getData($campo, $valorPadrao = null) {
        return $this->dados[$campo] ?? $valorPadrao;
    }
    
    // Redireciona o usuário para outra URL
    public function redirect($url) {
        header("Location: $url"); 
        exit; 
    }
    
    // Retorna dados no formato JSON
    public function json($dados) {
        header('Content-Type: application/json'); 
        echo json_encode($dados); 
        exit; 
    }
}
?>