<?php
interface IUsuarioDAO {
    public function inserir($nome, $email);
    public function atualizar($id, $nome, $email);
    public function excluir($id);
    public function buscarPorId($id);
    public function buscarPorEmail($email);
    public function listarTodos();
}
?>
