<?php
// Teste simples para debug
echo "Sistema MVC Carregado!<br>";
echo "Data: " . date('Y-m-d H:i:s') . "<br>";
echo "Parâmetro recebido: " . ($_GET['param'] ?? 'Nenhum') . "<br>";

include "generic/Autoload.php";

use generic\Controller;

if (isset($_GET["param"])) {
    echo "Iniciando processamento da rota: " . $_GET["param"] . "<br>";
    
    try {
        $controller = new Controller();
        $controller->verificarChamadas($_GET["param"]);
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage() . "<br>";
    }
} else {
    echo "Links para teste:<br>";
    echo "<a href='?param=feedback/lista'>Feedback Lista</a><br>";
    echo "<a href='?param=produto/lista'>Produto Lista</a><br>";
    echo "<a href='?param=usuario/lista'>Usuario Lista</a><br>";
}