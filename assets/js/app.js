/**
 * SISTEMA DE FEEDBACK MVC - JavaScript Principal
 * Funções para validação, confirmações e feedback visual
 */

// ===================================
// SISTEMA DE NOTIFICAÇÕES
// ===================================
const Notificacao = {
  criar: function (tipo, titulo, mensagem, duracao = 4000) {
    // Remove notificações antigas
    const notificacoesAntigas = document.querySelectorAll(".notificacao");
    notificacoesAntigas.forEach((n) => n.remove());

    // Cria nova notificação
    const notificacao = document.createElement("div");
    notificacao.className = `notificacao notificacao-${tipo}`;
    notificacao.innerHTML = `
            <div class="notificacao-content">
                <div class="notificacao-icon">${this.getIcon(tipo)}</div>
                <div class="notificacao-text">
                    <strong>${titulo}</strong>
                    <p>${mensagem}</p>
                </div>
                <button class="notificacao-close" onclick="this.parentElement.parentElement.remove()">×</button>
            </div>
        `;

    // Adiciona estilos se não existirem
    this.adicionarEstilos();

    // Adiciona ao body
    document.body.appendChild(notificacao);

    // Remove automaticamente após o tempo especificado
    setTimeout(() => {
      if (notificacao.parentNode) {
        notificacao.style.animation = "slideOut 0.3s ease forwards";
        setTimeout(() => notificacao.remove(), 300);
      }
    }, duracao);

    return notificacao;
  },

  getIcon: function (tipo) {
    const icons = {
      sucesso: "✅",
      erro: "❌",
      aviso: "⚠️",
      info: "ℹ️",
    };
    return icons[tipo] || "ℹ️";
  },

  adicionarEstilos: function () {
    if (document.querySelector("#notificacao-styles")) return;

    const styles = document.createElement("style");
    styles.id = "notificacao-styles";
    styles.textContent = `
            .notificacao {
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 10000;
                min-width: 300px;
                max-width: 400px;
                border-radius: 8px;
                box-shadow: 0 4px 20px rgba(0,0,0,0.15);
                animation: slideIn 0.3s ease;
                font-family: inherit;
            }
            .notificacao-sucesso { background: linear-gradient(135deg, #4caf50, #45a049); color: white; }
            .notificacao-erro { background: linear-gradient(135deg, #f44336, #d32f2f); color: white; }
            .notificacao-aviso { background: linear-gradient(135deg, #ff9800, #f57c00); color: white; }
            .notificacao-info { background: linear-gradient(135deg, #2196f3, #1976d2); color: white; }
            .notificacao-content {
                display: flex;
                align-items: flex-start;
                padding: 15px;
                gap: 12px;
            }
            .notificacao-icon {
                font-size: 1.5em;
                flex-shrink: 0;
            }
            .notificacao-text {
                flex: 1;
            }
            .notificacao-text strong {
                display: block;
                margin-bottom: 4px;
                font-size: 1.1em;
            }
            .notificacao-text p {
                margin: 0;
                opacity: 0.9;
                font-size: 0.95em;
            }
            .notificacao-close {
                background: none;
                border: none;
                color: inherit;
                font-size: 1.5em;
                cursor: pointer;
                opacity: 0.7;
                transition: opacity 0.2s;
                flex-shrink: 0;
            }
            .notificacao-close:hover { opacity: 1; }
            @keyframes slideIn {
                from { transform: translateX(100%); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOut {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(100%); opacity: 0; }
            }
        `;
    document.head.appendChild(styles);
  },

  sucesso: function (titulo, mensagem) {
    return this.criar("sucesso", titulo, mensagem);
  },

  erro: function (titulo, mensagem) {
    return this.criar("erro", titulo, mensagem);
  },

  aviso: function (titulo, mensagem) {
    return this.criar("aviso", titulo, mensagem);
  },

  info: function (titulo, mensagem) {
    return this.criar("info", titulo, mensagem);
  },
};

