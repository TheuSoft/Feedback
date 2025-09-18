<?php
// Configurações do Sistema Arquivo para centralizar as configurações do projeto


// Configurações do Banco de Dados
define('DB_HOST', 'localhost');
define('DB_NAME', 'feedback_db');
define('DB_USER', 'root');
define('DB_PASS', '');

// Configurações Gerais
define('BASE_URL', 'http://localhost/projeto/mvc/');
define('SITE_NAME', 'Aplicativo de Feedback para Produtos');

// Configurações de Feedback
define('MIN_RATING', 1);
define('MAX_RATING', 5);

// Configurações de Erro
define('ERROR_REPORTING', true);

// Iniciar relatório de erros se habilitado
if (ERROR_REPORTING) {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}
?>
