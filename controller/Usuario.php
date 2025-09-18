<?php
class Usuario extends Controller {
    private $usuarioService;
    
    public function __construct() {
        parent::__construct();
        $this->usuarioService = new UsuarioService();
    }
    
    public function listar() {
        try {
            $usuarios = $this->usuarioService->listarTodos();
            $this->template->header("Usuários");
            $this->template->render('usuario/listar.php', ['usuarios' => $usuarios]);
            $this->template->footer();
        } catch (Exception $e) {
            $this->template->header("Erro");
            echo '<div class="alert alert-error">Erro: ' . $e->getMessage() . '</div>';
            $this->template->footer();
        }
    }
    
    public function form() {
        $usuario = null;
        $id = $_GET['id'] ?? null;
        
        if ($id) {
            try {
                $usuario = $this->usuarioService->buscarPorId($id);
                if (!$usuario) {
                    throw new Exception("Usuário não encontrado");
                }
            } catch (Exception $e) {
                $this->template->header("Erro");
                echo '<div class="alert alert-error">Erro: ' . $e->getMessage() . '</div>';
                $this->template->footer();
                return;
            }
        }
        
        $this->template->header($usuario ? "Editar Usuário" : "Novo Usuário");
        $this->template->render('usuario/form.php', ['usuario' => $usuario]);
        $this->template->footer();
    }
    
    public function salvar() {
        try {
            $id = $this->getData('id');
            $nome = $this->getData('nome');
            $email = $this->getData('email');
            
            if ($id) {
                $this->usuarioService->atualizar($id, $nome, $email);
                $mensagem = "Usuário atualizado com sucesso!";
            } else {
                $this->usuarioService->salvar($nome, $email);
                $mensagem = "Usuário cadastrado com sucesso!";
            }
            
            if (!isset($_SESSION)) session_start();
            $_SESSION['mensagem'] = $mensagem;
            $this->redirect('?acao=usuario');
        } catch (Exception $e) {
            if (!isset($_SESSION)) session_start();
            $_SESSION['erro'] = $e->getMessage();
            $this->redirect('?acao=usuario-form' . (isset($id) && $id ? '&id=' . $id : ''));
        }
    }
    
    public function editar() {
        $this->form();
    }
    
    public function excluir() {
        try {
            $id = $_GET['id'] ?? null;
            $this->usuarioService->excluir($id);
            if (!isset($_SESSION)) session_start();
            $_SESSION['mensagem'] = "Usuário excluído com sucesso!";
        } catch (Exception $e) {
            if (!isset($_SESSION)) session_start();
            $_SESSION['erro'] = $e->getMessage();
        }
        
        $this->redirect('?acao=usuario');
    }
}
?>
