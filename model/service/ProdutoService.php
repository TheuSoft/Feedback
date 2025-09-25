<?php
class ProdutoService {
    private $produtoDAO;
    
    public function __construct() {
        $this->produtoDAO = new ProdutoDAO();
    }
    
    public function salvar($nome, $descricao, $preco) {
        // Validações de negócio
        if (empty($nome)) {
            throw new Exception("Nome do produto é obrigatório");
        }
        
        if (empty($descricao)) {
            throw new Exception("Descrição do produto é obrigatória");
        }
        
        if (!is_numeric($preco) || $preco <= 0) {
            throw new Exception("Preço deve ser um valor positivo");
        }
        
        // Sanitizar dados
        $nome = trim($nome);
        $descricao = trim($descricao);
        $preco = (float) $preco;
        
        return $this->produtoDAO->inserir($nome, $descricao, $preco);
    }
    
    public function atualizar($id, $nome, $descricao, $preco) {
        // Validações de negócio
        if (empty($id) || !is_numeric($id)) {
            throw new Exception("ID do produto inválido");
        }
        
        if (empty($nome)) {
            throw new Exception("Nome do produto é obrigatório");
        }
        
        if (empty($descricao)) {
            throw new Exception("Descrição do produto é obrigatória");
        }
        
        if (!is_numeric($preco) || $preco <= 0) {
            throw new Exception("Preço deve ser um valor positivo");
        }
        
        // Verificar se produto existe
        $produto = $this->produtoDAO->buscarPorId($id);
        if (!$produto) {
            throw new Exception("Produto não encontrado");
        }
        
        // Sanitizar dados
        $nome = trim($nome);
        $descricao = trim($descricao);
        $preco = (float) $preco;
        
        return $this->produtoDAO->atualizar($id, $nome, $descricao, $preco);
    }
    
    public function excluir($id) {
        if (empty($id) || !is_numeric($id)) {
            throw new Exception("ID do produto inválido");
        }
        
        // Verificar se produto existe
        $produto = $this->produtoDAO->buscarPorId($id);
        if (!$produto) {
            throw new Exception("Produto não encontrado");
        }
        
        return $this->produtoDAO->excluir($id);
    }
    
    public function buscarPorId($id) {
        if (empty($id) || !is_numeric($id)) {
            throw new Exception("ID do produto inválido");
        }
        
        return $this->produtoDAO->buscarPorId($id);
    }
    
    public function listarTodos() {
        return $this->produtoDAO->listarTodos();
    }
}
?>
