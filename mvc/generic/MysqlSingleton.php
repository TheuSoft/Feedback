<?php
namespace generic;

class MysqlSingleton
{
    private $usuario = 'root';
    private $senha = '';
    private static $instance = null;
    private $conexao = null;
    private $dsn = 'mysql:host=localhost;dbname=feedback_db';

    private function __construct()
    {
        if($this->conexao == null){
            $this->conexao = new \PDO($this->dsn,$this->usuario,$this->senha);
        }
    }

    public static function getInstance()
    {
        if(self::$instance == null){
            self::$instance = new MysqlSingleton();
        }

        return self::$instance;
    }

    public function executar($query, $param = array())
    {
        if($this->conexao){
            $sth = $this->conexao->prepare($query);
            foreach($param as $k => $v){
                $sth->bindValue($k,$v);
            }
            $sth->execute();
            return $sth;
        }
        
        return false;
    }
}