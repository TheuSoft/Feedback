<?php
$template = new BaseTemplate();
$template->header("Aplicativo de Feedback para Produtos");
?>

<div class="home-container">
    <h2>Sistema de Gestão de Feedback</h2>
    <p class="home-description">
        Uma plataforma completa e intuitiva para gerenciar produtos, usuários e coletar feedback valioso de forma organizada e eficiente.
    </p>
    
    <div class="home-grid">
        <div class="home-card">
            <h3>📦 Produtos</h3>
            <p>Cadastre e gerencie seu catálogo de produtos com informações detalhadas, incluindo nome, descrição completa e preços atualizados.</p>
            <a href="?acao=produto" class="btn btn-primary">Gerenciar Produtos</a>
        </div>
        
        <div class="home-card">
            <h3>👥 Usuários</h3>
            <p>Administre sua base de usuários de forma segura e organizada, mantendo controle total sobre quem acessa o sistema.</p>
            <a href="?acao=usuario" class="btn btn-primary">Gerenciar Usuários</a>
        </div>
        
        <div class="home-card">
            <h3>⭐ Avaliações</h3>
            <p>Colete, visualize e analise feedback detalhado com sistema de notas por estrelas e comentários dos usuários.</p>
            <a href="?acao=feedback" class="btn btn-primary">Ver Avaliações</a>
        </div>
    </div>
</div>

<?php
$template->footer();
?>
