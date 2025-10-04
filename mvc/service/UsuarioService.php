<?php
namespace service;

use dao\mysql\UsuarioDAO;

class UsuarioService extends UsuarioDAO
{
    public function listarUsuario()
    {
        return parent::listar();
    }

    public function inserir($usuario)
    {
        return parent::inserir($usuario);
    }

    public function alterar($usuario)
    {
        return parent::atualizar($usuario);
    }

    public function listarId($id)
    {
        return parent::listarId($id);
    }
}