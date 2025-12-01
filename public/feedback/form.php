<?php
// Dados já processados pelo Controller
$feedback = isset($parametro['feedback']) ? $parametro['feedback'] : null;
$usuarios = isset($parametro['usuarios']) ? $parametro['usuarios'] : [];
$produtos = isset($parametro['produtos']) ? $parametro['produtos'] : [];
$isEdit = ($feedback != null);
?>
<div class="form-container">
    <div class="form-header">
        <h2 class="form-titulo">💬 <?= $isEdit ? 'Editar Feedback' : 'Cadastrar Feedback' ?></h2>
    </div>
    
    <div class="form-content">
        <form method="POST" action="<?= $isEdit ? 'index.php?param=feedback/alterar' : 'index.php?param=feedback/inserir' ?>"
              <?= $isEdit ? 'onsubmit="return confirmarAlteracao(\'feedback\', \'ID: ' . $feedback["id"] . '\')"' : '' ?>>              
            <div class="form-group">
                <label class="form-label">Usuário:</label>
                <select name="usuario_id" class="form-select" required>
                    <option value="">Selecione um usuário</option>
                    <?php foreach ($usuarios as $usuario): ?>
                        <option value="<?= $usuario['id'] ?>" 
                            <?= ($isEdit && $feedback['usuario_id'] == $usuario['id']) ? 'selected' : '' ?>>
                            <?= $usuario['nome'] ?> (<?= $usuario['email'] ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="form-help">Selecione o usuário que está dando o feedback</div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Produto:</label>
                <select name="produto_id" class="form-select" required>
                    <option value="">Selecione um produto</option>
                    <?php foreach ($produtos as $produto): ?>
                        <option value="<?= $produto['id'] ?>" 
                            <?= ($isEdit && $feedback['produto_id'] == $produto['id']) ? 'selected' : '' ?>>
                            <?= $produto['nome'] ?> - R$ <?= number_format($produto['preco'], 2, ',', '.') ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <div class="form-help">Selecione o produto que está sendo avaliado</div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Nota:</label>
                <select name="nota" class="form-select" required>
                    <option value="">Selecione uma nota</option>
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                        <option value="<?= $i ?>" 
                            <?= ($isEdit && $feedback['nota'] == $i) ? 'selected' : '' ?>>
                            <?= str_repeat('⭐', $i) ?> (<?= $i ?> estrela<?= $i > 1 ? 's' : '' ?>)
                        </option>
                    <?php endfor; ?>
                </select>
                <div class="form-help">Avalie de 1 a 5 estrelas</div>
            </div>
            
            <div class="form-group">
                <label class="form-label">Comentário:</label>
                <textarea name="comentario" class="form-textarea" 
                          placeholder="Digite seu comentário sobre o produto..."><?= $isEdit ? $feedback["comentario"] : "" ?></textarea>
                <div class="form-help">Descreva sua experiência com o produto</div>
            </div>
            
            <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?= $feedback["id"] ?>" />
            <?php endif; ?>
            
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <?= $isEdit ? '✏️ Atualizar Feedback' : '💬 Cadastrar Feedback' ?>
                </button>
                <a href="index.php?param=feedback/lista" class="btn-cancelar">❌ Cancelar</a>
            </div>
        </form>
    </div>
</div>
