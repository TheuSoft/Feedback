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
    <h2>Lista de Usuários</h2>
    <a href="?acao=usuario-form" class="btn">Novo Usuário</a>
</div>

<?php if (empty($usuarios)): ?>
    <div class="alert alert-info empty-state">
        Nenhum usuário cadastrado ainda. <a href="?acao=usuario-form">Cadastre o primeiro usuário</a>.
    </div>
<?php else: ?>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?= htmlspecialchars($usuario['id']) ?></td>
                    <td><?= htmlspecialchars($usuario['nome']) ?></td>
                    <td><?= htmlspecialchars($usuario['email']) ?></td>
                    <td>
                        <a href="?acao=usuario-editar&id=<?= $usuario['id'] ?>" class="btn btn-warning">Editar</a>
                        <a href="?acao=usuario-excluir&id=<?= $usuario['id'] ?>" 
                           class="btn btn-danger">Excluir</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
