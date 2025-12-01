<?php
// Dados já processados pelo Controller
$produto = $parametro ?? null;
$isEdit = ($produto != null);
?>
<div class="form-container">
    <div class="form-header">
        <h2 class="form-titulo">📦 <?= $isEdit ? 'Editar Produto' : 'Cadastrar Produto' ?></h2>
    </div>
    
    <div class="form-content">
        <form method="POST" action="<?= $isEdit ? 'index.php?param=produto/alterar' : 'index.php?param=produto/inserir' ?>"
              <?= $isEdit ? 'onsubmit="return confirmarAlteracao(\'produto\', \'' . htmlspecialchars($produto["nome"]) . '\')"' : '' ?>>
            <div class="form-group">
                <label class="form-label">Nome:</label>
                <input type="text" name="nome" class="form-input"
                       value="<?= $isEdit ? $produto["nome"] : "" ?>" 
                       placeholder="Digite o nome do produto" required />
            </div>
            
            <div class="form-group">
                <label class="form-label">Descrição:</label>
                <textarea name="descricao" class="form-textarea" 
                          placeholder="Digite a descrição do produto"><?= $isEdit ? $produto["descricao"] : "" ?></textarea>
            </div>
            
            <div class="form-group">
                <label class="form-label">Preço:</label>
                <input type="number" step="0.01" name="preco" class="form-input"
                       value="<?= $isEdit ? $produto["preco"] : "" ?>" 
                       placeholder="0.00" required />
            </div>

            <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?= $produto["id"] ?>" />
            <?php endif; ?>
            
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <?= $isEdit ? '✏️ Atualizar' : '➕ Cadastrar' ?>
                </button>
                <a href="index.php?param=produto/lista" class="btn-cancelar">❌ Cancelar</a>
            </div>
        </form>
    </div>
</div>
