<?php
echo "<h2>Teste Final - Sistema Corrigido</h2>";

// Incluir autoload
include "generic/Autoload.php";

// Teste de conexão corrigida
echo "<h3>1. Teste de Conexão com Banco Corrigido:</h3>";
try {
    $pdo = new PDO('mysql:host=localhost;dbname=feedback_db', 'root', '');
    echo "✅ Conexão com banco 'feedback_db' bem-sucedida<br>";
} catch (PDOException $e) {
    echo "❌ Erro: " . $e->getMessage() . "<br>";
}

// Teste do MysqlSingleton
echo "<h3>2. Teste do MysqlSingleton:</h3>";
try {
    $singleton = generic\MysqlSingleton::getInstance();
    echo "✅ MysqlSingleton carregado<br>";
    
    $result = $singleton->executar("SELECT 1 as teste");
    if ($result) {
        echo "✅ Método executar funcionando<br>";
    } else {
        echo "❌ Método executar com problema<br>";
    }
} catch (Exception $e) {
    echo "❌ Erro no MysqlSingleton: " . $e->getMessage() . "<br>";
}

// Teste do Service
echo "<h3>3. Teste do FeedbackService:</h3>";
try {
    $service = new service\FeedbackService();
    echo "✅ FeedbackService carregado<br>";
} catch (Exception $e) {
    echo "❌ Erro no FeedbackService: " . $e->getMessage() . "<br>";
}

// Teste do Controller
echo "<h3>4. Teste do Controller:</h3>";
try {
    $controller = new controller\Feedback();
    echo "✅ Controller Feedback carregado<br>";
} catch (Exception $e) {
    echo "❌ Erro no Controller: " . $e->getMessage() . "<br>";
}

// Teste do Template
echo "<h3>5. Teste do Template:</h3>";
try {
    $template = new template\Template();
    echo "✅ Template carregado<br>";
    
    echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px 0;'>";
    echo "<strong>Teste de Layout:</strong><br>";
    $template->cabecalho();
    echo "Conteúdo de teste aqui";
    $template->rodape();
    echo "</div>";
    
} catch (Exception $e) {
    echo "❌ Erro no Template: " . $e->getMessage() . "<br>";
}

echo "<hr>";
echo "<h3>Links para Testar o Sistema:</h3>";
echo "<a href='index.php?param=feedback/lista' style='display: block; margin: 5px 0;'>🔗 Feedback Lista</a>";
echo "<a href='index.php?param=produto/lista' style='display: block; margin: 5px 0;'>🔗 Produto Lista</a>";
echo "<a href='index.php?param=usuario/lista' style='display: block; margin: 5px 0;'>🔗 Usuario Lista</a>";

echo "<hr>";
echo "<p><strong>Se todos os testes acima mostraram ✅, o sistema deve funcionar!</strong></p>";
?>