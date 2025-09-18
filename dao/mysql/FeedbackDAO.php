<?php
class FeedbackDAO implements IFeedbackDAO {
    private $pdo;
    
    public function __construct() {
        $this->pdo = MysqlSingleton::getInstance()->getConnection();
    }
    
    public function inserir($usuarioId, $produtoId, $nota, $comentario) {
        $sql = "INSERT INTO feedback (usuario_id, produto_id, nota, comentario) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$usuarioId, $produtoId, $nota, $comentario]);
    }
    
    public function atualizar($id, $usuarioId, $produtoId, $nota, $comentario) {
        $sql = "UPDATE feedback SET usuario_id = ?, produto_id = ?, nota = ?, comentario = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$usuarioId, $produtoId, $nota, $comentario, $id]);
    }
    
    public function excluir($id) {
        $sql = "DELETE FROM feedback WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    
    public function buscarPorId($id) {
        $sql = "SELECT f.*, u.nome as usuario_nome, p.nome as produto_nome 
                FROM feedback f 
                JOIN usuarios u ON f.usuario_id = u.id 
                JOIN produtos p ON f.produto_id = p.id 
                WHERE f.id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function listarTodos() {
        $sql = "SELECT f.*, u.nome as usuario_nome, p.nome as produto_nome 
                FROM feedback f 
                JOIN usuarios u ON f.usuario_id = u.id 
                JOIN produtos p ON f.produto_id = p.id 
                ORDER BY f.id DESC";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
    
    public function listarPorProduto($produtoId) {
        $sql = "SELECT f.*, u.nome as usuario_nome, p.nome as produto_nome 
                FROM feedback f 
                JOIN usuarios u ON f.usuario_id = u.id 
                JOIN produtos p ON f.produto_id = p.id 
                WHERE f.produto_id = ? 
                ORDER BY f.id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$produtoId]);
        return $stmt->fetchAll();
    }
    
    public function listarPorUsuario($usuarioId) {
        $sql = "SELECT f.*, u.nome as usuario_nome, p.nome as produto_nome 
                FROM feedback f 
                JOIN usuarios u ON f.usuario_id = u.id 
                JOIN produtos p ON f.produto_id = p.id 
                WHERE f.usuario_id = ? 
                ORDER BY f.id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$usuarioId]);
        return $stmt->fetchAll();
    }
}
?>
