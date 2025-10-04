<?php
include "generic/Autoload.php";

echo "<h1>Debug - Cadastro de Feedback</h1>";

// Testar conexão
try {
    $usuarioService = new service\UsuarioService();
    $produtoService = new service\ProdutoService();
    
    echo "<h2>Verificando dados nas tabelas:</h2>";
    
    echo "<h3>Usuários disponíveis:</h3>";
    $usuarios = $usuarioService->listarUsuario();
    if ($usuarios) {
        $dadosUsuarios = $usuarios->fetchAll();
        if (count($dadosUsuarios) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Nome</th><th>Email</th></tr>";
            foreach ($dadosUsuarios as $usuario) {
                echo "<tr><td>{$usuario['id']}</td><td>{$usuario['nome']}</td><td>{$usuario['email']}</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>❌ Nenhum usuário encontrado. Cadastre usuários primeiro!</p>";
        }
    }
    
    echo "<h3>Produtos disponíveis:</h3>";
    $produtos = $produtoService->listarProduto();
    if ($produtos) {
        $dadosProdutos = $produtos->fetchAll();
        if (count($dadosProdutos) > 0) {
            echo "<table border='1'>";
            echo "<tr><th>ID</th><th>Nome</th><th>Descrição</th><th>Preço</th></tr>";
            foreach ($dadosProdutos as $produto) {
                echo "<tr><td>{$produto['id']}</td><td>{$produto['nome']}</td><td>{$produto['descricao']}</td><td>{$produto['preco']}</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<p>❌ Nenhum produto encontrado. Cadastre produtos primeiro!</p>";
        }
    }
    
} catch (Exception $e) {
    echo "Erro: " . $e->getMessage();
}

echo "<h2>Links úteis:</h2>";
echo "<a href='index.php?param=usuario/formulario'>Cadastrar Usuário</a><br>";
echo "<a href='index.php?param=produto/formulario'>Cadastrar Produto</a><br>";
echo "<a href='index.php?param=feedback/formulario'>Cadastrar Feedback</a><br>";
?>
