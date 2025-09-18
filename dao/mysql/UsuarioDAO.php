<?php
class UsuarioDAO implements IUsuarioDAO {
    private $pdo;
    
    public function __construct() {
        $this->pdo = MysqlSingleton::getInstance()->getConnection();
    }
    
    public function inserir($nome, $email) {
        $sql = "INSERT INTO usuarios (nome, email) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email]);
    }
    
    public function atualizar($id, $nome, $email) {
        $sql = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email, $id]);
    }
    
    public function excluir($id) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    
    public function buscarPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
    
    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
    
    public function listarTodos() {
        $sql = "SELECT * FROM usuarios ORDER BY nome";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}
?>
