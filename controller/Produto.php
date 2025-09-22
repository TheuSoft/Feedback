<?php
class Produto extends Controller {
    private $produtoService;
    
    public function __construct() {
        parent::__construct();
        $this->produtoService = new ProdutoService();
    }
    
    public function listar() {
        try {
            $produtos = $this->produtoService->listarTodos();
            $this->template->header("Produtos");
            $this->template->render('produto/listar.php', ['produtos' => $produtos]);
            $this->template->footer();
        } catch (Exception $e) {
            $this->template->header("Erro");
            echo '<div class="alert alert-error">Erro: ' . $e->getMessage() . '</div>';
            $this->template->footer();
        }
    }
    
    public function form() {
        $produto = null;
        $id = $_GET['id'] ?? null;
        
        if ($id) {
            try {
                $produto = $this->produtoService->buscarPorId($id);
                if (!$produto) {
                    throw new Exception("Produto não encontrado");
                }
            } catch (Exception $e) {
                $this->template->header("Erro");
                echo '<div class="alert alert-error">Erro: ' . $e->getMessage() . '</div>';
                $this->template->footer();
                return;
            }
        }
        
        $this->template->header($produto ? "Editar Produto" : "Novo Produto");
        $this->template->render('produto/form.php', ['produto' => $produto]);
        $this->template->footer();
    }
    
    public function salvar() {
        try {
            $id = $this->getData('id');
            $nome = $this->getData('nome');
            $descricao = $this->getData('descricao');
            $preco = $this->getData('preco');
            
            if ($id) {
                $this->produtoService->atualizar($id, $nome, $descricao, $preco);
                $mensagem = "Produto atualizado com sucesso!";
            } else {
                $this->produtoService->salvar($nome, $descricao, $preco);
                $mensagem = "Produto cadastrado com sucesso!";
            }
            
            if (!isset($_SESSION)) session_start();
            $_SESSION['mensagem'] = $mensagem;
            $this->redirect('?acao=produto');
        } catch (Exception $e) {
            if (!isset($_SESSION)) session_start();
            $_SESSION['erro'] = $e->getMessage();
            $this->redirect('?acao=produto-form' . (isset($id) && $id ? '&id=' . $id : ''));
        }
    }
    
    public function editar() {
        $this->form();
    }
    
    public function visualizar() {
        try {
            $id = $_GET['id'] ?? null;
            if (!$id) {
                throw new Exception("ID do produto não informado");
            }
            
            $produto = $this->produtoService->buscarPorId($id);
            if (!$produto) {
                throw new Exception("Produto não encontrado");
            }
            
            $this->template->header("Visualizar Produto");
            $this->template->render('produto/visualizar.php', ['produto' => $produto]);
            $this->template->footer();
        } catch (Exception $e) {
            $this->template->header("Erro");
            echo '<div class="alert alert-error">Erro: ' . $e->getMessage() . '</div>';
            $this->template->footer();
        }
    }
    
    public function excluir() {
        try {
            $id = $_GET['id'] ?? null;
            $this->produtoService->excluir($id);
            if (!isset($_SESSION)) session_start();
            $_SESSION['mensagem'] = "Produto excluído com sucesso!";
        } catch (Exception $e) {
            if (!isset($_SESSION)) session_start();
            $_SESSION['erro'] = $e->getMessage();
        }
        
        $this->redirect('?acao=produto');
    }
}
?>
