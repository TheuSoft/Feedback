<?php
namespace generic;

class Controller {
    private $arrChamadas = [];

    public function __construct() {
        // Definição centralizada das rotas
        $this->arrChamadas = [
            // Rotas de Usuario
            "usuario/lista"           => new Acao("Usuario", "listar"),
            "usuario/formulario"      => new Acao("Usuario", "formulario"),
            "usuario/formularioalterar" => new Acao("Usuario", "alterarForm"),
            "usuario/inserir"         => new Acao("Usuario", "inserir"),
            "usuario/alterar"         => new Acao("Usuario", "alterar"),
            "usuario/deletar"         => new Acao("Usuario", "deletar"),

            // Rotas de Produto
            "produto/lista"           => new Acao("Produto", "listar"),
            "produto/formulario"      => new Acao("Produto", "formulario"),
            "produto/formularioalterar" => new Acao("Produto", "alterarForm"),
            "produto/inserir"         => new Acao("Produto", "inserir"),
            "produto/alterar"         => new Acao("Produto", "alterar"),
            "produto/deletar"         => new Acao("Produto", "deletar"),

            // Rotas de Feedback
            "feedback/lista"          => new Acao("Feedback", "listar"),
            "feedback/formulario"     => new Acao("Feedback", "formulario"),
            "feedback/formularioalterar" => new Acao("Feedback", "alterarForm"),
            "feedback/inserir"        => new Acao("Feedback", "inserir"),
            "feedback/alterar"        => new Acao("Feedback", "alterar"),
            "feedback/deletar"        => new Acao("Feedback", "deletar")
        ];
    }

    public function verificarChamadas($rota) {
        if (isset($this->arrChamadas[$rota])) {
            $acao = $this->arrChamadas[$rota];
            $acao->executar();
            return;
        }

        echo "Rota não existe!";
    }
}