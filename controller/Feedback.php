<?php
class Feedback extends Controller {
    private $feedbackService;
    private $usuarioService;
    private $produtoService;
    
    public function __construct() {
        parent::__construct();
        $this->feedbackService = new FeedbackService();
        $this->usuarioService = new UsuarioService();
        $this->produtoService = new ProdutoService();
    }
    
    public function listar() {
        try {
            $feedbacks = $this->feedbackService->listarTodos();
            $this->template->header("Feedback");
            $this->template->render('feedback/listar.php', ['feedbacks' => $feedbacks]);
            $this->template->footer();
        } catch (Exception $e) {
            $this->template->header("Erro");
            echo '<div class="alert alert-error">Erro: ' . $e->getMessage() . '</div>';
            $this->template->footer();
        }
    }
    
    public function form() {
        $feedback = null;
        $id = $_GET['id'] ?? null;
        
        try {
            $usuarios = $this->usuarioService->listarTodos();
            $produtos = $this->produtoService->listarTodos();
            
            if ($id) {
                $feedback = $this->feedbackService->buscarPorId($id);
                if (!$feedback) {
                    throw new Exception("Feedback não encontrado");
                }
            }
            
            $this->template->header($feedback ? "Editar Feedback" : "Novo Feedback");
            $this->template->render('feedback/form.php', [
                'feedback' => $feedback,
                'usuarios' => $usuarios,
                'produtos' => $produtos
            ]);
            $this->template->footer();
        } catch (Exception $e) {
            $this->template->header("Erro");
            echo '<div class="alert alert-error">Erro: ' . $e->getMessage() . '</div>';
            $this->template->footer();
        }
    }
    
    public function salvar() {
        try {
            $id = $this->getData('id');
            $usuarioId = $this->getData('usuario_id');
            $produtoId = $this->getData('produto_id');
            $nota = $this->getData('nota');
            $comentario = $this->getData('comentario');
            
            if ($id) {
                $this->feedbackService->atualizar($id, $usuarioId, $produtoId, $nota, $comentario);
                $mensagem = "Feedback atualizado com sucesso!";
            } else {
                $this->feedbackService->salvar($usuarioId, $produtoId, $nota, $comentario);
                $mensagem = "Feedback cadastrado com sucesso!";
            }
            
            if (!isset($_SESSION)) session_start();
            $_SESSION['mensagem'] = $mensagem;
            $this->redirect('?acao=feedback');
        } catch (Exception $e) {
            if (!isset($_SESSION)) session_start();
            $_SESSION['erro'] = $e->getMessage();
            $this->redirect('?acao=feedback-form' . (isset($id) && $id ? '&id=' . $id : ''));
        }
    }
    
    public function editar() {
        $this->form();
    }
    
    public function excluir() {
        try {
            $id = $_GET['id'] ?? null;
            $this->feedbackService->excluir($id);
            if (!isset($_SESSION)) session_start();
            $_SESSION['mensagem'] = "Feedback excluído com sucesso!";
        } catch (Exception $e) {
            if (!isset($_SESSION)) session_start();
            $_SESSION['erro'] = $e->getMessage();
        }
        
        $this->redirect('?acao=feedback');
    }
}
?>
