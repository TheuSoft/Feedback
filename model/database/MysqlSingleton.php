<?php
// Classe que implementa o padrão Singleton para a conexão MySQL
class MysqlSingleton {
    // Armazena a única instância da classe
    private static $instance = null;
    
    // Armazena a conexão PDO
    private $connection;
    
    // Construtor privado para evitar instâncias externas
    private function __construct() {
        // Cria a conexão usando a fábrica MysqlFactory
        $this->connection = MysqlFactory::getConnection();
    }
    
    // Método público estático para obter a instância única da classe
    public static function getInstance() {
        // Se ainda não existe instância, cria uma nova
        if (self::$instance === null) {
            self::$instance = new self();
        }
        // Retorna a instância existente
        return self::$instance;
    }
    
    // Retorna a conexão PDO
    public function getConnection() {
        return $this->connection;
    }
    
    // Impede a clonagem da instância
    private function __clone() {}
    
    // Impede a desserialização da instância
    public function __wakeup() {}
}
?>
