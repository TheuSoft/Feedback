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

<div class="listing-header">
    <h2>Lista de Feedback</h2>
    <a href="?acao=feedback-form" class="btn">Novo Feedback</a>
</div>

<?php if (empty($feedbacks)): ?>
    <div class="alert alert-info empty-state">
        Nenhum feedback cadastrado ainda. <a href="?acao=feedback-form">Cadastre o primeiro feedback</a>.
    </div>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Produto</th>
                <th>Nota</th>
                <th>Comentário</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($feedbacks as $feedback): ?>
                <tr>
                    <td><?= htmlspecialchars($feedback['id']) ?></td>
                    <td><?= htmlspecialchars($feedback['usuario_nome']) ?></td>
                    <td><?= htmlspecialchars($feedback['produto_nome']) ?></td>
                    <td>
                        <div class="rating">
                            <?= exibirEstrelas($feedback['nota']) ?>
                        </div>
                    </td>
                    <td><?= htmlspecialchars(substr($feedback['comentario'], 0, 50)) ?>...</td>
                    <td>
                        <a href="?acao=feedback-editar&id=<?= $feedback['id'] ?>" class="btn btn-warning">Editar</a>
                        <a href="?acao=feedback-excluir&id=<?= $feedback['id'] ?>" 
                           class="btn btn-danger">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
