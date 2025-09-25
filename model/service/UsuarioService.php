<?php
class UsuarioService {
    private $usuarioDAO;
    
    public function __construct() {
        $this->usuarioDAO = new UsuarioDAO();
    }
    
    public function salvar($nome, $email) {
        // Validações de negócio
        if (empty($nome)) {
            throw new Exception("Nome do usuário é obrigatório");
        }
        
        if (empty($email)) {
            throw new Exception("Email do usuário é obrigatório");
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email inválido");
        }
        
        // Verificar se email já existe
        $usuarioExistente = $this->usuarioDAO->buscarPorEmail($email);
        if ($usuarioExistente) {
            throw new Exception("Email já cadastrado");
        }
        
        // Sanitizar dados
        $nome = trim($nome);
        $email = trim(strtolower($email));
        
        return $this->usuarioDAO->inserir($nome, $email);
    }
    
    public function atualizar($id, $nome, $email) {
        // Validações de negócio
        if (empty($id) || !is_numeric($id)) {
            throw new Exception("ID do usuário inválido");
        }
        
        if (empty($nome)) {
            throw new Exception("Nome do usuário é obrigatório");
        }
        
        if (empty($email)) {
            throw new Exception("Email do usuário é obrigatório");
        }
        
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email inválido");
        }
        
        // Verificar se usuário existe
        $usuario = $this->usuarioDAO->buscarPorId($id);
        if (!$usuario) {
            throw new Exception("Usuário não encontrado");
        }
        
        // Verificar se email já existe (exceto para o próprio usuário)
        $usuarioExistente = $this->usuarioDAO->buscarPorEmail($email);
        if ($usuarioExistente && $usuarioExistente['id'] != $id) {
            throw new Exception("Email já cadastrado");
        }
        
        // Sanitizar dados
        $nome = trim($nome);
        $email = trim(strtolower($email));
        
        return $this->usuarioDAO->atualizar($id, $nome, $email);
    }
    
    public function excluir($id) {
        if (empty($id) || !is_numeric($id)) {
            throw new Exception("ID do usuário inválido");
        }
        
        // Verificar se usuário existe
        $usuario = $this->usuarioDAO->buscarPorId($id);
        if (!$usuario) {
            throw new Exception("Usuário não encontrado");
        }
        
        return $this->usuarioDAO->excluir($id);
    }
    
    public function buscarPorId($id) {
        if (empty($id) || !is_numeric($id)) {
            throw new Exception("ID do usuário inválido");
        }
        
        return $this->usuarioDAO->buscarPorId($id);
    }
    
    public function listarTodos() {
        return $this->usuarioDAO->listarTodos();
    }
}
?>
