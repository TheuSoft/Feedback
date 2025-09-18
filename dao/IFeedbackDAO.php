<?php
interface IFeedbackDAO {
    public function inserir($usuarioId, $produtoId, $nota, $comentario);
    public function atualizar($id, $usuarioId, $produtoId, $nota, $comentario);
    public function excluir($id);
    public function buscarPorId($id);
    public function listarTodos();
    public function listarPorProduto($produtoId);
    public function listarPorUsuario($usuarioId);
}
?>
