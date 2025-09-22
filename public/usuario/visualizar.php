<?php
if (!$usuario) {
    echo '<div class="alert alert-error">Usuário não encontrado.</div>';
    return;
}
?>

<div class="page-header">
    <h2>Visualizar Usuário</h2>
    <div class="actions">
        <a href="?acao=usuario" class="btn btn-primary">Voltar à Lista</a>
        <a href="?acao=usuario-editar&id=<?= $usuario['id'] ?>" class="btn btn-warning">Editar</a>
    </div>
</div>

<div class="view-container">
    <div class="view-group">
        <label>ID:</label>
        <div class="view-value"><?= htmlspecialchars($usuario['id']) ?></div>
    </div>
    
    <div class="view-group">
        <label>Nome:</label>
        <div class="view-value"><?= htmlspecialchars($usuario['nome']) ?></div>
    </div>
    
    <div class="view-group">
        <label>Email:</label>
        <div class="view-value"><?= htmlspecialchars($usuario['email']) ?></div>
    </div>
</div>