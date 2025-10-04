
<div class="lista-container">
    <div class="lista-header">
        <h2 class="lista-titulo">👥 Gerenciar Usuários</h2>
        <a href="index.php?param=usuario/formulario" class="btn-cadastrar">+ Cadastrar Usuário</a>
    </div>
    
    <table class="tabela-lista">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach( $parametro as $p): ?>
            <tr>
                <td><?= $p["id"] ?></td>
                <td><?= $p["nome"] ?></td>
                <td><?= $p["email"] ?></td>
                <td>
                    <a href="index.php?param=usuario/formularioalterar&id=<?= $p["id"] ?>" class="btn-acao">✏️ Alterar</a>
                    <a href="index.php?param=usuario/deletar&id=<?= $p["id"] ?>" class="btn-acao btn-deletar" onclick="return confirmarExclusao('usuário', '<?= htmlspecialchars($p["nome"]) ?>', this.href)">🗑️ Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
