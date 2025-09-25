<?php
// Define uma classe abstrata "BaseController" que herda de "Acao"
abstract class BaseController extends Acao {
    // Variável protegida que armazenará o template usado para renderização das páginas
    protected $template;
    
    // Construtor da classe
    public function __construct() {
        // Chama o construtor da classe pai "Acao"
        parent::__construct();
        // Cria uma instância da classe "BaseTemplate" para usar em views
        $this->template = new BaseTemplate();
    }
    
    /**
     * Método para verificar e executar chamadas dinamicamente
     * Baseado no parâmetro 'param' da URL
     */
    public function verificarChamadas($param) {
        // Obtém o nome da classe atual e converte para minúsculas
        // Ex.: ProdutoController -> produtocontroller
        $className = strtolower(get_class($this));
        
        // Define ações padrão baseadas no padrão de URL: tipo-acao
        switch ($param) {
            case $className:
                // Se a URL for apenas o nome do controlador, chama listar()
                $this->listar();
                break;
                
            case $className . '-form':
                // URL com "-form" chama o método form()
                $this->form();
                break;
                
            case $className . '-salvar':
                // URL com "-salvar" chama o método salvar()
                $this->salvar();
                break;
                
            case $className . '-editar':
                // URL com "-editar" chama o método editar()
                $this->editar();
                break;
                
            case $className . '-excluir':
                // URL com "-excluir" chama o método excluir()
                $this->excluir();
                break;
                
            case $className . '-visualizar':
                // URL com "-visualizar" chama o método visualizar() se existir
                if (method_exists($this, 'visualizar')) {
                    $this->visualizar();
                } else {
                    // Caso não exista, chama listar() como fallback
                    $this->listar();
                }
                break;
                
            default:
                // Caso o parâmetro não corresponda a nenhum padrão acima
                // Remove o prefixo do nome da classe e tenta executar um método diretamente
                $method = str_replace($className . '-', '', $param);
                if (method_exists($this, $method)) {
                    // Chama o método dinamicamente
                    $this->$method();
                } else {
                    // Se o método não existir, retorna erro 404
                    http_response_code(404);
                    $this->template->header('Página não encontrada'); // Cabeçalho da página
                    echo '<div class="alert alert-error">';
                    echo '<h2>404 - Página não encontrada</h2>';
                    echo '<p>A ação solicitada não existe.</p>';
                    echo '<p><a href="?acao=home" class="btn btn-primary">Voltar ao início</a></p>';
                    echo '</div>';
                    $this->template->footer(); // Rodapé da página
                }
                break;
        }
    }
    
    // Métodos abstratos que devem ser implementados em qualquer classe que estenda Controller
    abstract public function listar();       // Listar registros
    abstract public function form();         // Formulário de cadastro ou edição
    abstract public function salvar();       // Salvar dados do formulário
    abstract public function editar();       // Editar registro existente
    abstract public function excluir();      // Excluir registro
    abstract public function visualizar();   // Visualizar detalhes do registro
}
?>