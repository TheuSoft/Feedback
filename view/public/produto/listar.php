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
                        <button onclick="abrirModal('produto', <?= $produto['id'] ?>, '<?= htmlspecialchars(addslashes($produto['nome'])) ?>', '<?= htmlspecialchars(addslashes($produto['descricao'])) ?>', 'R$ <?= number_format($produto['preco'], 2, ',', '.') ?>')" class="btn btn-primary">Visualizar</button>
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
            <h3 id="modalTitulo">Visualizar Produto</h3>
            <span class="close" onclick="fecharModal()">&times;</span>
        </div>
        <div class="modal-body" id="modalCorpo">
            <!-- Conteúdo será inserido via JavaScript -->
        </div>
        <div class="modal-footer">
            <button class="btn btn-secondary" onclick="fecharModal()">Fechar</button>
            <a id="modalEditar" href="#" class="btn btn-warning">Editar</a>
            <a id="modalExcluir" href="#" class="btn btn-danger" onclick="return confirmarExclusao('produto')">Excluir</a>
        </div>
    </div>
</div>
