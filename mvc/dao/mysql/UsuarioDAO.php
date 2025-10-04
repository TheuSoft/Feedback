<?php
namespace dao\mysql;

use dao\IUsuarioDAO;
use generic\MysqlFactory;

class UsuarioDAO extends MysqlFactory implements IUsuarioDAO 
{
    public function listar()
    {
        $sql = "SELECT id, nome, email FROM usuarios ORDER BY nome";
        $retorno = $this->banco->executar($sql);
        return $retorno;
    }

    public function listarId($id)
    {
        $sql = "SELECT id, nome, email FROM usuarios WHERE id = :id";
        $param = [
            ":id" => $id
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function inserir($usuario)
    {
        $sql = "INSERT INTO usuarios (nome, email) VALUES (:nome, :email)";
        $param = [
            ":nome" => $usuario['nome'],
            ":email" => $usuario['email']
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function atualizar($usuario)
    {
        $sql = "UPDATE usuarios SET nome = :nome, email = :email WHERE id = :id";
        $param = [
            ":nome" => $usuario['nome'],
            ":email" => $usuario['email'],
            ":id" => $usuario['id']
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $param = [
            ":id" => $id
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function buscarTodos(): array 
    {
        return $this->listar()->fetchAll();
    }

    public function buscarPorId($id): ?array 
    {
        $result = $this->listarId($id)->fetch();
        return $result ?: null;
    }

    public function buscarPorEmail($email): ?array 
    {
        $sql = "SELECT id, nome, email FROM usuarios WHERE email = :email";
        $param = [
            ":email" => $email
        ];
        $retorno = $this->banco->executar($sql, $param);
        $result = $retorno->fetch();
        return $result ?: null;
    }

    public function autenticar($email, $senha): ?array 
    {
        $sql = "SELECT id, nome, email FROM usuarios WHERE email = :email";
        $param = [
            ":email" => $email
        ];
        $retorno = $this->banco->executar($sql, $param);
        $usuario = $retorno->fetch();
        
        return $usuario ?: null;
    }
}
