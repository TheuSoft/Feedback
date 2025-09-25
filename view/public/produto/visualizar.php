<?php
if (!$produto) {
    echo '<div class="alert alert-error">Produto não encontrado.</div>';
    return;
}
?>

<div class="page-header">
    <h2>Visualizar Produto</h2>
    <div class="actions">
        <a href="?acao=produto" class="btn btn-primary">Voltar à Lista</a>
        <a href="?acao=produto-editar&id=<?= $produto['id'] ?>" class="btn btn-warning">Editar</a>
    </div>
</div>

<div class="view-container">
    <div class="view-group">
        <label>ID:</label>
        <div class="view-value"><?= htmlspecialchars($produto['id']) ?></div>
    </div>
    
    <div class="view-group">
        <label>Nome do Produto:</label>
        <div class="view-value"><?= htmlspecialchars($produto['nome']) ?></div>
    </div>
    
    <div class="view-group">
        <label>Descrição:</label>
        <div class="view-value view-text"><?= nl2br(htmlspecialchars($produto['descricao'])) ?></div>
    </div>
    
    <div class="view-group">
        <label>Preço:</label>
        <div class="view-value">R$ <?= number_format($produto['preco'], 2, ',', '.') ?></div>
    </div>
</div>