<?php
// Exibir mensagens de erro
if (isset($_SESSION['erro'])) {
    echo '<div class="alert alert-error">' . $_SESSION['erro'] . '</div>';
    unset($_SESSION['erro']);
}

$isEdit = isset($produto) && $produto;
?>

<div class="page-header">
    <h2><?= $isEdit ? 'Editar Produto' : 'Novo Produto' ?></h2>
    <a href="?acao=produto" class="btn btn-primary">Voltar à Lista</a>
</div>

<form method="POST" action="?acao=produto-salvar">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($produto['id']) ?>">
    <?php endif; ?>
    
    <div class="form-group">
        <label for="nome">Nome do Produto:</label>
        <input type="text" 
               id="nome" 
               name="nome" 
               value="<?= $isEdit ? htmlspecialchars($produto['nome']) : '' ?>" 
               required>
    </div>
    
    <div class="form-group">
        <label for="descricao">Descrição:</label>
        <textarea id="descricao" 
                  name="descricao" 
                  rows="4" 
                  required><?= $isEdit ? htmlspecialchars($produto['descricao']) : '' ?></textarea>
    </div>
    
    <div class="form-group">
        <label for="preco">Preço (R$):</label>
        <input type="number" 
               id="preco" 
               name="preco" 
               step="0.01" 
               min="0" 
               value="<?= $isEdit ? htmlspecialchars($produto['preco']) : '' ?>" 
               required>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn">
            <?= $isEdit ? 'Atualizar Produto' : 'Cadastrar Produto' ?>
        </button>
        <a href="?acao=produto" class="btn btn-primary">Cancelar</a>
    </div>
</form>
