<?php

namespace template;

class Template implements ITemplate 
{
    public function cabecalho()
    {
        echo '
        <!DOCTYPE html>
        <html lang="pt-BR">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Sistema de Feedback MVC</title>
            <link rel="stylesheet" href="assets/css/style.css">
        </head>
        <body>
            <header class="header clearfix">
                <h1>🎯 Sistema de Feedback MVC</h1>
                <nav class="nav-menu">
                    <a href="index.php?param=usuario/lista">👥 Usuários</a>
                    <a href="index.php?param=produto/lista">📦 Produtos</a>
                    <a href="index.php?param=feedback/lista">💬 Feedbacks</a>
                </nav>
            </header>
            <main class="main-content">
        ';
    }
    
    public function rodape()
    {
        echo '
            </main>
            <footer class="footer">
                <p>&copy; ' . date('Y') . ' Sistema de Feedback MVC - Desenvolvido em PHP</p>
            </footer>
            <script src="assets/js/app.js"></script>
        </body>
        </html>
        ';
    }
    
    public function layout($caminho, $parametro = null)
    {
        $this->cabecalho();
        
        $arquivo = __DIR__ . "/.." . $caminho;
        if (file_exists($arquivo)) {
            include $arquivo;
        } else {
            echo "<div>Arquivo não encontrado: $arquivo</div>";
        }
        
        $this->rodape();
    }

    public function render($data = [])
    {
        // Implementação básica de render
    }

    public function setTitle($title)
    {
        // Implementação básica
    }

    public function getTitle()
    {
        return '';
    }

    public function addCss($css)
    {
        // Implementação básica
    }

    public function addJs($js)
    {
        // Implementação básica
    }

    public function setLayout($layout)
    {
        // Implementação básica
    }

    public function getLayout()
    {
        return '';
    }
}