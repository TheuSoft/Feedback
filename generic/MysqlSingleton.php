<?php
class MysqlSingleton {
    private static $instance = null;
    private $connection;
    
    private function __construct() {
        $this->connection = MysqlFactory::getConnection();
    }
    
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    public function getConnection() {
        return $this->connection;
    }
    
    private function __clone() {}
    public function __wakeup() {}
}
?>
