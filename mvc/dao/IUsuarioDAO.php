<?php
namespace dao;

interface IUsuarioDAO 
{
    public function inserir($usuario);
    public function atualizar($usuario);
    public function excluir($id);
    public function buscarPorId($id);
    public function buscarTodos();
    public function buscarPorEmail($email);
    public function autenticar($email, $senha);
}
