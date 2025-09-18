<?php
class BaseTemplate implements ITemplate {
    
    public function header($titulo = "Aplicativo de Feedback") {
        ?>
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= htmlspecialchars($titulo) ?></title>
            <link rel="stylesheet" href="assets/css/style.css">
            <link rel="stylesheet" href="assets/css/pages.css">
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h1><?= htmlspecialchars($titulo) ?></h1>
                    <nav class="nav">
                        <a href="?acao=home">Home</a>
                        <a href="?acao=produto">Produtos</a>
                        <a href="?acao=usuario">Usuários</a>
                        <a href="?acao=feedback">Feedback</a>
                    </nav>
                </div>
                <div class="content">
        <?php
    }
    
    public function footer() {
        ?>
                </div>
                <div class="footer">
                    <p>&copy; 2025 Aplicativo de Feedback para Produtos - Desenvolvido em PHP MVC</p>
                </div>
            </div>
            
            <!-- Scripts JavaScript -->
            <script src="assets/js/app.js"></script>
            <script src="assets/js/rating.js"></script>
        </body>
        </html>
        <?php
    }
    
    public function render($view, $dados = []) {
        extract($dados);
        include_once __DIR__ . '/../public/' . $view;
    }
}
?>
