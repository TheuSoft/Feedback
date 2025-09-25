<?php
// Exibir mensagens de erro
if (isset($_SESSION['erro'])) {
    echo '<div class="alert alert-error">' . $_SESSION['erro'] . '</div>';
    unset($_SESSION['erro']);
}

$isEdit = isset($usuario) && $usuario;
?>

<div class="page-header">
    <h2><?= $isEdit ? 'Editar Usuário' : 'Novo Usuário' ?></h2>
    <a href="?acao=usuario" class="btn btn-primary">Voltar à Lista</a>
</div>

<form method="POST" action="?acao=usuario-salvar">
    <?php if ($isEdit): ?>
        <input type="hidden" name="id" value="<?= htmlspecialchars($usuario['id']) ?>">
    <?php endif; ?>
    
    <div class="form-group">
        <label for="nome">Nome do Usuário:</label>
        <input type="text" 
               id="nome" 
               name="nome" 
               value="<?= $isEdit ? htmlspecialchars($usuario['nome']) : '' ?>" 
               required>
    </div>
    
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" 
               id="email" 
               name="email" 
               value="<?= $isEdit ? htmlspecialchars($usuario['email']) : '' ?>" 
               required>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn">
            <?= $isEdit ? 'Atualizar Usuário' : 'Cadastrar Usuário' ?>
        </button>
        <a href="?acao=usuario" class="btn btn-primary">Cancelar</a>
    </div>
</form>
