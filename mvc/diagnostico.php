<?php
echo "<h2>Teste de Diagnóstico - Sistema MVC</h2>";

// Teste 1: Verificar se o PHP está funcionando
echo "<h3>1. PHP Funcionando:</h3>";
echo "✅ PHP está rodando - Versão: " . PHP_VERSION . "<br><br>";

// Teste 2: Verificar se o autoload existe
echo "<h3>2. Teste do Autoload:</h3>";
if (file_exists("generic/Autoload.php")) {
    echo "✅ Arquivo Autoload.php encontrado<br>";
    include "generic/Autoload.php";
    echo "✅ Autoload incluído com sucesso<br>";
} else {
    echo "❌ Arquivo Autoload.php NÃO encontrado<br>";
}

// Teste 3: Verificar estrutura de diretórios
echo "<h3>3. Estrutura de Diretórios:</h3>";
$diretorios = ['generic', 'controller', 'service', 'dao', 'dao/mysql', 'template', 'public'];
foreach ($diretorios as $dir) {
    if (is_dir($dir)) {
        echo "✅ Diretório $dir existe<br>";
    } else {
        echo "❌ Diretório $dir NÃO existe<br>";
    }
}

// Teste 4: Verificar arquivos principais
echo "<h3>4. Arquivos Principais:</h3>";
$arquivos = [
    'generic/Controller.php',
    'generic/Acao.php', 
    'generic/MysqlSingleton.php',
    'controller/Feedback.php',
    'service/FeedbackService.php'
];
foreach ($arquivos as $arquivo) {
    if (file_exists($arquivo)) {
        echo "✅ $arquivo existe<br>";
    } else {
        echo "❌ $arquivo NÃO existe<br>";
    }
}

// Teste 5: Tentar carregar uma classe
echo "<h3>5. Teste de Carregamento de Classes:</h3>";
try {
    $controller = new generic\Controller();
    echo "✅ Classe Controller carregada com sucesso<br>";
} catch (Exception $e) {
    echo "❌ Erro ao carregar Controller: " . $e->getMessage() . "<br>";
}

// Teste 6: Verificar parâmetros GET
echo "<h3>6. Parâmetros da URL:</h3>";
if (isset($_GET['param'])) {
    echo "✅ Parâmetro recebido: " . $_GET['param'] . "<br>";
} else {
    echo "⚠️ Nenhum parâmetro recebido<br>";
    echo "Teste os links abaixo:<br>";
    echo "<a href='?param=feedback/lista'>Feedback Lista</a><br>";
    echo "<a href='?param=produto/lista'>Produto Lista</a><br>";
}

// Teste 7: Verificar conexão com banco (básico)
echo "<h3>7. Teste de Conexão com Banco:</h3>";
try {
    $pdo = new PDO('mysql:host=localhost;dbname=feedback_db', 'root', '');
    echo "✅ Conexão com banco de dados bem-sucedida<br>";
} catch (PDOException $e) {
    echo "❌ Erro de conexão com banco: " . $e->getMessage() . "<br>";
    echo "⚠️ Verifique se o MySQL está rodando e se o banco 'feedback_db' existe<br>";
}

echo "<hr>";
echo "<h3>Próximos Passos:</h3>";
echo "1. Verifique todos os ✅ acima<br>";
echo "2. Se houver ❌, precisamos corrigir esses problemas primeiro<br>";
echo "3. Teste a URL: <a href='index.php?param=feedback/lista'>index.php?param=feedback/lista</a><br>";
?>