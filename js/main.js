document.addEventListener("DOMContentLoaded", () => {
  const addExternalLinkAttributes = () => {
    const baseUrl = window.location.origin;
    document.querySelectorAll('a').forEach(link => {
      const href = link.getAttribute('href');
      if (href && href.startsWith('http') && !href.startsWith(baseUrl)) {
        link.setAttribute('rel', (link.getAttribute('rel') || '').split(' ').concat(['external', 'no-referrer', 'noopener']).filter((v, i, a) => a.indexOf(v) === i).join(' '));
        link.setAttribute('target', '_blank');
        link.setAttribute('title', `${link.textContent.trim()} irá abrir nova aba`);
        link.setAttribute('referrerpolicy', 'strict-origin');
      }
    });
  };

  const addTranslationLinks = () => {
    document.querySelectorAll('.translate-options a').forEach(link => {
      link.addEventListener('click', e => {
        e.preventDefault();
        window.location.href = `https://translate.google.com/translate?hl=${link.dataset.lang}&sl=auto&tl=${link.dataset.lang}&u=${encodeURIComponent(window.location.href)}`;
      });
    });
  };

  const updateThemeAutomatically = () => {
    const html = document.documentElement;
    if (html.dataset.bsTheme === 'auto') {
      const updateTheme = () => html.dataset.bsTheme = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
      window.matchMedia("(prefers-color-scheme: dark)").addEventListener("change", updateTheme);
      updateTheme();
    }
  };

  const initializeCollapse = () => document.querySelectorAll('.collapse').forEach(el => new bootstrap.Collapse(el, { toggle: false }));

  const generateTOC = () => {
    const article = document.querySelector('.article_content');
    const toc = document.querySelector('.toc-sidebar');
    if (!article || !toc) return;
    const headers = article.querySelectorAll('h2, h3');
    if (!headers.length) return (toc.innerHTML = '<p>Nenhum cabeçalho encontrado.</p>');

    toc.innerHTML = `<nav class="table-of-contents"><h2>Tabela de Conteúdos</h2><ul>${Array.from(headers).map(header => {
      if (!header.id) header.id = header.textContent.trim().toLowerCase().replace(/[^a-z0-9]+/g, '-');
      return `<li class="toc-level-${header.tagName.substring(1)}"><a href="#${header.id}">${header.textContent}</a></li>`;
    }).join('')}</ul></nav>`;

    toc.querySelectorAll('a').forEach(link => link.addEventListener('click', e => {
      e.preventDefault();
      document.getElementById(link.getAttribute('href').substring(1)).scrollIntoView({ behavior: 'smooth', block: 'start' });
    }));
  };


  [addExternalLinkAttributes, addTranslationLinks, updateThemeAutomatically, generateTOC, initializeCollapse].forEach(fn => fn());
});

// Tradução de condições climáticas
document.addEventListener("DOMContentLoaded", () => {
  const translations = {
    "None": "Nenhum", "thunderstorm with light rain": "Tempestade com chuva fraca", "thunderstorm with rain": "Tempestade com chuva",
    "light thunderstorm": "Tempestade leve", "thunderstorm": "Tempestade", "heavy thunderstorm": "Tempestade forte", "light rain": "Chuva fraca",
    "moderate rain": "Chuva moderada", "extreme rain": "Chuva extrema", "rain and wind": "Chuva e vento", "ice": "Gelo", "light snow": "Neve fraca",
    "Heavy snow": "Neve forte", "mist": "Névoa", "fog": "Nevoeiro", "Clear Sky": "Céu limpo", "Few Clouds": "Poucas nuvens",
    "Scattered Clouds": "Nuvens dispersas", "Overcast Clouds": "Nublado"
  };
  const element = document.querySelector(".p-weather");
  if (element) element.innerText = translations[element.innerText] || element.innerText;
});