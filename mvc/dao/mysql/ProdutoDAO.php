<?php
namespace dao\mysql;

use dao\IProdutoDAO;
use generic\MysqlFactory;

class ProdutoDAO extends MysqlFactory implements IProdutoDAO 
{
    public function listar()
    {
        $sql = "SELECT * FROM produtos ORDER BY nome";
        $retorno = $this->banco->executar($sql);
        return $retorno;
    }

    public function listarId($id)
    {
        $sql = "SELECT * FROM produtos WHERE id = :id";
        $param = [
            ":id" => $id
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function inserir($produto)
    {
        $sql = "INSERT INTO produtos (nome, descricao, preco) VALUES (:nome, :descricao, :preco)";
        $param = [
            ":nome" => $produto['nome'],
            ":descricao" => $produto['descricao'],
            ":preco" => $produto['preco']
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function atualizar($produto)
    {
        $sql = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco WHERE id = :id";
        $param = [
            ":nome" => $produto['nome'],
            ":descricao" => $produto['descricao'],
            ":preco" => $produto['preco'],
            ":id" => $produto['id']
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM produtos WHERE id = :id";
        $param = [
            ":id" => $id
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    // Métodos da interface IProdutoDAO
    public function buscarTodos(): array 
    {
        return $this->listar()->fetchAll();
    }

    public function buscarPorId($id): ?array 
    {
        $result = $this->listarId($id)->fetch();
        return $result ?: null;
    }

    public function buscarPorCategoria($categoria): array 
    {
        $sql = "SELECT * FROM produtos WHERE categoria = :categoria ORDER BY nome";
        $param = [
            ":categoria" => $categoria
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno->fetchAll();
    }

    public function buscarPorNome($nome): array 
    {
        $sql = "SELECT * FROM produtos WHERE nome LIKE :nome ORDER BY nome";
        $param = [
            ":nome" => "%$nome%"
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno->fetchAll();
    }

    public function buscarPorFaixaPreco($precoMin, $precoMax): array 
    {
        $sql = "SELECT * FROM produtos WHERE preco BETWEEN :preco_min AND :preco_max ORDER BY preco";
        $param = [
            ":preco_min" => $precoMin,
            ":preco_max" => $precoMax
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno->fetchAll();
    }
}
