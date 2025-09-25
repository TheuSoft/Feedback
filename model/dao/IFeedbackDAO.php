<?php
// Interface que define os métodos obrigatórios para um DAO de Feedback
// Garante que qualquer classe que implemente IFeedbackDAO tenha estas operações básicas
interface IFeedbackDAO {
    
    // Insere um novo feedback no banco
    public function inserir($usuarioId, $produtoId, $nota, $comentario);
    
    // Atualiza um feedback existente
    public function atualizar($id, $usuarioId, $produtoId, $nota, $comentario);
    
    // Exclui um feedback pelo ID
    public function excluir($id);
    
    // Busca um feedback pelo ID
    public function buscarPorId($id);
    
    // Lista todos os feedbacks cadastrados
    public function listarTodos();
    
    // Lista feedbacks de um produto específico
    public function listarPorProduto($produtoId);
    
    // Lista feedbacks de um usuário específico
    public function listarPorUsuario($usuarioId);
}
?>