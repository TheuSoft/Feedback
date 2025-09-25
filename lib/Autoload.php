<?php
// Classe responsável por registrar e carregar automaticamente classes PHP
class Autoload {

    // Ativa o autoload usando a função spl_autoload_register
    public static function ativar() {
        // Registra o método 'carregarClasse' desta classe como autoloader
        spl_autoload_register([__CLASS__, 'carregarClasse']);
    }
    
    // Método que será chamado automaticamente sempre que uma classe não estiver carregada
    public static function carregarClasse($nomeClasse) {
        // Array de diretórios onde as classes podem estar localizadas
        $caminhos = [
            __DIR__ . '/../controller/',           // diretório de controladores
            __DIR__ . '/../model/service/',        // diretório de serviços
            __DIR__ . '/../model/dao/',            // diretório de DAOs
            __DIR__ . '/../model/dao/mysql/',      // subdiretório específico para DAOs MySQL
            __DIR__ . '/../model/database/',       // diretório de conexões
            __DIR__ . '/../model/entity/',         // diretório de entidades
            __DIR__ . '/../view/template/',        // diretório de templates
            __DIR__ . '/',                         // diretório atual
        ];
        
        // Percorre cada diretório para tentar localizar o arquivo da classe
        foreach ($caminhos as $caminho) {
            $arquivo = $caminho . $nomeClasse . '.php'; // monta o caminho completo do arquivo
            if (file_exists($arquivo)) {                // verifica se o arquivo existe
                require_once $arquivo;                  // inclui a classe
                return;                                 // interrompe o loop após encontrar
            }
        }
    }
}
?>