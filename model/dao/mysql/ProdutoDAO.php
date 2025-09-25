<?php
// Classe responsável por acessar e manipular dados da tabela "produtos"
// Implementa a interface IProdutoDAO, garantindo consistência entre os métodos
class ProdutoDAO implements IProdutoDAO {
    private $pdo; // Objeto PDO para conexão com o banco
    
    // Construtor: ao instanciar a classe, já pega a conexão com o banco via Singleton
    public function __construct() {
        $this->pdo = MysqlSingleton::getInstance()->getConnection();
    }
    
    // Inserir um novo produto no banco
    public function inserir($nome, $descricao, $preco) {
        $sql = "INSERT INTO produtos (nome, descricao, preco) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        // Executa passando os valores na ordem dos placeholders
        return $stmt->execute([$nome, $descricao, $preco]);
    }
    
    // Atualizar os dados de um produto já existente
    public function atualizar($id, $nome, $descricao, $preco) {
        $sql = "UPDATE produtos 
                SET nome = ?, descricao = ?, preco = ? 
                WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $descricao, $preco, $id]);
    }
    
    // Excluir um produto pelo seu ID
    public function excluir($id) {
        $sql = "DELETE FROM produtos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }
    
    // Buscar produto pelo ID
    public function buscarPorId($id) {
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);
        // fetch() retorna apenas um registro (ou false se não encontrar)
        return $stmt->fetch();
    }
    
    // Listar todos os produtos cadastrados, ordenados por nome
    public function listarTodos() {
        $sql = "SELECT * FROM produtos ORDER BY nome";
        // query() é suficiente pois não tem parâmetros variáveis
        $stmt = $this->pdo->query($sql);
        // fetchAll() retorna todos os registros em forma de array
        return $stmt->fetchAll();
    }
}
?>
