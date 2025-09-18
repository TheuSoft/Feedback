<?php
// Exibir mensagens de erro
if (isset($_SESSION['erro'])) {
    echo '<div class="alert alert-error">' . $_SESSION['erro'] . '</div>';
    unset($_SESSION['erro']);
}

$isEdit = isset($feedback) && $feedback;
?>

<div class="page-header">
    <h2><?= $isEdit ? 'Editar Feedback' : 'Novo Feedback' ?></h2>
    <a href="?acao=feedback" class="btn btn-primary">Voltar à Lista</a>
</div>

<?php if (empty($usuarios) || empty($produtos)): ?>
    <div class="alert alert-error">
        É necessário ter pelo menos um usuário e um produto cadastrados para criar um feedback.
        <br>
        <a href="?acao=usuario-form">Cadastrar Usuário</a> | 
        <a href="?acao=produto-form">Cadastrar Produto</a>
    </div>
<?php else: ?>
    <form method="POST" action="?acao=feedback-salvar">
        <?php if ($isEdit): ?>
            <input type="hidden" name="id" value="<?= htmlspecialchars($feedback['id']) ?>">
        <?php endif; ?>
        
        <div class="form-group">
            <label for="usuario_id">Usuário:</label>
            <select id="usuario_id" name="usuario_id" required>
                <option value="">Selecione um usuário</option>
                <?php foreach ($usuarios as $usuario): ?>
                    <option value="<?= $usuario['id'] ?>" 
                            <?= ($isEdit && $feedback['usuario_id'] == $usuario['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($usuario['nome']) ?> (<?= htmlspecialchars($usuario['email']) ?>)
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="produto_id">Produto:</label>
            <select id="produto_id" name="produto_id" required>
                <option value="">Selecione um produto</option>
                <?php foreach ($produtos as $produto): ?>
                    <option value="<?= $produto['id'] ?>" 
                            <?= ($isEdit && $feedback['produto_id'] == $produto['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($produto['nome']) ?> - R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="nota">Nota (1 a 5):</label>
            <select id="nota" name="nota" required>
                <option value="">Selecione uma nota</option>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <option value="<?= $i ?>" 
                            <?= ($isEdit && $feedback['nota'] == $i) ? 'selected' : '' ?>>
                        <?= $i ?> Estrela<?= $i > 1 ? 's' : '' ?>
                    </option>
                <?php endfor; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="comentario">Comentário:</label>
            <textarea id="comentario" 
                      name="comentario" 
                      rows="4" 
                      placeholder="Digite seu comentário sobre o produto..."><?= $isEdit ? htmlspecialchars($feedback['comentario']) : '' ?></textarea>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn">
                <?= $isEdit ? 'Atualizar Feedback' : 'Cadastrar Feedback' ?>
            </button>
            <a href="?acao=feedback" class="btn btn-primary">Cancelar</a>
        </div>
    </form>
<?php endif; ?>
