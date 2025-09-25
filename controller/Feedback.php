<?php
// Classe Feedback que herda da classe BaseController
class Feedback extends BaseController {
    // Serviços utilizados pela classe (injeção de dependência simples)
    private $feedbackService;
    private $usuarioService;
    private $produtoService;
    
    // Construtor: inicializa os serviços necessários
    public function __construct() {
        parent::__construct();
        $this->feedbackService = new FeedbackService();
        $this->usuarioService = new UsuarioService();
        $this->produtoService = new ProdutoService();
    }
    
    // Método para listar todos os feedbacks
    public function listar() {
        try {
            $feedbacks = $this->feedbackService->listarTodos(); // Busca todos os feedbacks
            $this->template->header("Feedback"); // Renderiza o header da página
            $this->template->render('feedback/listar.php', ['feedbacks' => $feedbacks]); // Exibe a view com os feedbacks
            $this->template->footer(); // Renderiza o footer da página
        } catch (Exception $e) {
            // Caso ocorra algum erro, exibe uma mensagem
            $this->template->header("Erro");
            echo '<div class="alert alert-error">Erro: ' . $e->getMessage() . '</div>';
            $this->template->footer();
        }
    }
    
    // Método que exibe o formulário (novo ou edição)
    public function form() {
        $feedback = null; // Inicializa feedback como nulo
        $id = $_GET['id'] ?? null; // Recupera o ID via GET (se existir)
        
        try {
            // Carrega listas de usuários e produtos para o formulário
            $usuarios = $this->usuarioService->listarTodos();
            $produtos = $this->produtoService->listarTodos();
            
            // Se tiver ID, busca o feedback correspondente para edição
            if ($id) {
                $feedback = $this->feedbackService->buscarPorId($id);
                if (!$feedback) {
                    throw new Exception("Feedback não encontrado");
                }
            }
            
            // Renderiza o formulário (Novo ou Editar)
            $this->template->header($feedback ? "Editar Feedback" : "Novo Feedback");
            $this->template->render('feedback/form.php', [
                'feedback' => $feedback,
                'usuarios' => $usuarios,
                'produtos' => $produtos
            ]);
            $this->template->footer();
        } catch (Exception $e) {
            // Caso ocorra erro, mostra mensagem
            $this->template->header("Erro");
            echo '<div class="alert alert-error">Erro: ' . $e->getMessage() . '</div>';
            $this->template->footer();
        }
    }
    
    // Método para salvar (inserir ou atualizar) um feedback
    public function salvar() {
        try {
            // Recupera dados do formulário
            $id = $this->getData('id');
            $usuarioId = $this->getData('usuario_id');
            $produtoId = $this->getData('produto_id');
            $nota = $this->getData('nota');
            $comentario = $this->getData('comentario');
            
            // Verifica se é atualização ou inserção
            if ($id) {
                $this->feedbackService->atualizar($id, $usuarioId, $produtoId, $nota, $comentario);
                $mensagem = "Feedback atualizado com sucesso!";
            } else {
                $this->feedbackService->salvar($usuarioId, $produtoId, $nota, $comentario);
                $mensagem = "Feedback cadastrado com sucesso!";
            }
            
            // Armazena mensagem de sucesso na sessão
            if (!isset($_SESSION)) session_start();
            $_SESSION['mensagem'] = $mensagem;
            
            // Redireciona para listagem de feedbacks
            $this->redirect('?acao=feedback');
        } catch (Exception $e) {
            // Em caso de erro, armazena mensagem de erro na sessão
            if (!isset($_SESSION)) session_start();
            $_SESSION['erro'] = $e->getMessage();
            
            // Redireciona para o formulário novamente (mantendo ID se existir)
            $this->redirect('?acao=feedback-form' . (isset($id) && $id ? '&id=' . $id : ''));
        }
    }
    
    // Método editar apenas reaproveita o form()
    public function editar() {
        $this->form();
    }
    
    // Método para visualizar detalhes de um feedback
    public function visualizar() {
        try {
            $id = $_GET['id'] ?? null; // Pega o ID do feedback
            if (!$id) {
                throw new Exception("ID do feedback não informado");
            }
            
            $feedback = $this->feedbackService->buscarPorId($id); // Busca no banco
            if (!$feedback) {
                throw new Exception("Feedback não encontrado");
            }
            
            // Renderiza a view de visualização
            $this->template->header("Visualizar Feedback");
            $this->template->render('feedback/visualizar.php', ['feedback' => $feedback]);
            $this->template->footer();
        } catch (Exception $e) {
            // Caso erro, exibe mensagem
            $this->template->header("Erro");
            echo '<div class="alert alert-error">Erro: ' . $e->getMessage() . '</div>';
            $this->template->footer();
        }
    }
    
    // Método para excluir um feedback
    public function excluir() {
        try {
            $id = $_GET['id'] ?? null; // Recupera ID do GET
            $this->feedbackService->excluir($id); // Remove do banco
            
            // Mensagem de sucesso
            if (!isset($_SESSION)) session_start();
            $_SESSION['mensagem'] = "Feedback excluído com sucesso!";
        } catch (Exception $e) {
            // Mensagem de erro
            if (!isset($_SESSION)) session_start();
            $_SESSION['erro'] = $e->getMessage();
        }
        
        // Redireciona para listagem
        $this->redirect('?acao=feedback');
    }
}
?>