// ===================================
// SISTEMA DE CONFIRMAÇÕES
// ===================================
const Confirmar = {
  deletar: function (tipo, nome, callback) {
    const modal = this.criarModal();
    const conteudo = modal.querySelector(".modal-content");

    conteudo.innerHTML = `
            <div class="modal-header">
                <h3>🗑️ Confirmar Exclusão</h3>
            </div>
            <div class="modal-body">
                <p>Tem certeza que deseja excluir ${tipo}:</p>
                <strong>"${nome}"</strong>
                <p class="modal-warning">⚠️ Esta ação não pode ser desfeita!</p>
            </div>
            <div class="modal-footer">
                <button class="btn-modal btn-cancelar-modal" onclick="ModalSistema.fechar()">
                    ❌ Cancelar
                </button>
                <button class="btn-modal btn-confirmar-modal" onclick="ModalSistema.confirmar()">
                    🗑️ Sim, Excluir
                </button>
            </div>
        `;

    return new Promise((resolve) => {
      window.modalCallback = resolve;
      this.mostrarModal(modal);
    });
  },

  alterar: function (tipo, nome, callback) {
    const modal = this.criarModal();
    const conteudo = modal.querySelector(".modal-content");

    conteudo.innerHTML = `
            <div class="modal-header">
                <h3>✏️ Confirmar Alteração</h3>
            </div>
            <div class="modal-body">
                <p>Deseja realmente alterar ${tipo}:</p>
                <strong>"${nome}"</strong>
                <p class="modal-info">💡 Verifique se os dados estão corretos antes de confirmar.</p>
            </div>
            <div class="modal-footer">
                <button class="btn-modal btn-cancelar-modal" onclick="ModalSistema.fechar()">
                    ❌ Cancelar
                </button>
                <button class="btn-modal btn-confirmar-modal" onclick="ModalSistema.confirmar()">
                    ✏️ Sim, Alterar
                </button>
            </div>
        `;

    return new Promise((resolve) => {
      window.modalCallback = resolve;
      this.mostrarModal(modal);
    });
  },

  criarModal: function () {
    // Remove modal existente
    const modalExistente = document.querySelector("#modal-sistema");
    if (modalExistente) modalExistente.remove();

    // Adiciona estilos se necessário
    this.adicionarEstilos();

    // Cria novo modal
    const modal = document.createElement("div");
    modal.id = "modal-sistema";
    modal.className = "modal-overlay";
    modal.innerHTML = '<div class="modal-content"></div>';

    return modal;
  },

  mostrarModal: function (modal) {
    document.body.appendChild(modal);
    setTimeout(() => modal.classList.add("modal-show"), 10);
  },

  adicionarEstilos: function () {
    if (document.querySelector("#modal-styles")) return;

    const styles = document.createElement("style");
    styles.id = "modal-styles";
    styles.textContent = `
            .modal-overlay {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0,0,0,0.5);
                z-index: 20000;
                display: flex;
                align-items: center;
                justify-content: center;
                opacity: 0;
                transition: opacity 0.3s ease;
            }
            .modal-overlay.modal-show { opacity: 1; }
            .modal-content {
                background: white;
                border-radius: 12px;
                box-shadow: 0 8px 32px rgba(0,0,0,0.3);
                max-width: 500px;
                width: 90%;
                max-height: 90%;
                overflow: hidden;
                transform: scale(0.8);
                transition: transform 0.3s ease;
            }
            .modal-show .modal-content { transform: scale(1); }
            .modal-header {
                background: linear-gradient(135deg, #2196f3, #1976d2);
                color: white;
                padding: 20px;
                text-align: center;
            }
            .modal-header h3 {
                margin: 0;
                font-size: 1.3em;
                font-weight: 300;
            }
            .modal-body {
                padding: 25px;
                text-align: center;
                line-height: 1.6;
            }
            .modal-body p {
                margin: 15px 0;
                color: #495057;
            }
            .modal-body strong {
                color: #2196f3;
                font-size: 1.1em;
            }
            .modal-warning {
                color: #f44336 !important;
                font-weight: 600;
                font-size: 0.95em;
            }
            .modal-info {
                color: #2196f3 !important;
                font-size: 0.95em;
            }
            .modal-footer {
                padding: 20px 25px;
                text-align: center;
                border-top: 1px solid #e9ecef;
                background: #f8f9fa;
            }
            .btn-modal {
                padding: 12px 25px;
                border: none;
                border-radius: 25px;
                font-size: 15px;
                font-weight: 600;
                cursor: pointer;
                margin: 0 8px;
                transition: all 0.3s ease;
            }
            .btn-cancelar-modal {
                background: #6c757d;
                color: white;
            }
            .btn-cancelar-modal:hover {
                background: #5a6268;
                transform: translateY(-1px);
            }
            .btn-confirmar-modal {
                background: linear-gradient(135deg, #f44336, #d32f2f);
                color: white;
            }
            .btn-confirmar-modal:hover {
                transform: translateY(-1px);
                box-shadow: 0 4px 15px rgba(244, 67, 54, 0.4);
            }
        `;
    document.head.appendChild(styles);
  },
};

