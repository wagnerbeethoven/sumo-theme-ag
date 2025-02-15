<?php

// Adiciona scripts ao tema
function theme_scripts() {
    wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', [], '3.7.1', true);
    wp_enqueue_script('bootstrap-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', ['jquery'], '5.3.3', true);
    wp_enqueue_script('google-translate', '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit', [], null, true);
    wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js', ['jquery', 'bootstrap-js'], '1.0', true);
    
}
add_action('wp_enqueue_scripts', 'theme_scripts');

// Adiciona estilos ao tema
function theme_styles() {
    wp_enqueue_style('open-sans', 'https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap', [], null);
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css', [], '1.11.3');
    wp_enqueue_style('main-css', get_stylesheet_directory_uri() . '/style.css', ['open-sans', 'bootstrap-icons'], '1.0.0', 'all');
}
add_action('wp_enqueue_scripts', 'theme_styles', 20);

// Configurações do tema
function ag_setup() {
    load_theme_textdomain('ag', get_template_directory() . '/languages');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', ['search-form', 'navigation-widgets']);
    add_theme_support('appearance-tools');
    // add_theme_support('woocommerce');
    global $content_width;
    $content_width = $content_width ?? 1920;
}
add_action('after_setup_theme', 'ag_setup');

// Registro de menus
function menu_ag() {
    register_nav_menus([
        'menu_rodape' => __('Menu Footer', 'ag'),
        'social' => __('Social Footer', 'ag'),
    ]);
}
add_action('init', 'menu_ag');

// Calcular tempo de leitura
function calculate_reading_time($content) {
    $word_count = str_word_count(strip_tags($content));
    return ceil($word_count / 200);
}
function display_reading_time() {
    $reading_time = calculate_reading_time(get_post_field('post_content', get_the_ID()));
    return sprintf(_n('%s minuto', '%s minutos', $reading_time, 'ag'), $reading_time);
}
add_shortcode('reading_time', 'display_reading_time');

// Personalizar "Leia mais"
function ag_read_more_link() {
    if (!is_admin()) {
        return ' <a href="' . esc_url(get_permalink()) . '" class="more-link">' . __('Leia mais', 'ag') . '</a>';
    }
}
add_filter('the_content_more_link', 'ag_read_more_link');

function ag_excerpt_read_more_link($more) {
    if (!is_admin()) {
        return ' <a href="' . esc_url(get_permalink()) . '" class="more-link">' . __('Leia mais', 'ag') . '</a>';
    }
}
add_filter('excerpt_more', 'ag_excerpt_read_more_link');

// Adicionar script de resposta a comentários
function ag_enqueue_comment_reply_script() {
    if (get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('comment_form_before', 'ag_enqueue_comment_reply_script');

// Redirecionar páginas de anexo
function redirect_attachment_page() {
    if (is_attachment()) {
        global $post;
        wp_redirect($post->post_parent ? get_permalink($post->post_parent) : home_url(), 301);
        exit;
    }
}
add_action('template_redirect', 'redirect_attachment_page');

// Registrar o post type "Nota"
function registrar_post_type_nota() {
    $args = [
        'labels' => [
            'name' => 'Notas',
            'singular_name' => 'Nota',
            'menu_name' => 'Notas',
            'add_new' => 'Adicionar Nova',
            'add_new_item' => 'Adicionar Nova Nota',
            'edit_item' => 'Editar Nota',
            'view_item' => 'Ver Nota',
            'all_items' => 'Todas as Notas',
            'search_items' => 'Procurar Notas',
            'not_found' => 'Nenhuma nota encontrada',
        ],
        'public' => true,
        'show_in_rest' => true,
        'supports' => ['title', 'editor', 'custom-fields'],
        'menu_icon' => 'dashicons-book',
        'has_archive' => true,
        'rewrite' => ['slug' => 'nota'],
    ];
    register_post_type('nota', $args);
}
add_action('init', 'registrar_post_type_nota');

// Permitir upload de SVG
add_filter('upload_mimes', function ($mimes) {
    if (current_user_can('administrator')) {
        $mimes['svg'] = 'image/svg+xml';
        $mimes['svgz'] = 'image/svg+xml';
    }
    return $mimes;
});

// Ativar Blogroll
add_filter('pre_option_link_manager_enabled', '__return_true');

// Botões de compartilhamento no final do conteúdo
function get_social_share_links() {
    $post_url = get_permalink();
    $post_title = get_the_title();
    $post_excerpt = get_the_excerpt();
    $post_image = get_the_post_thumbnail_url();

    // URLs de compartilhamento
    $mastodon_url = "https://toot.kyta.dev/?text=" . urlencode($post_title . " " . $post_url);
    $bluesky_url = "https://bsky.app/intent/post?text=" . urlencode($post_title . " " . $post_url);
    $facebook_url = "https://www.facebook.com/sharer/sharer.php?u=" . urlencode($post_url);
    $twitter_url = "https://x.com/intent/tweet?text=" . urlencode($post_title . " " . $post_url);
    $pinterest_url = "https://pinterest.com/pin/create/button/?url=" . urlencode($post_url) . "&media=" . urlencode($post_image) . "&description=" . urlencode($post_title);
    $linkedin_url = "https://www.linkedin.com/sharing/share-offsite/?url=" . urlencode($post_url);
    $email_url = "mailto:?subject=" . rawurlencode($post_title) . "&body=" . rawurlencode($post_title . " - " . $post_url);

    // HTML dos botões de compartilhamento
    $share_buttons = '<div class="social-share">';
    $share_buttons .= '<p>Compartilhe</p>';
    $share_buttons .= '<a class="bluesky" href="' . esc_url($bluesky_url) . '" target="_blank" rel="noopener noreferrer">Bluesky</a>';
    $share_buttons .= '<a class="email" href="' . esc_url($email_url) . '">E-mail</a>';
    $share_buttons .= '<a class="facebook" href="' . esc_url($facebook_url) . '" target="_blank" rel="noopener noreferrer">Facebook</a>';
    $share_buttons .= '<a class="linkedIn" href="' . esc_url($linkedin_url) . '" target="_blank" rel="noopener noreferrer">LinkedIn</a>';
    $share_buttons .= '<a class="mastodon" href="' . esc_url($mastodon_url) . '" target="_blank" rel="noopener noreferrer">Mastodon</a>';
    $share_buttons .= '<a class="pinterest" href="' . esc_url($pinterest_url) . '" target="_blank" rel="noopener noreferrer">Pinterest</a>';
    $share_buttons .= '<a class="twitter" href="' . esc_url($twitter_url) . '" target="_blank" rel="noopener noreferrer">Twitter</a>';
    $share_buttons .= '</div>';

    return $share_buttons;
}

require_once get_template_directory() . '/inc/social/mastodon.php';
require_once get_template_directory() . '/inc/social/twitter.php';
require_once get_template_directory() . '/inc/social/bluesky.php';

?>
