<?php

namespace controller;

use service\ProdutoService;
use template\Template;
use template\ITemplate;

class Produto
{
    private ITemplate $template;
    
    public function __construct()
    {
        $this->template = new Template();
    }
    
    public function listar()
    {
        $service = new ProdutoService();
        $resultado = $service->listarProduto();
        $this->template->layout("\\public\\produto\\listar.php", $resultado);
    }
    
    public function inserir()
    {
        $dados = [
            'nome' => $_POST['nome'],
            'descricao' => $_POST['descricao'],
            'preco' => $_POST['preco']
        ];
        $service = new ProdutoService();
        $resultado = $service->inserir($dados);
        header("location: index.php?param=produto/lista&info=1");
    }
    
    public function formulario()
    {
        $this->template->layout("\\public\\produto\\form.php");
    }
    
    public function alterarForm()
    {
        $id = $_GET["id"];
        $service = new ProdutoService();
        $resultado = $service->listarId($id);
        
        // Controller processa os dados ANTES de passar para o template
        $produto = null;
        if ($resultado) {
            $dadosArray = $resultado->fetchAll();
            if (count($dadosArray) > 0) {
                $produto = $dadosArray[0]; // Pega o primeiro (e único) resultado
            }
        }
        
        $this->template->layout("\\public\\produto\\form.php", $produto);
    }
    
    public function alterar()
    {
        $dados = [
            'id' => $_POST['id'],
            'nome' => $_POST['nome'],
            'descricao' => $_POST['descricao'],
            'preco' => $_POST['preco']
        ];
        $service = new ProdutoService();
        $resultado = $service->atualizar($dados);
        header("location: index.php?param=produto/lista&info=2");
    }
    
    public function deletar()
    {
        $id = $_GET["id"];
        $service = new ProdutoService();
        $resultado = $service->excluir($id);
        header("location: index.php?param=produto/lista&info=3");
    }
}