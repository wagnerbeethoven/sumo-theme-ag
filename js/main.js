document.addEventListener("DOMContentLoaded", function () {
  // Função para adicionar atributos aos links externos
  function addExternalLinkAttributes() {
    const baseUrl = window.location.origin;
    const links = document.querySelectorAll('a');

    links.forEach(link => {
      const href = link.getAttribute('href');

      // Verifica se é um link externo
      if (href && href.startsWith('http') && !href.startsWith(baseUrl)) {
        // Adiciona rel, preservando valores existentes
        let rel = link.getAttribute('rel') || '';
        const requiredRels = ['external', 'no-referrer', 'noopener'];

        requiredRels.forEach(value => {
          if (!rel.split(' ').includes(value)) {
            rel += ` ${value}`;
          }
        });

        // Garante que os valores estejam corretamente formatados
        link.setAttribute('rel', rel.trim().replace(/\s+/g, ' '));

        // Adiciona target="_blank" se não estiver definido
        if (!link.hasAttribute('target')) {
          link.setAttribute('target', '_blank');
        }

        // Recupera o texto visível do link ou o texto dentro de span.visually-hidden
        let linkText = link.textContent.trim();
        const visuallyHidden = link.querySelector('.visually-hidden');
        if (visuallyHidden) {
          linkText = visuallyHidden.textContent.trim();
        }

        // Adiciona um title dinâmico se não estiver definido
        if (!link.hasAttribute('title')) {
          link.setAttribute('title', `${linkText} irá abrir nova aba`);
        }

        // Adiciona referrerpolicy se não estiver definido
        if (!link.hasAttribute('referrerpolicy')) {
          link.setAttribute('referrerpolicy', 'strict-origin');
        }
      }
    });
  }

  // Função para redirecionar para a URL de tradução do Google
  function addTranslationLinks() {
    const translateLinks = document.querySelectorAll('.translate-options a');

    translateLinks.forEach(link => {
      link.addEventListener('click', function (event) {
        event.preventDefault(); // Evita o comportamento padrão do link
        const lang = this.getAttribute('data-lang');
        const currentURL = window.location.href;
        const translateURL = `https://translate.google.com/translate?hl=${lang}&sl=auto&tl=${lang}&u=${encodeURIComponent(currentURL)}`;
        window.location.href = translateURL; // Redireciona para a URL de tradução
      });
    });
  }

  // Função para atualizar o tema automaticamente com base nas preferências do sistema
  function updateThemeAutomatically() {
    const htmlElement = document.querySelector("html");

    if (htmlElement.getAttribute("data-bs-theme") === 'auto') {
      function updateTheme() {
        htmlElement.setAttribute(
          "data-bs-theme",
          window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"
        );
      }

      window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", updateTheme);
      updateTheme();
    }
  }


  // Inicializa as funções
  addExternalLinkAttributes();
  addTranslationLinks();
  updateThemeAutomatically();
});

document.addEventListener("DOMContentLoaded", function () {
  // Selecionar a div de conteúdo e a div do TOC
  const article_content = document.querySelector('.article_content');
  const tocSidebar = document.querySelector('.toc-sidebar');

  if (!article_content || !tocSidebar) {
    console.warn('Div .article_content ou .toc-sidebar não encontrada.');
    return;
  }

  // Selecionar todos os cabeçalhos dentro da div de conteúdo
  const headers = article_content.querySelectorAll('h2, h3');

  if (headers.length === 0) {
    tocSidebar.innerHTML = '<p>Nenhum cabeçalho encontrado para gerar a Tabela de Conteúdos.</p>';
    return;
  }

  // Criar a estrutura básica do TOC
  let toc = '<nav class="table-of-contents"><h2>Tabela de Conteúdos</h2><ul>';

  headers.forEach(function (header) {
    // Verificar se o cabeçalho já possui um ID
    if (!header.id) {
      // Gerar um ID baseado no texto do cabeçalho
      let id = header.textContent.trim().toLowerCase().replace(/[^a-z0-9]+/g, '-');
      header.id = id;
    }

    // Determinar o nível do cabeçalho (h2 = 2, h3 = 3, etc.)
    const level = parseInt(header.tagName.substring(1));

    // Adicionar classe baseada no nível para estilização
    toc += `<li class="toc-level-${level}"><a href="#${header.id}">${header.textContent}</a></li>`;
  });

  toc += '</ul></nav>';

  // Inserir o TOC na div do TOC Sidebar
  tocSidebar.innerHTML = toc;

  // Implementar Scroll Suave (Opcional)
  const tocLinks = tocSidebar.querySelectorAll('a');

  tocLinks.forEach(function (link) {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const targetId = this.getAttribute('href').substring(1);
      const targetElement = document.getElementById(targetId);

      if (targetElement) {
        const offsetTop = targetElement.getBoundingClientRect().top + window.pageYOffset - 20; // Ajuste o offset conforme necessário

        window.scrollTo({
          top: offsetTop,
          behavior: 'smooth'
        });
      }
    });
  });
});
