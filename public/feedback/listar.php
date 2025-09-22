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
                        <div class="rating readonly">
                            <?= exibirEstrelas($feedback['nota']) ?>
                        </div>
                    </td>
                    <td><?= htmlspecialchars(substr($feedback['comentario'], 0, 50)) ?>...</td>
                    <td>
                        <button onclick="abrirModal('feedback', <?= $feedback['id'] ?>, '<?= htmlspecialchars(addslashes($feedback['usuario_nome'])) ?>', '<?= htmlspecialchars(addslashes($feedback['produto_nome'])) ?>', <?= $feedback['nota'] ?>, '<?= htmlspecialchars(addslashes($feedback['comentario'])) ?>')" class="btn btn-info">Visualizar</button>
                        <a href="?acao=feedback-editar&id=<?= $feedback['id'] ?>" class="btn btn-warning">Editar</a>
                        <a href="?acao=feedback-excluir&id=<?= $feedback['id'] ?>" 
                           class="btn btn-danger">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<!-- Modal de Visualização -->
<div id="modalVisualizacao" class="modal" onclick="fecharModal(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <h3 id="modalTitulo">Visualizar Feedback</h3>
            <span class="close" onclick="fecharModal()">&times;</span>
        </div>
        <div class="modal-body" id="modalCorpo">
            <!-- Conteúdo será inserido via JavaScript -->
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="fecharModal()">Fechar</button>
            <a id="modalEditar" href="#" class="btn btn-warning">Editar</a>
        </div>
    </div>
</div>