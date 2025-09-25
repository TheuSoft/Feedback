<?php
// Interface que define os métodos obrigatórios para um DAO de Usuário
// Garante que qualquer classe que implemente IUsuarioDAO (ex: UsuarioDAO)
// tenha as operações essenciais de manipulação de dados
interface IUsuarioDAO {
    
    // Insere um novo usuário no banco
    public function inserir($nome, $email);
    
    // Atualiza os dados de um usuário existente
    public function atualizar($id, $nome, $email);
    
    // Exclui um usuário pelo ID
    public function excluir($id);
    
    // Busca um usuário pelo ID
    public function buscarPorId($id);
    
    // Busca um usuário pelo e-mail (útil para login e validação de cadastro)
    public function buscarPorEmail($email);
    
    // Lista todos os usuários cadastrados
    public function listarTodos();
}
?>
