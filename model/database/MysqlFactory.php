<?php
// Classe responsável por criar e fornecer uma conexão com o banco de dados MySQL
class MysqlFactory {
    
    // Método estático que retorna uma instância de PDO
    public static function getConnection() {
        
        // Verifica se as constantes de configuração do banco de dados estão definidas
        if (!defined('DB_HOST')) {
            // Se não estiverem, inclui o arquivo de configuração (config.php)
            require_once __DIR__ . '/../../config/config.php';
        }
        
        try {
            // Monta a string de conexão (DSN) do PDO
            $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8";
            
            // Cria uma nova conexão PDO usando usuário e senha definidos no config.php
            $pdo = new PDO($dsn, DB_USER, DB_PASS);
            
            // Define o modo de erro do PDO para lançar exceções
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Define o modo de fetch padrão como associativo (retorna arrays associativos)
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            
            // Retorna a instância de PDO para uso
            return $pdo;
        } catch (PDOException $e) {
            // Em caso de erro na conexão, termina a execução e mostra a mensagem de erro
            die("Erro na conexão com o banco de dados: " . $e->getMessage());
        }
    }
}
?>