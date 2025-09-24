<?php
abstract class Controller extends Acao {
    protected $template;
    
    public function __construct() {
        parent::__construct();
        $this->template = new BaseTemplate();
    }
    
    /**
     * Método para verificar e executar chamadas dinamicamente
     * Baseado no parâmetro 'param' da URL
     */
    public function verificarChamadas($param) {
        // Remover prefixos do nome da classe para obter o tipo (produto, usuario, feedback)
        $className = strtolower(get_class($this));
        
        // Mapear ações baseadas no padrão: tipo-acao
        switch ($param) {
            case $className:
                $this->listar();
                break;
                
            case $className . '-form':
                $this->form();
                break;
                
            case $className . '-salvar':
                $this->salvar();
                break;
                
            case $className . '-editar':
                $this->editar();
                break;
                
            case $className . '-excluir':
                $this->excluir();
                break;
                
            case $className . '-visualizar':
                if (method_exists($this, 'visualizar')) {
                    $this->visualizar();
                } else {
                    // Fallback para o método listar se visualizar não existir
                    $this->listar();
                }
                break;
                
            default:
                // Se não reconhecer o padrão, tenta executar o método diretamente
                $method = str_replace($className . '-', '', $param);
                if (method_exists($this, $method)) {
                    $this->$method();
                } else {
                    // Método não encontrado - redirecionar ou mostrar erro
                    http_response_code(404);
                    $this->template->header('Página não encontrada');
                    echo '<div class="alert alert-error">';
                    echo '<h2>404 - Página não encontrada</h2>';
                    echo '<p>A ação solicitada não existe.</p>';
                    echo '<p><a href="?acao=home" class="btn btn-primary">Voltar ao início</a></p>';
                    echo '</div>';
                    $this->template->footer();
                }
                break;
        }
    }
    
    abstract public function listar();
    abstract public function form();
    abstract public function salvar();
    abstract public function editar();
    abstract public function excluir();
    abstract public function visualizar();
}
?>
