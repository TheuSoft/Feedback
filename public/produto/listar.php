
<div class="lista-container">
    <div class="lista-header">
        <h2 class="lista-titulo">📦 Gerenciar Produtos</h2>
        <a href="index.php?param=produto/formulario" class="btn-cadastrar">+ Cadastrar Produto</a>
    </div>
    
    <table class="tabela-lista">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach( $parametro as $p): ?>
            <tr>
                <td><?= $p["id"] ?></td>
                <td><?= $p["nome"] ?></td>
                <td><?= $p["descricao"] ?></td>
                <td class="preco">R$ <?= number_format($p["preco"], 2, ',', '.') ?></td>
                <td>
                    <a href="index.php?param=produto/formularioalterar&id=<?= $p["id"] ?>" class="btn-acao">✏️ Alterar</a>
                    <a href="index.php?param=produto/deletar&id=<?= $p["id"] ?>" class="btn-acao btn-deletar" onclick="return confirmarExclusao('produto', '<?= htmlspecialchars($p["nome"]) ?>', this.href)">🗑️ Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
