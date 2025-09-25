<?php
// Classe responsável por manipular dados da tabela "usuarios"
// Implementa a interface IUsuarioDAO, garantindo que todos os métodos essenciais existam
class UsuarioDAO implements IUsuarioDAO {
    private $pdo; // Objeto PDO para conexão com o banco
    
    // Construtor: inicializa a conexão com o banco utilizando Singleton
    public function __construct() {
        $this->pdo = MysqlSingleton::getInstance()->getConnection();
    }
    
    // Insere um novo usuário no banco
    public function inserir($nome, $email) {
        $sql = "INSERT INTO usuarios (nome, email) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        // Executa a query com os valores fornecidos
        return $stmt->execute([$nome, $email]);
    }
    
    // Atualiza os dados de um usuário existente
    public function atualizar($id, $nome, $email) {
        $sql = "UPDATE usuarios SET nome = ?, email = ? WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email, $id]);
    }
    
    // Exclui um usuário pelo ID
    public function excluir($id) {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    
    // Busca um usuário pelo ID
    public function buscarPorId($id) {
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        // fetch() retorna um único registro ou false se não encontrar
        return $stmt->fetch();
    }
    
    // Busca um usuário pelo e-mail (útil para login e validações)
    public function buscarPorEmail($email) {
        $sql = "SELECT * FROM usuarios WHERE email = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email]);
        return $stmt->fetch();
    }
    
    // Lista todos os usuários cadastrados, ordenados alfabeticamente pelo nome
    public function listarTodos() {
        $sql = "SELECT * FROM usuarios ORDER BY nome";
        $stmt = $this->pdo->query($sql);
        // fetchAll() retorna um array com todos os registros
        return $stmt->fetchAll();
    }
}
?>
