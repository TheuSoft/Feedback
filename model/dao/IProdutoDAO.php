<?php
// Interface que define os métodos obrigatórios para um DAO de Produto
// Garante que qualquer classe que implemente IProdutoDAO (ex: ProdutoDAO)
// tenha as operações básicas de manipulação de dados no banco
interface IProdutoDAO {
    
    // Insere um novo produto no banco
    public function inserir($nome, $descricao, $preco);
    
    // Atualiza os dados de um produto existente
    public function atualizar($id, $nome, $descricao, $preco);
    
    // Exclui um produto pelo ID
    public function excluir($id);
    
    // Busca um produto pelo ID
    public function buscarPorId($id);
    
    // Lista todos os produtos cadastrados
    public function listarTodos();
}
?>
