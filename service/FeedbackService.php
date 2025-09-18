<?php
class FeedbackService {
    private $feedbackDAO;
    private $usuarioDAO;
    private $produtoDAO;
    
    public function __construct() {
        $this->feedbackDAO = new FeedbackDAO();
        $this->usuarioDAO = new UsuarioDAO();
        $this->produtoDAO = new ProdutoDAO();
    }
    
    public function salvar($usuarioId, $produtoId, $nota, $comentario) {
        // Validações de negócio
        if (empty($usuarioId) || !is_numeric($usuarioId)) {
            throw new Exception("Usuário é obrigatório");
        }
        
        if (empty($produtoId) || !is_numeric($produtoId)) {
            throw new Exception("Produto é obrigatório");
        }
        
        if (empty($nota) || !is_numeric($nota) || $nota < 1 || $nota > 5) {
            throw new Exception("Nota deve ser um valor entre 1 e 5");
        }
        
        // Verificar se usuário existe
        $usuario = $this->usuarioDAO->buscarPorId($usuarioId);
        if (!$usuario) {
            throw new Exception("Usuário não encontrado");
        }
        
        // Verificar se produto existe
        $produto = $this->produtoDAO->buscarPorId($produtoId);
        if (!$produto) {
            throw new Exception("Produto não encontrado");
        }
        
        // Sanitizar dados
        $comentario = trim($comentario);
        $nota = (int) $nota;
        
        return $this->feedbackDAO->inserir($usuarioId, $produtoId, $nota, $comentario);
    }
    
    public function atualizar($id, $usuarioId, $produtoId, $nota, $comentario) {
        // Validações de negócio
        if (empty($id) || !is_numeric($id)) {
            throw new Exception("ID do feedback inválido");
        }
        
        if (empty($usuarioId) || !is_numeric($usuarioId)) {
            throw new Exception("Usuário é obrigatório");
        }
        
        if (empty($produtoId) || !is_numeric($produtoId)) {
            throw new Exception("Produto é obrigatório");
        }
        
        if (empty($nota) || !is_numeric($nota) || $nota < 1 || $nota > 5) {
            throw new Exception("Nota deve ser um valor entre 1 e 5");
        }
        
        // Verificar se feedback existe
        $feedback = $this->feedbackDAO->buscarPorId($id);
        if (!$feedback) {
            throw new Exception("Feedback não encontrado");
        }
        
        // Verificar se usuário existe
        $usuario = $this->usuarioDAO->buscarPorId($usuarioId);
        if (!$usuario) {
            throw new Exception("Usuário não encontrado");
        }
        
        // Verificar se produto existe
        $produto = $this->produtoDAO->buscarPorId($produtoId);
        if (!$produto) {
            throw new Exception("Produto não encontrado");
        }
        
        // Sanitizar dados
        $comentario = trim($comentario);
        $nota = (int) $nota;
        
        return $this->feedbackDAO->atualizar($id, $usuarioId, $produtoId, $nota, $comentario);
    }
    
    public function excluir($id) {
        if (empty($id) || !is_numeric($id)) {
            throw new Exception("ID do feedback inválido");
        }
        
        // Verificar se feedback existe
        $feedback = $this->feedbackDAO->buscarPorId($id);
        if (!$feedback) {
            throw new Exception("Feedback não encontrado");
        }
        
        return $this->feedbackDAO->excluir($id);
    }
    
    public function buscarPorId($id) {
        if (empty($id) || !is_numeric($id)) {
            throw new Exception("ID do feedback inválido");
        }
        
        return $this->feedbackDAO->buscarPorId($id);
    }
    
    public function listarTodos() {
        return $this->feedbackDAO->listarTodos();
    }
    
    public function listarPorProduto($produtoId) {
        if (empty($produtoId) || !is_numeric($produtoId)) {
            throw new Exception("ID do produto inválido");
        }
        
        return $this->feedbackDAO->listarPorProduto($produtoId);
    }
    
    public function listarPorUsuario($usuarioId) {
        if (empty($usuarioId) || !is_numeric($usuarioId)) {
            throw new Exception("ID do usuário inválido");
        }
        
        return $this->feedbackDAO->listarPorUsuario($usuarioId);
    }
}
?>
