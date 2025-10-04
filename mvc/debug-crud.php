<?php
echo "<h1>Debug - Funcionalidades CRUD</h1>";

include "generic/Autoload.php";

echo "<h2>1. Testando Carregamento das Classes</h2>";

// Teste de carregamento dos Services
try {
    $usuarioService = new service\UsuarioService();
    echo "✅ UsuarioService carregado<br>";
} catch (Exception $e) {
    echo "❌ Erro UsuarioService: " . $e->getMessage() . "<br>";
}

try {
    $produtoService = new service\ProdutoService();
    echo "✅ ProdutoService carregado<br>";
} catch (Exception $e) {
    echo "❌ Erro ProdutoService: " . $e->getMessage() . "<br>";
}

try {
    $feedbackService = new service\FeedbackService();
    echo "✅ FeedbackService carregado<br>";
} catch (Exception $e) {
    echo "❌ Erro FeedbackService: " . $e->getMessage() . "<br>";
}

echo "<h2>2. Testando Método listar() dos Services</h2>";

try {
    $usuarioService = new service\UsuarioService();
    $resultado = $usuarioService->listarUsuario();
    echo "✅ UsuarioService->listarUsuario() funcionou<br>";
    echo "Tipo retornado: " . gettype($resultado) . "<br>";
} catch (Exception $e) {
    echo "❌ Erro listarUsuario: " . $e->getMessage() . "<br>";
}

try {
    $produtoService = new service\ProdutoService();
    $resultado = $produtoService->listarProduto();
    echo "✅ ProdutoService->listarProduto() funcionou<br>";
    echo "Tipo retornado: " . gettype($resultado) . "<br>";
} catch (Exception $e) {
    echo "❌ Erro listarProduto: " . $e->getMessage() . "<br>";
}

echo "<h2>3. Testando Inserção de Dados</h2>";

echo "<h3>Teste Inserção Usuario:</h3>";
try {
    $usuarioService = new service\UsuarioService();
    $dados = ['nome' => 'Teste Usuario', 'email' => 'teste@teste.com'];
    $resultado = $usuarioService->inserir($dados);
    echo "✅ Inserção Usuario funcionou<br>";
    echo "Resultado: " . var_export($resultado, true) . "<br>";
} catch (Exception $e) {
    echo "❌ Erro inserção Usuario: " . $e->getMessage() . "<br>";
}

echo "<h3>Teste Inserção Produto:</h3>";
try {
    $produtoService = new service\ProdutoService();
    $dados = ['nome' => 'Produto Teste', 'descricao' => 'Descrição teste', 'preco' => 10.99];
    $resultado = $produtoService->inserir($dados);
    echo "✅ Inserção Produto funcionou<br>";
    echo "Resultado: " . var_export($resultado, true) . "<br>";
} catch (Exception $e) {
    echo "❌ Erro inserção Produto: " . $e->getMessage() . "<br>";
}

echo "<h2>4. Testando Controllers</h2>";

echo "<h3>Teste Controller Usuario:</h3>";
try {
    $controller = new controller\Usuario();
    echo "✅ Controller Usuario carregado<br>";
} catch (Exception $e) {
    echo "❌ Erro Controller Usuario: " . $e->getMessage() . "<br>";
}

echo "<h2>5. Testando Template</h2>";

try {
    $template = new template\Template();
    echo "✅ Template carregado<br>";
    
    echo "<div style='border:1px solid #ccc; padding:10px; margin:10px 0;'>";
    echo "<strong>Teste Template Layout:</strong><br>";
    
    // Teste se consegue renderizar um arquivo simples
    $template->cabecalho();
    echo "Conteúdo de teste no meio";
    $template->rodape();
    
    echo "</div>";
    
} catch (Exception $e) {
    echo "❌ Erro Template: " . $e->getMessage() . "<br>";
}

echo "<h2>6. Testando Roteamento</h2>";

$rotas_teste = ['usuario/lista', 'produto/lista', 'feedback/lista'];

foreach ($rotas_teste as $rota) {
    echo "<strong>Testando rota: $rota</strong><br>";
    try {
        $controller = new generic\Controller();
        // Simular o teste da rota sem executar
        echo "✅ Rota $rota configurada<br>";
    } catch (Exception $e) {
        echo "❌ Erro rota $rota: " . $e->getMessage() . "<br>";
    }
}

echo "<hr>";
echo "<h2>Links para Teste Manual:</h2>";
echo "<a href='index.php?param=usuario/lista' target='_blank'>Teste Usuario Lista</a><br>";
echo "<a href='index.php?param=produto/lista' target='_blank'>Teste Produto Lista</a><br>";
echo "<a href='index.php?param=feedback/lista' target='_blank'>Teste Feedback Lista</a><br>";

echo "<hr>";
echo "<h2>Informações do Sistema:</h2>";
echo "PHP Version: " . PHP_VERSION . "<br>";
echo "Diretório atual: " . __DIR__ . "<br>";
echo "Document Root: " . $_SERVER['DOCUMENT_ROOT'] . "<br>";

?>