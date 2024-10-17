<?php
class Social_Menu_Walker extends Walker_Nav_Menu
{

  function start_el(&$output, $item, $depth = 0, $args = null, $id = 0)
  {
    // Inicia o <li>
    $output .= '<li>';

    // Obtém as classes do item de menu
    $classes = empty($item->classes) ? array() : (array) $item->classes;
    $social_name = '';

    // Procura pela classe que indica a rede social
    foreach ($classes as $class) {
      if (strpos($class, 'social-item-') === 0) {
        $social_name = str_replace('social-item-', '', $class);
        break;
      }
    }

    // Se não encontrou, usa o título do item como fallback
    if (empty($social_name)) {
      $social_name = strtolower(sanitize_title($item->title));
    }

    // Verifica se o social_name está vazio
    if (empty($social_name)) {
      // Define um nome padrão ou ignora este item
      $social_name = 'default-icon';
    }

    // Monta os atributos do link
    $attributes  = ! empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';
    $attributes .= ' class="social-item social-item-' . esc_attr($social_name) . '"';
    $attributes .= ' rel="me"';
    $attributes .= ! empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= ! empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= ! empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';

    // Monta o ícone usando a classe da rede social
    $icon = '<span class="bi bi-' . esc_attr($social_name) . '"></span>';

    // Verifica se o título do item está vazio
    $item_title = ! empty($item->title) ? $item->title : __('Social', 'seu-text-domain');

    // Elemento para acessibilidade
    $visually_hidden = '<span class="visually-hidden">' . esc_html($item_title) . '</span>';

    // Constrói o elemento <a>
    $item_output = '<a' . $attributes . '>' . $icon . $visually_hidden . '</a>';

    // Aplica filtros ao item_output
    $item_output = apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);

    // Adiciona ao output
    $output .= $item_output;
  }

  // Implementa os outros métodos para manter a estrutura correta
  function start_lvl(&$output, $depth = 0, $args = null)
  {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"sub-menu\">\n";
  }

  function end_lvl(&$output, $depth = 0, $args = null)
  {
    $indent = str_repeat("\t", $depth);
    $output .= "$indent</ul>\n";
  }

  function end_el(&$output, $item, $depth = 0, $args = null)
  {
    $output .= '</li>';
  }
}
