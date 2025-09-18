<?php
// Exibir mensagens
if (isset($_SESSION['mensagem'])) {
    echo '<div class="alert alert-success">' . $_SESSION['mensagem'] . '</div>';
    unset($_SESSION['mensagem']);
}

if (isset($_SESSION['erro'])) {
    echo '<div class="alert alert-error">' . $_SESSION['erro'] . '</div>';
    unset($_SESSION['erro']);
}
?>

<div class="listing-header">
    <h2>Lista de Produtos</h2>
    <a href="?acao=produto-form" class="btn">Novo Produto</a>
</div>

<?php if (empty($produtos)): ?>
    <div class="alert alert-info empty-state">
        Nenhum produto cadastrado ainda. <a href="?acao=produto-form">Cadastre o primeiro produto</a>.
    </div>
<?php else: ?>
    <table class="table">
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
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= htmlspecialchars($produto['id']) ?></td>
                    <td><?= htmlspecialchars($produto['nome']) ?></td>
                    <td><?= htmlspecialchars(substr($produto['descricao'], 0, 50)) ?>...</td>
                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                    <td>
                        <a href="?acao=produto-editar&id=<?= $produto['id'] ?>" class="btn btn-warning">Editar</a>
                        <a href="?acao=produto-excluir&id=<?= $produto['id'] ?>" 
                           class="btn btn-danger">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
