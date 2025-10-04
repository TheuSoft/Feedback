<?php
namespace dao;

interface IFeedbackDAO 
{
    public function inserir($feedback);
    public function atualizar($feedback);
    public function excluir($id);
    public function buscarPorId($id);
    public function buscarTodos();
    public function buscarPorUsuario($usuarioId);
    public function buscarPorProduto($produtoId);
    public function buscarPorAvaliacao($avaliacao);
}
