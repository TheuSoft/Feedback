/**
 * Aplicativo de Feedback - JavaScript Principal
 * Funcionalidades gerais da aplicação
 */

// Função para confirmação de exclusão
function confirmarExclusao(tipo) {
  return confirm(`Tem certeza que deseja excluir este ${tipo}?`);
}

// Função para adicionar eventos de confirmação aos botões de exclusão
function inicializarConfirmacoes() {
  // Botões de exclusão de usuários
  const botoesExcluirUsuario = document.querySelectorAll(
    'a[href*="usuario-excluir"]'
  );
  botoesExcluirUsuario.forEach((botao) => {
    botao.addEventListener("click", function (e) {
      if (!confirmarExclusao("usuário")) {
        e.preventDefault();
      }
    });
  });

  // Botões de exclusão de produtos
  const botoesExcluirProduto = document.querySelectorAll(
    'a[href*="produto-excluir"]'
  );
  botoesExcluirProduto.forEach((botao) => {
    botao.addEventListener("click", function (e) {
      if (!confirmarExclusao("produto")) {
        e.preventDefault();
      }
    });
  });

  // Botões de exclusão de feedback
  const botoesExcluirFeedback = document.querySelectorAll(
    'a[href*="feedback-excluir"]'
  );
  botoesExcluirFeedback.forEach((botao) => {
    botao.addEventListener("click", function (e) {
      if (!confirmarExclusao("feedback")) {
        e.preventDefault();
      }
    });
  });
}

// Função para melhorar a experiência com formulários
function inicializarFormularios() {
  // Adicionar validação visual aos campos obrigatórios
  const camposObrigatorios = document.querySelectorAll(
    "input[required], textarea[required], select[required]"
  );

  camposObrigatorios.forEach((campo) => {
    campo.addEventListener("blur", function () {
      if (this.value.trim() === "") {
        this.style.borderColor = "#f44336";
      } else {
        this.style.borderColor = "#667eea";
      }
    });
  });

  // Resetar estilos quando o campo for focado
  camposObrigatorios.forEach((campo) => {
    campo.addEventListener("focus", function () {
      this.style.borderColor = "#667eea";
    });
  });
}

// Função para adicionar efeitos visuais nas tabelas
function inicializarTabelas() {
  const linhasTabela = document.querySelectorAll(".table tbody tr");

  linhasTabela.forEach((linha) => {
    linha.addEventListener("mouseenter", function () {
      this.style.transform = "scale(1.01)";
      this.style.transition = "transform 0.2s ease";
    });

    linha.addEventListener("mouseleave", function () {
      this.style.transform = "scale(1)";
    });
  });
}

// Função para adicionar animações aos botões
function inicializarBotoes() {
  const botoes = document.querySelectorAll(".btn");

  botoes.forEach((botao) => {
    botao.addEventListener("click", function () {
      // Adicionar efeito de "ripple" nos botões
      this.style.transform = "scale(0.95)";
      setTimeout(() => {
        this.style.transform = "scale(1)";
      }, 150);
    });
  });
}

// Função para auto-hide de alertas
function inicializarAlertas() {
  const alertas = document.querySelectorAll(".alert-success");

  alertas.forEach((alerta) => {
    // Auto-hide após 5 segundos
    setTimeout(() => {
      alerta.style.opacity = "0";
      alerta.style.transition = "opacity 0.5s ease";
      setTimeout(() => {
        alerta.style.display = "none";
      }, 500);
    }, 5000);
  });
}

// Inicialização quando o DOM estiver carregado
document.addEventListener("DOMContentLoaded", function () {
  inicializarConfirmacoes();
  inicializarFormularios();
  inicializarTabelas();
  inicializarBotoes();
  inicializarAlertas();
});

// Função utilitária para exibir notificações
function mostrarNotificacao(mensagem, tipo = "info") {
  const notificacao = document.createElement("div");
  notificacao.className = `alert alert-${tipo}`;
  notificacao.style.position = "fixed";
  notificacao.style.top = "20px";
  notificacao.style.right = "20px";
  notificacao.style.zIndex = "9999";
  notificacao.style.minWidth = "300px";
  notificacao.textContent = mensagem;

  document.body.appendChild(notificacao);

  // Auto-remove após 3 segundos
  setTimeout(() => {
    notificacao.style.opacity = "0";
    notificacao.style.transition = "opacity 0.5s ease";
    setTimeout(() => {
      document.body.removeChild(notificacao);
    }, 500);
  }, 3000);
}

