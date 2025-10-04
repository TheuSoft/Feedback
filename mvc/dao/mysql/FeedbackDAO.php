<?php
namespace dao\mysql;

use dao\IFeedbackDAO;
use generic\MysqlFactory;

class FeedbackDAO extends MysqlFactory implements IFeedbackDAO 
{
    public function listar()
    {
        $sql = "SELECT f.*, u.nome as usuario_nome, p.nome as produto_nome 
               FROM feedback f 
               INNER JOIN usuarios u ON f.usuario_id = u.id 
               INNER JOIN produtos p ON f.produto_id = p.id 
               ORDER BY f.id DESC";
        $retorno = $this->banco->executar($sql);
        return $retorno;
    }

    public function listarId($id)
    {
        $sql = "SELECT f.*, u.nome as usuario_nome, p.nome as produto_nome 
               FROM feedback f 
               INNER JOIN usuarios u ON f.usuario_id = u.id 
               INNER JOIN produtos p ON f.produto_id = p.id 
               WHERE f.id = :id";
        $param = [
            ":id" => $id
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function inserir($feedback)
    {
        $sql = "INSERT INTO feedback (usuario_id, produto_id, nota, comentario) VALUES (:usuario_id, :produto_id, :nota, :comentario)";
        $param = [
            ":usuario_id" => $feedback['usuario_id'],
            ":produto_id" => $feedback['produto_id'],
            ":nota" => $feedback['nota'],
            ":comentario" => $feedback['comentario']
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function atualizar($feedback)
    {
        $sql = "UPDATE feedback SET nota = :nota, comentario = :comentario WHERE id = :id";
        $param = [
            ":nota" => $feedback['nota'],
            ":comentario" => $feedback['comentario'],
            ":id" => $feedback['id']
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno;
    }

    public function excluir($id)
    {
        $sql = "DELETE FROM feedback WHERE id = :id";
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

    public function buscarPorUsuario($usuarioId): array 
    {
        $sql = "SELECT f.*, u.nome as usuario_nome, p.nome as produto_nome 
               FROM feedback f 
               INNER JOIN usuarios u ON f.usuario_id = u.id 
               INNER JOIN produtos p ON f.produto_id = p.id 
               WHERE f.usuario_id = :usuario_id 
               ORDER BY f.id DESC";
        $param = [
            ":usuario_id" => $usuarioId
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno->fetchAll();
    }

    public function buscarPorProduto($produtoId): array 
    {
        $sql = "SELECT f.*, u.nome as usuario_nome, p.nome as produto_nome 
               FROM feedback f 
               INNER JOIN usuarios u ON f.usuario_id = u.id 
               INNER JOIN produtos p ON f.produto_id = p.id 
               WHERE f.produto_id = :produto_id 
               ORDER BY f.id DESC";
        $param = [
            ":produto_id" => $produtoId
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno->fetchAll();
    }

    public function buscarPorAvaliacao($nota): array 
    {
        $sql = "SELECT f.*, u.nome as usuario_nome, p.nome as produto_nome 
               FROM feedback f 
               INNER JOIN usuarios u ON f.usuario_id = u.id 
               INNER JOIN produtos p ON f.produto_id = p.id 
               WHERE f.nota = :nota 
               ORDER BY f.id DESC";
        $param = [
            ":nota" => $nota
        ];
        $retorno = $this->banco->executar($sql, $param);
        return $retorno->fetchAll();
    }

    public function obterEstatisticas(): array 
    {
        $sql = "SELECT 
                   COUNT(*) as total_feedbacks,
                   AVG(nota) as nota_media,
                   MIN(nota) as nota_minima,
                   MAX(nota) as nota_maxima
               FROM feedback";
        $retorno = $this->banco->executar($sql);
        return $retorno->fetch();
    }
}