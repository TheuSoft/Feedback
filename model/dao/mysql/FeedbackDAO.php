<?php
// Classe responsável por acessar e manipular os dados da tabela "feedback"
// Implementa a interface IFeedbackDAO (garante que os métodos obrigatórios existam)
class FeedbackDAO implements IFeedbackDAO {
    private $pdo; // Objeto PDO para conexão com o banco de dados
    
    // Construtor: ao instanciar a classe, obtém a conexão via Singleton
    public function __construct() {
        // MysqlSingleton retorna sempre a mesma instância de conexão PDO
        $this->pdo = MysqlSingleton::getInstance()->getConnection();
    }
    
    // Inserir novo feedback no banco de dados
    public function inserir($usuarioId, $produtoId, $nota, $comentario) {
        // Query com placeholders (?) para evitar SQL Injection
        $sql = "INSERT INTO feedback (usuario_id, produto_id, nota, comentario) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        // Executa a query com os valores recebidos
        return $stmt->execute([$usuarioId, $produtoId, $nota, $comentario]);
    }
    
    // Atualizar um feedback existente pelo ID
    public function atualizar($id, $usuarioId, $produtoId, $nota, $comentario) {
        $sql = "UPDATE feedback 
                SET usuario_id = ?, produto_id = ?, nota = ?, comentario = ? 
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$usuarioId, $produtoId, $nota, $comentario, $id]);
    }
    
    // Excluir feedback pelo ID
    public function excluir($id) {
        $sql = "DELETE FROM feedback WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    
    // Buscar feedback pelo ID, incluindo nome do usuário e nome do produto
    public function buscarPorId($id) {
        $sql = "SELECT f.*, 
                       u.nome as usuario_nome, 
                       p.nome as produto_nome 
                FROM feedback f 
                JOIN usuarios u ON f.usuario_id = u.id 
                JOIN produtos p ON f.produto_id = p.id 
                WHERE f.id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        // fetch() retorna apenas 1 registro
        return $stmt->fetch();
    }
    
    // Listar todos os feedbacks do sistema, ordenados do mais recente para o mais antigo
    public function listarTodos() {
        $sql = "SELECT f.*, 
                       u.nome as usuario_nome, 
                       p.nome as produto_nome 
                FROM feedback f 
                JOIN usuarios u ON f.usuario_id = u.id 
                JOIN produtos p ON f.produto_id = p.id 
                ORDER BY f.id DESC";
        // query() é usada porque não há parâmetros variáveis
        $stmt = $this->pdo->query($sql);
        // fetchAll() retorna um array com todos os registros
        return $stmt->fetchAll();
    }
    
    // Listar feedbacks de um produto específico
    public function listarPorProduto($produtoId) {
        $sql = "SELECT f.*, 
                       u.nome as usuario_nome, 
                       p.nome as produto_nome 
                FROM feedback f 
                JOIN usuarios u ON f.usuario_id = u.id 
                JOIN produtos p ON f.produto_id = p.id 
                WHERE f.produto_id = ? 
                ORDER BY f.id DESC";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$produtoId]);
        return $stmt->fetchAll();
    }
    
    // Listar feedbacks de um usuário específico
    public function listarPorUsuario($usuarioId) {
        $sql = "SELECT f.*, 
                       u.nome as usuario_nome, 
                       p.nome as produto_nome 
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
