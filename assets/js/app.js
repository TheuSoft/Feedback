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
