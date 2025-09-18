<?php
class ProdutoDAO implements IProdutoDAO {
    private $pdo;
    
    public function __construct() {
        $this->pdo = MysqlSingleton::getInstance()->getConnection();
    }
    
    public function inserir($nome, $descricao, $preco) {
        $sql = "INSERT INTO produtos (nome, descricao, preco) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $descricao, $preco]);
    }
    
    public function atualizar($id, $nome, $descricao, $preco) {
        $sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $descricao, $preco, $id]);
    }
    
    public function excluir($id) {
        $sql = "DELETE FROM produtos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    
    public function buscarPorId($id) {
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function listarTodos() {
        $sql = "SELECT * FROM produtos ORDER BY nome";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
?>