// Sistema de Modal Global
window.ModalSistema = {
  fechar: function () {
    const modal = document.querySelector("#modal-sistema");
    if (modal) {
      modal.classList.remove("modal-show");
      setTimeout(() => modal.remove(), 300);
    }
    if (window.modalCallback) {
      window.modalCallback(false);
      window.modalCallback = null;
    }
  },

  confirmar: function () {
    const modal = document.querySelector("#modal-sistema");
    if (modal) {
      modal.classList.remove("modal-show");
      setTimeout(() => modal.remove(), 300);
    }
    if (window.modalCallback) {
      window.modalCallback(true);
      window.modalCallback = null;
    }
  },
};

// ===================================
// VALIDAÇÃO DE FORMULÁRIOS
// ===================================
const ValidarForm = {
  init: function () {
    // Adiciona validação em tempo real
    const inputs = document.querySelectorAll(
      ".form-input, .form-select, .form-textarea"
    );
    inputs.forEach((input) => {
      input.addEventListener("blur", (e) => this.validarCampo(e.target));
      input.addEventListener("input", (e) => this.limparErro(e.target));
    });

    // Intercepta submit dos formulários
    const forms = document.querySelectorAll("form");
    forms.forEach((form) => {
      form.addEventListener("submit", (e) => this.validarFormulario(e));
    });
  },

  validarCampo: function (campo) {
    const valor = campo.value.trim();
    const tipo = campo.type || campo.tagName.toLowerCase();

    // Remove classes anteriores
    campo.classList.remove("error", "success");

    if (campo.hasAttribute("required") && !valor) {
      this.marcarErro(campo, "Este campo é obrigatório");
      return false;
    }

    if (tipo === "email" && valor) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(valor)) {
        this.marcarErro(campo, "Digite um email válido");
        return false;
      }
    }

    if (tipo === "number" && valor) {
      if (isNaN(valor) || parseFloat(valor) < 0) {
        this.marcarErro(campo, "Digite um número válido");
        return false;
      }
    }

    // Campo válido
    campo.classList.add("success");
    return true;
  },

  validarFormulario: function (event) {
    const form = event.target;
    const campos = form.querySelectorAll(
      ".form-input, .form-select, .form-textarea"
    );
    let valido = true;
    let primeiroErro = null;

    campos.forEach((campo) => {
      if (!this.validarCampo(campo)) {
        valido = false;
        if (!primeiroErro) primeiroErro = campo;
      }
    });

    if (!valido) {
      event.preventDefault();
      if (primeiroErro) {
        primeiroErro.focus();
        primeiroErro.scrollIntoView({ behavior: "smooth", block: "center" });
      }
      Notificacao.erro(
        "Erro no Formulário",
        "Por favor, corrija os campos destacados."
      );
    } else {
      // Formulário válido - mostrar loading
      const submitBtn = form.querySelector(".btn-submit");
      if (submitBtn) {
        submitBtn.innerHTML = "⏳ Processando...";
        submitBtn.disabled = true;
        form.classList.add("loading");
      }
    }
  },

  marcarErro: function (campo, mensagem) {
    campo.classList.add("error");

    // Remove mensagem anterior
    const erroAnterior = campo.parentNode.querySelector(".campo-erro");
    if (erroAnterior) erroAnterior.remove();

    // Adiciona nova mensagem
    const erroSpan = document.createElement("span");
    erroSpan.className = "campo-erro";
    erroSpan.textContent = mensagem;
    erroSpan.style.cssText = `
            color: #f44336;
            font-size: 0.85em;
            margin-top: 4px;
            display: block;
        `;
    campo.parentNode.appendChild(erroSpan);
  },

  limparErro: function (campo) {
    campo.classList.remove("error");
    const mensagemErro = campo.parentNode.querySelector(".campo-erro");
    if (mensagemErro) mensagemErro.remove();
  },
};

