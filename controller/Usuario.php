<?php
// Controller responsável pelo CRUD de Usuário
class Usuario extends BaseController {
    private $usuarioService;
    
    // Construtor: inicializa o service de Usuário
    public function __construct() {
        parent::__construct();
        $this->usuarioService = new UsuarioService();
    }
    
    // Método que lista todos os usuários
    public function listar() {
        try {
            $usuarios = $this->usuarioService->listarTodos(); // Busca todos os usuários no banco
            $this->template->header("Usuários"); // Renderiza cabeçalho
            $this->template->render('usuario/listar.php', ['usuarios' => $usuarios]); // Chama view de listagem
            $this->template->footer(); // Renderiza rodapé
        } catch (Exception $e) {
            // Caso erro, exibe mensagem
            $this->template->header("Erro");
            echo '<div class="alert alert-error">Erro: ' . $e->getMessage() . '</div>';
            $this->template->footer();
        }
    }
    
    // Método que exibe o formulário (novo ou edição)
    public function form() {
        $usuario = null; // Inicializa variável
        $id = $_GET['id'] ?? null; // Pega ID da URL (se existir)
        
        // Caso seja edição, busca usuário por ID
        if ($id) {
            try {
                $usuario = $this->usuarioService->buscarPorId($id);
                if (!$usuario) {
                    throw new Exception("Usuário não encontrado");
                }
            } catch (Exception $e) {
                // Caso não exista ou ocorra erro, mostra mensagem
                $this->template->header("Erro");
                echo '<div class="alert alert-error">Erro: ' . $e->getMessage() . '</div>';
                $this->template->footer();
                return;
            }
        }
        
        // Renderiza o formulário (se for edição, vem preenchido)
        $this->template->header($usuario ? "Editar Usuário" : "Novo Usuário");
        $this->template->render('usuario/form.php', ['usuario' => $usuario]);
        $this->template->footer();
    }
    
    // Método que salva ou atualiza usuário
    public function salvar() {
        try {
            // Pega dados do formulário
            $id = $this->getData('id');
            $nome = $this->getData('nome');
            $email = $this->getData('email');
            
            // Verifica se é atualização ou inserção
            if ($id) {
                $this->usuarioService->atualizar($id, $nome, $email);
                $mensagem = "Usuário atualizado com sucesso!";
            } else {
                $this->usuarioService->salvar($nome, $email);
                $mensagem = "Usuário cadastrado com sucesso!";
            }
            
            // Salva mensagem na sessão
            if (!isset($_SESSION)) session_start();
            $_SESSION['mensagem'] = $mensagem;
            
            // Redireciona para listagem
            $this->redirect('?acao=usuario');
        } catch (Exception $e) {
            // Em caso de erro, guarda mensagem na sessão
            if (!isset($_SESSION)) session_start();
            $_SESSION['erro'] = $e->getMessage();
            
            // Redireciona de volta para o formulário
            $this->redirect('?acao=usuario-form' . (isset($id) && $id ? '&id=' . $id : ''));
        }
    }
    
    // Método editar apenas chama o form()
    public function editar() {
        $this->form();
    }
    
    // Método que visualiza os detalhes de um usuário
    public function visualizar() {
        try {
            $id = $_GET['id'] ?? null; // Recupera ID da URL
            if (!$id) {
                throw new Exception("ID do usuário não informado");
            }
            
            $usuario = $this->usuarioService->buscarPorId($id); // Busca usuário
            if (!$usuario) {
                throw new Exception("Usuário não encontrado");
            }
            
            // Renderiza a tela de visualização
            $this->template->header("Visualizar Usuário");
            $this->template->render('usuario/visualizar.php', ['usuario' => $usuario]);
            $this->template->footer();
        } catch (Exception $e) {
            // Caso erro, exibe mensagem
            $this->template->header("Erro");
            echo '<div class="alert alert-error">Erro: ' . $e->getMessage() . '</div>';
            $this->template->footer();
        }
    }
    
    // Método que exclui usuário
    public function excluir() {
        try {
            $id = $_GET['id'] ?? null; // Recupera ID da URL
            $this->usuarioService->excluir($id); // Remove do banco
            
            // Mensagem de sucesso
            if (!isset($_SESSION)) session_start();
            $_SESSION['mensagem'] = "Usuário excluído com sucesso!";
        } catch (Exception $e) {
            // Mensagem de erro
            if (!isset($_SESSION)) session_start();
            $_SESSION['erro'] = $e->getMessage();
        }
        
        // Redireciona para listagem
        $this->redirect('?acao=usuario');
    }
}
?>
