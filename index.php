<?php
session_start();
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/generic/Autoload.php';

// Ativar autoload
Autoload::ativar();

// Verificar se tem uma ação na URL
$acao = $_GET['acao'] ?? 'home';

// Roteamento básico
switch ($acao) {
    case 'home':
        include_once __DIR__ . '/public/home.php';
        break;
    
    // Produtos
    case 'produto':
        $controller = new Produto();
        $controller->listar();
        break;
    case 'produto-form':
        $controller = new Produto();
        $controller->form();
        break;
    case 'produto-salvar':
        $controller = new Produto();
        $controller->salvar();
        break;
    case 'produto-editar':
        $controller = new Produto();
        $controller->editar();
        break;
    case 'produto-excluir':
        $controller = new Produto();
        $controller->excluir();
        break;
    
    // Usuários
    case 'usuario':
        $controller = new Usuario();
        $controller->listar();
        break;
    case 'usuario-form':
        $controller = new Usuario();
        $controller->form();
        break;
    case 'usuario-salvar':
        $controller = new Usuario();
        $controller->salvar();
        break;
    case 'usuario-editar':
        $controller = new Usuario();
        $controller->editar();
        break;
    case 'usuario-excluir':
        $controller = new Usuario();
        $controller->excluir();
        break;
    
    // Feedback
    case 'feedback':
        $controller = new Feedback();
        $controller->listar();
        break;
    case 'feedback-form':
        $controller = new Feedback();
        $controller->form();
        break;
    case 'feedback-salvar':
        $controller = new Feedback();
        $controller->salvar();
        break;
    case 'feedback-editar':
        $controller = new Feedback();
        $controller->editar();
        break;
    case 'feedback-excluir':
        $controller = new Feedback();
        $controller->excluir();
        break;
    
    default:
        http_response_code(404);
        echo "<h1>Página não encontrada</h1>";
        break;
}
?>
