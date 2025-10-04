<?php
echo "<h1>Debug - Teste de Formulários e Ações</h1>";

echo "<h2>1. Dados recebidos via POST/GET:</h2>";
echo "<strong>GET:</strong><br>";
var_dump($_GET);
echo "<br><br><strong>POST:</strong><br>";
var_dump($_POST);

echo "<h2>2. Parâmetros da URL:</h2>";
if (isset($_GET['param'])) {
    $param = $_GET['param'];
    echo "Parâmetro: $param<br>";
    
    $partes = explode('/', $param);
    echo "Partes: ";
    var_dump($partes);
    
    if (count($partes) >= 2) {
        $entidade = $partes[0];
        $acao = $partes[1];
        echo "<br>Entidade: $entidade<br>";
        echo "Ação: $acao<br>";
    }
} else {
    echo "Nenhum parâmetro 'param' encontrado<br>";
}

echo "<h2>3. Simulação de Formulários de Teste:</h2>";

// Formulário Usuario
echo "<h3>Formulário Usuario:</h3>";
echo "<form method='POST' action='index.php?param=usuario/inserir' style='border:1px solid #ccc; padding:10px; margin:10px;'>";
echo "Nome: <input type='text' name='nome' value='João Silva'><br><br>";
echo "Email: <input type='text' name='email' value='joao@teste.com'><br><br>";
echo "<input type='submit' value='Inserir Usuario'>";
echo "</form>";

// Formulário Produto
echo "<h3>Formulário Produto:</h3>";
echo "<form method='POST' action='index.php?param=produto/inserir' style='border:1px solid #ccc; padding:10px; margin:10px;'>";
echo "Nome: <input type='text' name='nome' value='Produto Teste'><br><br>";
echo "Descrição: <input type='text' name='descricao' value='Descrição do produto'><br><br>";
echo "Preço: <input type='text' name='preco' value='25.90'><br><br>";
echo "<input type='submit' value='Inserir Produto'>";
echo "</form>";

// Formulário Feedback
echo "<h3>Formulário Feedback:</h3>";
echo "<form method='POST' action='index.php?param=feedback/inserir' style='border:1px solid #ccc; padding:10px; margin:10px;'>";
echo "ID Usuario: <input type='text' name='id_usuario' value='1'><br><br>";
echo "ID Produto: <input type='text' name='id_produto' value='1'><br><br>";
echo "Comentário: <textarea name='comentario'>Comentário de teste</textarea><br><br>";
echo "Nota: <input type='text' name='nota' value='5'><br><br>";
echo "<input type='submit' value='Inserir Feedback'>";
echo "</form>";

echo "<h2>4. Links para Navegação:</h2>";
echo "<a href='index.php?param=usuario/lista'>Lista Usuarios</a> | ";
echo "<a href='index.php?param=produto/lista'>Lista Produtos</a> | ";
echo "<a href='index.php?param=feedback/lista'>Lista Feedbacks</a><br><br>";

echo "<a href='index.php?param=usuario/cadastrar'>Cadastrar Usuario</a> | ";
echo "<a href='index.php?param=produto/cadastrar'>Cadastrar Produto</a> | ";
echo "<a href='index.php?param=feedback/cadastrar'>Cadastrar Feedback</a><br><br>";

// Teste direto do Controller
echo "<h2>5. Teste Direto Controller:</h2>";

include "generic/Autoload.php";

try {
    echo "<strong>Testando Controller genérico:</strong><br>";
    $controller = new generic\Controller();
    echo "✅ Controller carregado com sucesso<br>";
    
    // Verificar se tem métodos
    $metodos = get_class_methods($controller);
    echo "Métodos disponíveis: ";
    var_dump($metodos);
    
} catch (Exception $e) {
    echo "❌ Erro no Controller: " . $e->getMessage() . "<br>";
}

echo "<hr>";
echo "<h2>6. Verificação de Arquivos Críticos:</h2>";

$arquivos_criticos = [
    'index.php',
    'generic/Controller.php',
    'generic/Autoload.php',
    'controller/Usuario.php',
    'controller/Produto.php',  
    'controller/Feedback.php',
    'service/UsuarioService.php',
    'service/ProdutoService.php',
    'service/FeedbackService.php'
];

foreach ($arquivos_criticos as $arquivo) {
    if (file_exists($arquivo)) {
        echo "✅ $arquivo existe<br>";
    } else {
        echo "❌ $arquivo NÃO EXISTE<br>";
    }
}

?>