// ===================================
// FUNÇÕES DE AÇÃO (CRUD)
// ===================================
function confirmarExclusao(tipo, nome, url) {
  event.preventDefault();

  Confirmar.deletar(tipo, nome).then((confirmado) => {
    if (confirmado) {
      // Mostra loading
      Notificacao.info("Processando", "Excluindo registro...");

      // Redireciona para a URL de exclusão
      setTimeout(() => {
        window.location.href = url;
      }, 500);
    }
  });

  return false;
}

function confirmarAlteracao(tipo, nome) {
  event.preventDefault();
  const form = event.target.closest("form");

  Confirmar.alterar(tipo, nome).then((confirmado) => {
    if (confirmado) {
      form.submit();
    }
  });

  return false;
}

// ===================================
// FUNÇÕES DE FEEDBACK
// ===================================
function mostrarFeedbackUrl() {
  const params = new URLSearchParams(window.location.search);
  const info = params.get("info");

  if (info) {
    const mensagens = {
      1: {
        tipo: "sucesso",
        titulo: "Sucesso!",
        texto: "Registro cadastrado com sucesso!",
      },
      2: {
        tipo: "sucesso",
        titulo: "Atualizado!",
        texto: "Registro atualizado com sucesso!",
      },
      3: {
        tipo: "sucesso",
        titulo: "Excluído!",
        texto: "Registro excluído com sucesso!",
      },
    };

    const msg = mensagens[info];
    if (msg) {
      setTimeout(() => {
        Notificacao[msg.tipo](msg.titulo, msg.texto);
      }, 500);
    }
  }
}

// ===================================
// INICIALIZAÇÃO
// ===================================
document.addEventListener("DOMContentLoaded", function () {
  // Inicializa validação de formulários
  ValidarForm.init();

  // Mostra feedback baseado na URL
  mostrarFeedbackUrl();

  // Adiciona animações aos elementos
  const elementos = document.querySelectorAll(
    ".lista-container, .form-container"
  );
  elementos.forEach((el) => {
    el.style.opacity = "0";
    el.style.transform = "translateY(20px)";

    setTimeout(() => {
      el.style.transition = "all 0.5s ease";
      el.style.opacity = "1";
      el.style.transform = "translateY(0)";
    }, 100);
  });
});

// ===================================
// UTILITÁRIOS
// ===================================
function formatarMoeda(valor) {
  return new Intl.NumberFormat("pt-BR", {
    style: "currency",
    currency: "BRL",
  }).format(valor);
}

function formatarData(data) {
  return new Intl.DateTimeFormat("pt-BR").format(new Date(data));
}

// Exporta funções globais para uso nos templates
window.Notificacao = Notificacao;
window.Confirmar = Confirmar;
window.ValidarForm = ValidarForm;
window.confirmarExclusao = confirmarExclusao;
window.confirmarAlteracao = confirmarAlteracao;
