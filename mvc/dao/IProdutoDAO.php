<?php
namespace dao;

interface IProdutoDAO 
{
    public function inserir($produto);
    public function atualizar($produto);
    public function excluir($id);
    public function buscarPorId($id);
    public function buscarTodos();
    public function buscarPorNome($nome);
    public function buscarPorCategoria($categoria);
}
