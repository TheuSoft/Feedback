<?php
if (!$feedback) {
    echo '<div class="alert alert-error">Feedback não encontrado.</div>';
    return;
}

// Função para exibir estrelas
function exibirEstrelas($nota) {
    $estrelas = '';
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $nota) {
            $estrelas .= '<span class="star filled">★</span>';
        } else {
            $estrelas .= '<span class="star">★</span>';
        }
    }
    return $estrelas;
}
?>

<div class="page-header">
    <h2>Visualizar Feedback</h2>
    <div class="actions">
        <a href="?acao=feedback" class="btn btn-primary">Voltar à Lista</a>
        <a href="?acao=feedback-editar&id=<?= $feedback['id'] ?>" class="btn btn-warning">Editar</a>
    </div>
</div>

<div class="view-container">
    <div class="view-group">
        <label>ID:</label>
        <div class="view-value"><?= htmlspecialchars($feedback['id']) ?></div>
    </div>
    
    <div class="view-group">
        <label>Usuário:</label>
        <div class="view-value"><?= htmlspecialchars($feedback['usuario_nome']) ?></div>
    </div>
    
    <div class="view-group">
        <label>Produto:</label>
        <div class="view-value"><?= htmlspecialchars($feedback['produto_nome']) ?></div>
    </div>
    
    <div class="view-group">
        <label>Nota:</label>
        <div class="view-value">
            <div class="rating">
                <?= exibirEstrelas($feedback['nota']) ?>
            </div>
            <span class="rating-text"><?= $feedback['nota'] ?>/5</span>
        </div>
    </div>
    
    <div class="view-group">
        <label>Comentário:</label>
        <div class="view-value view-text"><?= nl2br(htmlspecialchars($feedback['comentario'])) ?></div>
    </div>
</div>