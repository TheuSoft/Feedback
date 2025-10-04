
<div class="lista-container">
    <div class="lista-header">
        <h2 class="lista-titulo">💬 Gerenciar Feedbacks</h2>
        <a href="index.php?param=feedback/formulario" class="btn-cadastrar">+ Cadastrar Feedback</a>
    </div>
    
    <table class="tabela-lista">
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
        <?php foreach( $parametro as $p): ?>
            <tr>
                <td><?= $p["id"] ?></td>
                <td><?= $p["usuario_nome"] ?></td>
                <td><?= $p["produto_nome"] ?></td>
                <td class="nota-estrelas">
                    <?php for($i = 1; $i <= 5; $i++): ?>
                        <?= ($i <= $p["nota"]) ? '⭐' : '☆' ?>
                    <?php endfor; ?>
                    (<?= $p["nota"] ?>)
                </td>
                <td class="comentario" title="<?= $p["comentario"] ?>"><?= $p["comentario"] ?></td>
                <td>
                    <a href="index.php?param=feedback/formularioalterar&id=<?= $p["id"] ?>" class="btn-acao">✏️ Alterar</a>
                    <a href="index.php?param=feedback/deletar&id=<?= $p["id"] ?>" class="btn-acao btn-deletar" onclick="return confirmarExclusao('feedback', 'ID: <?= $p["id"] ?>', this.href)">🗑️ Deletar</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
