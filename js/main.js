document.addEventListener("DOMContentLoaded", function () {
  /** 
   * Adiciona atributos aos links externos para melhor acessibilidade e segurança 
   */
  function addExternalLinkAttributes() {
    const baseUrl = window.location.origin;
    const links = document.querySelectorAll('a');

    links.forEach(link => {
      const href = link.getAttribute('href');

      if (href && href.startsWith('http') && !href.startsWith(baseUrl)) {
        let rel = link.getAttribute('rel') || '';
        const requiredRels = ['external', 'no-referrer', 'noopener'];

        requiredRels.forEach(value => {
          if (!rel.includes(value)) {
            rel += ` ${value}`;
          }
        });

        link.setAttribute('rel', rel.trim().replace(/\s+/g, ' '));

        if (!link.hasAttribute('target')) {
          link.setAttribute('target', '_blank');
        }

        let linkText = link.textContent.trim();
        const visuallyHidden = link.querySelector('.visually-hidden');
        if (visuallyHidden) {
          linkText = visuallyHidden.textContent.trim();
        }

        if (!link.hasAttribute('title')) {
          link.setAttribute('title', `${linkText} irá abrir nova aba`);
        }

        if (!link.hasAttribute('referrerpolicy')) {
          link.setAttribute('referrerpolicy', 'strict-origin');
        }
      }
    });
  }

  /**
   * Redireciona para a URL de tradução do Google
   */
  function addTranslationLinks() {
    const translateLinks = document.querySelectorAll('.translate-options a');

    translateLinks.forEach(link => {
      link.addEventListener('click', function (event) {
        event.preventDefault();
        const lang = this.getAttribute('data-lang');
        const currentURL = window.location.href;
        const translateURL = `https://translate.google.com/translate?hl=${lang}&sl=auto&tl=${lang}&u=${encodeURIComponent(currentURL)}`;
        window.location.href = translateURL;
      });
    });
  }

  /**
   * Atualiza automaticamente o tema com base nas preferências do sistema
   */
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

  /**
   * Inicializa manualmente o Bootstrap Collapse para garantir que os elementos funcionem
   */
  function initializeCollapse() {
    const collapseElements = document.querySelectorAll('.collapse');
    collapseElements.forEach(function (collapseEl) {
      new bootstrap.Collapse(collapseEl, { toggle: false });
    });
  }

  /**
   * Gera a Tabela de Conteúdos (TOC) automaticamente com base nos títulos do artigo
   */
  function generateTOC() {
    const articleContent = document.querySelector('.article_content');
    const tocSidebar = document.querySelector('.toc-sidebar');

    if (!articleContent || !tocSidebar) {
      console.warn('Div .article_content ou .toc-sidebar não encontrada.');
      return;
    }

    const headers = articleContent.querySelectorAll('h2, h3');

    if (headers.length === 0) {
      tocSidebar.innerHTML = '<p>Nenhum cabeçalho encontrado para gerar a Tabela de Conteúdos.</p>';
      return;
    }

    let toc = '<nav class="table-of-contents"><h2>Tabela de Conteúdos</h2><ul>';

    headers.forEach(function (header) {
      if (!header.id) {
        let id = header.textContent.trim().toLowerCase().replace(/[^a-z0-9]+/g, '-');
        header.id = id;
      }

      const level = parseInt(header.tagName.substring(1));
      toc += `<li class="toc-level-${level}"><a href="#${header.id}">${header.textContent}</a></li>`;
    });

    toc += '</ul></nav>';
    tocSidebar.innerHTML = toc;

    const tocLinks = tocSidebar.querySelectorAll('a');

    tocLinks.forEach(function (link) {
      link.addEventListener('click', function (e) {
        e.preventDefault();
        const targetId = this.getAttribute('href').substring(1);
        const targetElement = document.getElementById(targetId);

        if (targetElement) {
          const offsetTop = targetElement.getBoundingClientRect().top + window.pageYOffset - 20;

          window.scrollTo({
            top: offsetTop,
            behavior: 'smooth'
          });
        }
      });
    });
  }

  /**
   * Inicializa todas as funções do script
   */
  function initialize() {
    addExternalLinkAttributes();
    addTranslationLinks();
    updateThemeAutomatically();
    generateTOC();
    initializeCollapse();
  }

  initialize();
});
