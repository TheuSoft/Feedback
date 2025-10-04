<?php
echo "<h1>Teste Simples</h1>";

// Incluir autoload
include "generic/Autoload.php";

// Testar carregamento direto de controller
echo "Testando controller diretamente:<br>";

try {
    $feedback = new controller\Feedback();
    echo "✅ Controller Feedback carregado<br>";
    
    echo "Testando método listar:<br>";
    $feedback->listar();
    
} catch (Exception $e) {
    echo "❌ Erro: " . $e->getMessage() . "<br>";
    echo "Stack trace: <pre>" . $e->getTraceAsString() . "</pre>";
}
?>