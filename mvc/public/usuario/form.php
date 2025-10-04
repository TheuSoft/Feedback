<?php
// Dados já processados pelo Controller
$usuario = $parametro ?? null;
$isEdit = ($usuario != null);
?>
<div class="form-container">
    <div class="form-header">
        <h2 class="form-titulo">👤 <?= $isEdit ? 'Editar Usuário' : 'Cadastrar Usuário' ?></h2>
    </div>
    
    <div class="form-content">
        <form method="POST" action="<?= $isEdit ? 'index.php?param=usuario/alterar' : 'index.php?param=usuario/inserir' ?>"
              <?= $isEdit ? 'onsubmit="return confirmarAlteracao(\'usuário\', \'' . htmlspecialchars($usuario["nome"]) . '\')"' : '' ?>>
            <div class="form-group">
                <label class="form-label">Nome:</label>
                <input type="text" name="nome" class="form-input"
                       value="<?= $isEdit ? $usuario["nome"] : "" ?>" 
                       placeholder="Digite o nome completo" required />
            </div>
            
            <div class="form-group">
                <label class="form-label">Email:</label>
                <input type="email" name="email" class="form-input"
                       value="<?= $isEdit ? $usuario["email"] : "" ?>" 
                       placeholder="Digite o email" required />
            </div>

            <?php if ($isEdit): ?>
                <input type="hidden" name="id" value="<?= $usuario["id"] ?>" />
            <?php endif; ?>
            
            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    <?= $isEdit ? '✏️ Atualizar' : '➕ Cadastrar' ?>
                </button>
                <a href="index.php?param=usuario/lista" class="btn-cancelar">❌ Cancelar</a>
            </div>
        </form>
    </div>
</div>
