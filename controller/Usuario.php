<?php

namespace controller;

use service\UsuarioService;
use template\Template;
use template\ITemplate;

class Usuario
{
    private ITemplate $template;
    
    public function __construct()
    {
        $this->template = new Template();
    }
    
    public function listar()
    {
        $service = new UsuarioService();
        $resultado = $service->listarUsuario();
        $this->template->layout("\\public\\usuario\\listar.php", $resultado);
    }
    
    public function inserir()
    {
        $dados = [
            'nome' => $_POST['nome'],
            'email' => $_POST['email']
        ];
        $service = new UsuarioService();
        $resultado = $service->inserir($dados);
        header("location: index.php?param=usuario/lista&info=1");
    }
    
    public function formulario()
    {
        $this->template->layout("\\public\\usuario\\form.php");
    }
    
    public function alterarForm()
    {
        $id = $_GET["id"];
        $service = new UsuarioService();
        $resultado = $service->listarId($id);
        
        // Controller processa os dados ANTES de passar para o template
        $usuario = null;
        if ($resultado) {
            $dadosArray = $resultado->fetchAll();
            if (count($dadosArray) > 0) {
                $usuario = $dadosArray[0]; // Pega o primeiro (e único) resultado
            }
        }
        
        $this->template->layout("\\public\\usuario\\form.php", $usuario);
    }
    
    public function alterar()
    {
        $dados = [
            'id' => $_POST['id'],
            'nome' => $_POST['nome'],
            'email' => $_POST['email']
        ];
        $service = new UsuarioService();
        $resultado = $service->atualizar($dados);
        header("location: index.php?param=usuario/lista&info=2");
    }
    
    public function deletar()
    {
        $id = $_GET["id"];
        $service = new UsuarioService();
        $resultado = $service->excluir($id);
        header("location: index.php?param=usuario/lista&info=3");
    }
}