// Funcionalidades do Modal de Visualização
function abrirModal(tipo, id, ...dados) {
  const modal = document.getElementById('modalVisualizacao');
  const modalTitulo = document.getElementById('modalTitulo');
  const modalCorpo = document.getElementById('modalCorpo');
  const modalEditar = document.getElementById('modalEditar');
  
  // Mover o modal para o final do body para garantir z-index
  if (modal.parentNode !== document.body) {
    document.body.appendChild(modal);
  }
  
  let conteudo = '';
  let tituloModal = '';
  let urlEditar = '';
  
  switch(tipo) {
    case 'produto':
      const [nome, descricao, preco] = dados;
      tituloModal = 'Visualizar Produto';
      urlEditar = `?acao=produto-editar&id=${id}`;
      conteudo = `
        <div class="modal-field">
          <label>ID:</label>
          <div class="modal-value">${id}</div>
        </div>
        <div class="modal-field">
          <label>Nome do Produto:</label>
          <div class="modal-value">${nome}</div>
        </div>
        <div class="modal-field">
          <label>Descrição:</label>
          <div class="modal-value modal-text">${descricao.replace(/\n/g, '<br>')}</div>
        </div>
        <div class="modal-field">
          <label>Preço:</label>
          <div class="modal-value">${preco}</div>
        </div>
      `;
      break;
      
    case 'usuario':
      const [nomeUsuario, email] = dados;
      tituloModal = 'Visualizar Usuário';
      urlEditar = `?acao=usuario-editar&id=${id}`;
      conteudo = `
        <div class="modal-field">
          <label>ID:</label>
          <div class="modal-value">${id}</div>
        </div>
        <div class="modal-field">
          <label>Nome:</label>
          <div class="modal-value">${nomeUsuario}</div>
        </div>
        <div class="modal-field">
          <label>Email:</label>
          <div class="modal-value">${email}</div>
        </div>
      `;
      break;
      
    case 'feedback':
      const [usuario, produto, nota, comentario] = dados;
      tituloModal = 'Visualizar Feedback';
      urlEditar = `?acao=feedback-editar&id=${id}`;
      
      // Gerar estrelas
      let estrelas = '';
      for (let i = 1; i <= 5; i++) {
        if (i <= nota) {
          estrelas += '<span class="star filled">★</span>';
        } else {
          estrelas += '<span class="star">★</span>';
        }
      }
      
      conteudo = `
        <div class="modal-field">
          <label>ID:</label>
          <div class="modal-value">${id}</div>
        </div>
        <div class="modal-field">
          <label>Usuário:</label>
          <div class="modal-value">${usuario}</div>
        </div>
        <div class="modal-field">
          <label>Produto:</label>
          <div class="modal-value">${produto}</div>
        </div>
        <div class="modal-field">
          <label>Nota:</label>
          <div class="modal-value">
            <div class="rating readonly">${estrelas}</div>
            <span class="rating-text">${nota}/5</span>
          </div>
        </div>
        <div class="modal-field">
          <label>Comentário:</label>
          <div class="modal-value modal-text">${comentario.replace(/\n/g, '<br>')}</div>
        </div>
      `;
      break;
  }
  
  modalTitulo.textContent = tituloModal;
  modalCorpo.innerHTML = conteudo;
  modalEditar.href = urlEditar;
  
  // ESCONDER COMPLETAMENTE TODOS OS ELEMENTOS EXCETO O MODAL
  const bodyChildren = Array.from(document.body.children);
  bodyChildren.forEach(element => {
    if (element.id !== 'modalVisualizacao') {
      element.style.display = 'none';
    }
  });
  
  // Mostrar o modal com máxima prioridade
  modal.style.display = 'flex';
  modal.style.zIndex = '999999999';
  modal.style.position = 'fixed';
  modal.style.top = '0';
  modal.style.left = '0';
  modal.style.width = '100vw';
  modal.style.height = '100vh';
  modal.style.backgroundColor = 'rgba(0, 0, 0, 0.7)';
  
  // Previne scroll da página
  document.body.style.overflow = 'hidden';
  document.body.classList.add('modal-open');
  
  // Força foco no modal para acessibilidade
  modal.focus();
}

function fecharModal(event) {
  const modal = document.getElementById('modalVisualizacao');
  
  // Se o evento for do clique no overlay ou no botão fechar
  if (!event || event.target === modal || event.target.classList.contains('close')) {
    // Esconder modal
    modal.style.display = 'none';
    
    // RESTAURAR TODOS OS ELEMENTOS
    const bodyChildren = Array.from(document.body.children);
    bodyChildren.forEach(element => {
      if (element.id !== 'modalVisualizacao') {
        element.style.display = '';
      }
    });
    
    // Restaurar scroll e classes
    document.body.style.overflow = '';
    document.body.classList.remove('modal-open');
  }
}

// Fechar modal com tecla ESC
document.addEventListener('keydown', function(event) {
  if (event.key === 'Escape') {
    const modal = document.getElementById('modalVisualizacao');
    if (modal && modal.style.display === 'flex') {
      fecharModal();
    }
  }
});