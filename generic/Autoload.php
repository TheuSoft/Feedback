<?php
class Autoload {
    public static function ativar() {
        spl_autoload_register([__CLASS__, 'carregarClasse']);
    }
    
    public static function carregarClasse($nomeClasse) {
        $caminhos = [
            __DIR__ . '/../controller/',
            __DIR__ . '/../service/',
            __DIR__ . '/../dao/',
            __DIR__ . '/../dao/mysql/',
            __DIR__ . '/../template/',
            __DIR__ . '/',
        ];
        
        foreach ($caminhos as $caminho) {
            $arquivo = $caminho . $nomeClasse . '.php';
            if (file_exists($arquivo)) {
                require_once $arquivo;
                return;
            }
        }
    }
}
?>
