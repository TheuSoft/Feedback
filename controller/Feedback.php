<?php

namespace controller;

use service\FeedbackService;
use template\Template;
use template\ITemplate;

class Feedback
{
    private ITemplate $template;
    
    public function __construct()
    {
        $this->template = new Template();
    }
    
    public function listar()
    {
        $service = new FeedbackService();
        $resultado = $service->listarFeedback();
        $this->template->layout("\\public\\feedback\\listar.php", $resultado);
    }
    
    public function inserir()
    {
        $dados = [
            'usuario_id' => $_POST['usuario_id'],
            'produto_id' => $_POST['produto_id'],
            'nota' => $_POST['nota'],
            'comentario' => $_POST['comentario']
        ];
        $service = new FeedbackService();
        $resultado = $service->inserir($dados);
        header("location: index.php?param=feedback/lista&info=1");
    }
    
    public function formulario()
    {
        // Buscar usuários e produtos para os selects
        $usuarioService = new \service\UsuarioService();
        $produtoService = new \service\ProdutoService();
        
        $usuarios = $usuarioService->listarUsuario()->fetchAll();
        $produtos = $produtoService->listarProduto()->fetchAll();
        
        $dados = [
            'usuarios' => $usuarios,
            'produtos' => $produtos
        ];
        
        $this->template->layout("\\public\\feedback\\form.php", $dados);
    }
    
    public function alterarForm()
    {
        $id = $_GET["id"];
        $service = new FeedbackService();
        $resultado = $service->listarId($id);
        
        // Controller processa TODOS os dados necessários
        $feedback = null;
        if ($resultado) {
            $dadosArray = $resultado->fetchAll();
            if (count($dadosArray) > 0) {
                $feedback = $dadosArray[0]; // Pega o primeiro (e único) resultado
            }
        }
        
        // Buscar usuários e produtos para os selects
        $usuarioService = new \service\UsuarioService();
        $produtoService = new \service\ProdutoService();
        
        $usuarios = $usuarioService->listarUsuario()->fetchAll();
        $produtos = $produtoService->listarProduto()->fetchAll();
        
        // Dados processados e organizados para o template
        $dados = [
            'feedback' => $feedback,
            'usuarios' => $usuarios,
            'produtos' => $produtos
        ];
        
        $this->template->layout("\\public\\feedback\\form.php", $dados);
    }
    
    public function alterar()
    {
        $dados = [
            'id' => $_POST['id'],
            'usuario_id' => $_POST['usuario_id'],
            'produto_id' => $_POST['produto_id'],
            'nota' => $_POST['nota'],
            'comentario' => $_POST['comentario']
        ];
        $service = new FeedbackService();
        $resultado = $service->atualizar($dados);
        header("location: index.php?param=feedback/lista&info=2");
    }
    
    public function deletar()
    {
        $id = $_GET["id"];
        $service = new FeedbackService();
        $resultado = $service->excluir($id);
        header("location: index.php?param=feedback/lista&info=3");
    }
}