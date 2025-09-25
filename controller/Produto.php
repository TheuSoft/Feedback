<?php
// Controller responsável pelo CRUD de Produto
class Produto extends BaseController {
    private $produtoService;
    
    // Construtor: inicializa o service de Produto
    public function __construct() {
        parent::__construct();
        $this->produtoService = new ProdutoService();
    }
    
    // Método que lista todos os produtos
    public function listar() {
        try {
            $produtos = $this->produtoService->listarTodos(); // Busca no banco todos os produtos
            $this->template->header("Produtos"); // Renderiza o cabeçalho da página
            $this->template->render('produto/listar.php', ['produtos' => $produtos]); // Chama a view com os produtos
            $this->template->footer(); // Renderiza o rodapé
        } catch (Exception $e) {
            // Caso ocorra erro, mostra mensagem amigável
            $this->template->header("Erro");
            echo '<div class="alert alert-error">Erro: ' . $e->getMessage() . '</div>';
            $this->template->footer();
        }
    }
    
    // Método que exibe o formulário (novo ou edição)
    public function form() {
        $produto = null; // Inicializa variável
        $id = $_GET['id'] ?? null; // Pega o ID via GET (se existir)
        
        // Se for edição, tenta buscar o produto pelo ID
        if ($id) {
            try {
                $produto = $this->produtoService->buscarPorId($id);
                if (!$produto) {
                    throw new Exception("Produto não encontrado");
                }
            } catch (Exception $e) {
                // Caso não encontre ou dê erro, mostra mensagem
                $this->template->header("Erro");
                echo '<div class="alert alert-error">Erro: ' . $e->getMessage() . '</div>';
                $this->template->footer();
                return;
            }
        }
        
        // Renderiza o formulário (se for edição, preenche com dados do produto)
        $this->template->header($produto ? "Editar Produto" : "Novo Produto");
        $this->template->render('produto/form.php', ['produto' => $produto]);
        $this->template->footer();
    }
    
    // Método que salva ou atualiza um produto
    public function salvar() {
        try {
            // Pega os dados enviados do formulário
            $id = $this->getData('id');
            $nome = $this->getData('nome');
            $descricao = $this->getData('descricao');
            $preco = $this->getData('preco');
            
            // Verifica se é atualização ou inserção
            if ($id) {
                $this->produtoService->atualizar($id, $nome, $descricao, $preco);
                $mensagem = "Produto atualizado com sucesso!";
            } else {
                $this->produtoService->salvar($nome, $descricao, $preco);
                $mensagem = "Produto cadastrado com sucesso!";
            }
            
            // Salva a mensagem de sucesso na sessão
            if (!isset($_SESSION)) session_start();
            $_SESSION['mensagem'] = $mensagem;
            
            // Redireciona para a listagem
            $this->redirect('?acao=produto');
        } catch (Exception $e) {
            // Em caso de erro, guarda a mensagem na sessão
            if (!isset($_SESSION)) session_start();
            $_SESSION['erro'] = $e->getMessage();
            
            // Redireciona de volta para o formulário (mantendo ID se for edição)
            $this->redirect('?acao=produto-form' . (isset($id) && $id ? '&id=' . $id : ''));
        }
    }
    
    // Método editar reutiliza o form()
    public function editar() {
        $this->form();
    }
    
    // Método para visualizar os detalhes de um produto
    public function visualizar() {
        try {
            $id = $_GET['id'] ?? null; // Pega ID da URL
            if (!$id) {
                throw new Exception("ID do produto não informado");
            }
            
            $produto = $this->produtoService->buscarPorId($id); // Busca no banco
            if (!$produto) {
                throw new Exception("Produto não encontrado");
            }
            
            // Renderiza a tela de visualização
            $this->template->header("Visualizar Produto");
            $this->template->render('produto/visualizar.php', ['produto' => $produto]);
            $this->template->footer();
        } catch (Exception $e) {
            // Exibe mensagem em caso de erro
            $this->template->header("Erro");
            echo '<div class="alert alert-error">Erro: ' . $e->getMessage() . '</div>';
            $this->template->footer();
        }
    }
    
    // Método para excluir um produto
    public function excluir() {
        try {
            $id = $_GET['id'] ?? null; // Recupera o ID da URL
            $this->produtoService->excluir($id); // Remove do banco
            
            // Mensagem de sucesso na sessão
            if (!isset($_SESSION)) session_start();
            $_SESSION['mensagem'] = "Produto excluído com sucesso!";
        } catch (Exception $e) {
            // Mensagem de erro na sessão
            if (!isset($_SESSION)) session_start();
            $_SESSION['erro'] = $e->getMessage();
        }
        
        // Redireciona para a listagem de produtos
        $this->redirect('?acao=produto');
    }
}
?>