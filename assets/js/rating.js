/**
 * Sistema de Rating/Estrelas para Feedback
 * Funcionalidades específicas para avaliação por estrelas
 */

// Função para inicializar o sistema de rating
function inicializarRating() {
  const containers = document.querySelectorAll(".rating:not(.readonly)");

  containers.forEach((container) => {
    const estrelas = container.querySelectorAll(".star");
    const input = container.querySelector('input[type="hidden"]');

    if (estrelas.length > 0) {
      estrelas.forEach((estrela, index) => {
        // Adicionar evento de clique para seleção
        estrela.addEventListener("click", function () {
          const rating = index + 1;

          // Atualizar valor no input hidden
          if (input) {
            input.value = rating;
          }

          // Atualizar visual das estrelas
          atualizarVisualizacaoEstrelas(container, rating);
        });

        // Adicionar evento de hover para preview
        estrela.addEventListener("mouseenter", function () {
          const rating = index + 1;
          previewRating(container, rating);
        });
      });

      // Restaurar visual original quando sair do hover
      container.addEventListener("mouseleave", function () {
        const valorAtual = input ? input.value : 0;
        atualizarVisualizacaoEstrelas(container, valorAtual);
      });
    }
  });
}

// Função para atualizar a visualização das estrelas
function atualizarVisualizacaoEstrelas(container, rating) {
  const estrelas = container.querySelectorAll(".star");

  estrelas.forEach((estrela, index) => {
    if (index < rating) {
      estrela.classList.add("filled");
      estrela.style.color = "#ffc107";
    } else {
      estrela.classList.remove("filled");
      estrela.style.color = "#ddd";
    }
  });
}

// Função para preview do rating no hover
function previewRating(container, rating) {
  const estrelas = container.querySelectorAll(".star");

  estrelas.forEach((estrela, index) => {
    if (index < rating) {
      estrela.style.color = "#ffeb3b";
      estrela.style.transform = "scale(1.1)";
    } else {
      estrela.style.color = "#ddd";
      estrela.style.transform = "scale(1)";
    }
  });
}

// Função para criar rating interativo dinamicamente
function criarRatingInterativo(container, valorInicial = 0) {
  container.innerHTML = "";
  container.className = "rating interactive";

  // Criar input hidden para armazenar o valor
  const input = document.createElement("input");
  input.type = "hidden";
  input.name = "rating";
  input.value = valorInicial;
  container.appendChild(input);

  // Criar estrelas
  for (let i = 1; i <= 5; i++) {
    const estrela = document.createElement("span");
    estrela.className = "star";
    estrela.innerHTML = "★";
    estrela.style.cursor = "pointer";
    estrela.style.fontSize = "24px";
    estrela.style.transition = "all 0.2s ease";

    container.appendChild(estrela);
  }

  // Inicializar funcionalidade
  inicializarRating();

  // Definir valor inicial
  if (valorInicial > 0) {
    atualizarVisualizacaoEstrelas(container, valorInicial);
  }
}

// Função para criar rating apenas para visualização (read-only)
function criarRatingVisualizacao(container, valor) {
  container.innerHTML = "";
  container.className = "rating readonly";

  for (let i = 1; i <= 5; i++) {
    const estrela = document.createElement("span");
    estrela.className = "star";
    estrela.innerHTML = "★";

    if (i <= valor) {
      estrela.classList.add("filled");
      estrela.style.color = "#ffc107";
    } else {
      estrela.style.color = "#ddd";
    }

    container.appendChild(estrela);
  }
}

// Inicializar quando o DOM estiver carregado
document.addEventListener("DOMContentLoaded", function () {
  inicializarRating();
});

// Exportar funções para uso global
window.FeedbackRating = {
  inicializar: inicializarRating,
  criarInterativo: criarRatingInterativo,
  criarVisualizacao: criarRatingVisualizacao,
  atualizar: atualizarVisualizacaoEstrelas,
};
