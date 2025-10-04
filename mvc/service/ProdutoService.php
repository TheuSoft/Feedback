<?php
namespace service;

use dao\mysql\ProdutoDAO;

class ProdutoService extends ProdutoDAO
{
    public function listarProduto()
    {
        return parent::listar();
    }

    public function inserir($produto)
    {
        return parent::inserir($produto);
    }

    public function alterar($produto)
    {
        return parent::atualizar($produto);
    }

    public function listarId($id)
    {
        return parent::listarId($id);
    }
}