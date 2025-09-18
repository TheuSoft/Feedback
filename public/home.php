<?php
$template = new BaseTemplate();
$template->header("Aplicativo de Feedback para Produtos");
?>

<div class="home-container">
    <h2>Bem-vindo ao Sistema de Feedback</h2>
    <p class="home-description">
        Gerencie produtos, usuários e colete feedback de forma organizada.
    </p>
    
    <div class="home-grid">
        <div class="home-card">
            <h3>Produtos</h3>
            <p>Cadastre e gerencie seus produtos com nome, descrição e preço.</p>
            <a href="?acao=produto" class="btn btn-primary">Ver Produtos</a>
        </div>
        
        <div class="home-card">
            <h3>Usuários</h3>
            <p>Gerencie os usuários que darão feedback sobre os produtos.</p>
            <a href="?acao=usuario" class="btn btn-primary">Ver Usuários</a>
        </div>
        
        <div class="home-card">
            <h3>Feedback</h3>
            <p>Visualize e gerencie os feedbacks dados pelos usuários.</p>
            <a href="?acao=feedback" class="btn btn-primary">Ver Feedback</a>
        </div>
    </div>
</div>

<?php
$template->footer();
?>
