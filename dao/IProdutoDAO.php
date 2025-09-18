<?php
interface IProdutoDAO {
    public function inserir($nome, $descricao, $preco);
    public function atualizar($id, $nome, $descricao, $preco);
    public function excluir($id);
    public function buscarPorId($id);
    public function listarTodos();
}
?>
