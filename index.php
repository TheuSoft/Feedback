<?php
session_start();
require_once __DIR__ . '/config.php';
include "generic/Autoload.php";

use generic\Controller;

// Ativar autoload
Autoload::ativar();

// Verificar se tem uma ação na URL
if (isset($_GET["acao"])) {
    $param = $_GET["acao"];
    
    // Caso especial para home
    if ($param === 'home') {
        include_once __DIR__ . '/public/home.php';
        exit;
    }
    
    // Determinar o controller baseado no parâmetro
    $controllerName = null;
    
    // Identificar o tipo de controller pelo prefixo
    if (strpos($param, 'produto') === 0) {
        $controllerName = 'Produto';
    } elseif (strpos($param, 'usuario') === 0) {
        $controllerName = 'Usuario';
    } elseif (strpos($param, 'feedback') === 0) {
        $controllerName = 'Feedback';
    }
    
    // Se encontrou um controller válido, instancia e executa
    if ($controllerName && class_exists($controllerName)) {
        $controller = new $controllerName();
        $controller->verificarChamadas($param);
    } else {
        // Página não encontrada
        http_response_code(404);
        echo "<h1>Página não encontrada</h1>";
    }
} else {
    // Sem parâmetro, vai para home
    include_once __DIR__ . '/public/home.php';
}
?>
