<?php


// JS
function theme_script()
{
  // Scripts necessários
  wp_enqueue_script('jquery', 'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js', array(), '3.7.1', true);
  wp_enqueue_script('popper-js', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.8/umd/popper.min.js', array('jquery'), '2.11.8', true);
  wp_enqueue_script('bootstrap-js', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js', array('jquery', 'popper-js'), '5.3.3', true);
  wp_enqueue_script('google-translate', '//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit', array(), null, true);
  wp_enqueue_script('masonry-js', 'https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js', array(), '4.2.2', true);
  wp_enqueue_script('main-js', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'theme_script');


// Estilos
function theme_styles()
{
  // Bootstrap CSS
  // wp_enqueue_style(
  //   'bootstrap',
  //   'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css',
  //   array(), // Sem dependências
  //   '5.3.0'
  // );

  // Fontes do Google
  wp_enqueue_style(
    'open-sans',
    'https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap',
    array(), // Sem dependências
    null
  );

  // Bootstrap Icons
  wp_enqueue_style(
    'bootstrap-icons',
    'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css',
    array(), // Sem dependências
    '1.11.3'
  );

  // Estilo principal do tema - depende de bootstrap, open-sans e bootstrap-icons
  wp_enqueue_style(
    'main-css',
    get_stylesheet_directory_uri() . '/style.css',
    array('bootstrap', 'open-sans', 'bootstrap-icons'), // Dependências
    '1.0.0',
    'all'
  );
}
add_action('wp_enqueue_scripts', 'theme_styles', 20); // Prioridade 20 para carregar por último



add_action('after_setup_theme', 'ag_setup');
function ag_setup()
{
  load_theme_textdomain('ag', get_template_directory() . '/languages');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('responsive-embeds');
  add_theme_support('automatic-feed-links');
  add_theme_support('html5', array('search-form', 'navigation-widgets'));
  add_theme_support('appearance-tools');
  add_theme_support('woocommerce');
  global $content_width;
  if (!isset($content_width)) {
    $content_width = 1920;
  }
  // register_nav_menus(array(
  //   'main-menu' => esc_html__(
  //     'Main Menu',
  //     'ag'
  //   )
  // ));
}
add_action('admin_notices', 'ag_notice');
function ag_notice()
{
  $user_id = get_current_user_id();
  $admin_url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $param = (count($_GET)) ? '&' : '?';
  if (!get_user_meta($user_id, 'ag_notice_dismissed_11') && current_user_can('manage_options'))
    echo '<div class="notice notice-info"><p><a href="' . esc_url($admin_url), esc_html($param) . 'dismiss" class="alignright" style="text-decoration:none"><big>' . esc_html__('Ⓧ', 'ag') . '</big></a>' . wp_kses_post(__('<big><strong>🏆 Thank you for using ag!</strong></big>', 'ag')) . '<p>' . esc_html__('Powering over 10k websites! Buy me a sandwich! 🥪', 'ag') . '</p><a href="https://github.com/bhadaway/ag/issues/57" class="button-primary" target="_blank"><strong>' . esc_html__('How do you use ag?', 'ag') . '</strong></a> <a href="https://opencollective.com/ag" class="button-primary" style="background-color:green;border-color:green" target="_blank"><strong>' . esc_html__('Donate', 'ag') . '</strong></a> <a href="https://wordpress.org/support/theme/ag/reviews/#new-post" class="button-primary" style="background-color:purple;border-color:purple" target="_blank"><strong>' . esc_html__('Review', 'ag') . '</strong></a> <a href="https://github.com/bhadaway/ag/issues" class="button-primary" style="background-color:orange;border-color:orange" target="_blank"><strong>' . esc_html__('Support', 'ag') . '</strong></a></p></div>';
}
add_action('admin_init', 'ag_notice_dismissed');
function ag_notice_dismissed()
{
  $user_id = get_current_user_id();
  if (isset($_GET['dismiss']))
    add_user_meta($user_id, 'ag_notice_dismissed_11', 'true', true);
}
add_action('wp_enqueue_scripts', 'ag_enqueue');
function ag_enqueue()
{
  wp_enqueue_style('ag-style', 'get_stylesheet_uri()');
  wp_enqueue_script('jquery');
}
add_action('wp_footer', 'ag_footer');
function ag_footer()
{
?>
<script>
jQuery(document).ready(function($) {
  var deviceAgent = navigator.userAgent.toLowerCase();
  if (deviceAgent.match(/(iphone|ipod|ipad)/)) {
    $("html").addClass("ios");
    $("html").addClass("mobile");
  }
  if (deviceAgent.match(/(Android)/)) {
    $("html").addClass("android");
    $("html").addClass("mobile");
  }
  if (navigator.userAgent.search("MSIE") >= 0) {
    $("html").addClass("ie");
  } else if (navigator.userAgent.search("Chrome") >= 0) {
    $("html").addClass("chrome");
  } else if (navigator.userAgent.search("Firefox") >= 0) {
    $("html").addClass("firefox");
  } else if (navigator.userAgent.search("Safari") >= 0 && navigator.userAgent.search("Chrome") < 0) {
    $("html").addClass("safari");
  } else if (navigator.userAgent.search("Opera") >= 0) {
    $("html").addClass("opera");
  }
});
</script>
<?php
}
add_filter('document_title_separator', 'ag_document_title_separator');
function ag_document_title_separator($sep)
{
  $sep = esc_html('|');
  return $sep;
}
add_filter('the_title', 'ag_title');
function ag_title($title)
{
  if ($title == '') {
    return esc_html('...');
  } else {
    return wp_kses_post($title);
  }
}
function ag_schema_type()
{
  $schema = 'https://schema.org/';
  if (is_single()) {
    $type = "Article";
  } elseif (is_author()) {
    $type = 'ProfilePage';
  } elseif (is_search()) {
    $type = 'SearchResultsPage';
  } else {
    $type = 'WebPage';
  }
  echo 'itemscope itemtype="' . esc_url($schema) . esc_attr($type) . '"';
}
add_filter('nav_menu_link_attributes', 'ag_schema_url', 10);
function ag_schema_url($atts)
{
  $atts['itemprop'] = 'url';
  return $atts;
}
if (!function_exists('ag_wp_body_open')) {
  function ag_wp_body_open()
  {
    do_action('wp_body_open');
  }
}
add_action('wp_body_open', 'ag_skip_link', 5);
function ag_skip_link()
{
  echo '<a href="#content" class="skip-link screen-reader-text">' . esc_html__('Skip to the content', 'ag') . '</a>';
}
add_filter('the_content_more_link', 'ag_read_more_link');
function ag_read_more_link()
{
  if (!is_admin()) {
    return ' <a href="' . esc_url(get_permalink()) . '" class="more-link">' . sprintf(__('...%s', 'ag'), '<span class="screen-reader-text">  ' . esc_html(get_the_title()) . '</span>') . '</a>';
  }
}
add_filter('excerpt_more', 'ag_excerpt_read_more_link');
function ag_excerpt_read_more_link($more)
{
  if (!is_admin()) {
    global $post;
    return ' <a href="' . esc_url(get_permalink($post->ID)) . '" class="more-link">' . sprintf(__('...%s', 'ag'), '<span class="screen-reader-text">  ' . esc_html(get_the_title()) . '</span>') . '</a>';
  }
}
add_filter('big_image_size_threshold', '__return_false');
add_filter('intermediate_image_sizes_advanced', 'ag_image_insert_override');
function ag_image_insert_override($sizes)
{
  unset($sizes['medium_large']);
  unset($sizes['1536x1536']);
  unset($sizes['2048x2048']);
  return $sizes;
}
add_action('widgets_init', 'ag_widgets_init');
function ag_widgets_init()
{
  register_sidebar(array(
    'name' => esc_html__('Sidebar Widget Area', 'ag'),
    'id' => 'primary-widget-area',
    'before_widget' => '<li id="%1$s" class="px-0 border-0 list-group-item mb-3 widget-container %2$s">',
    'after_widget' => '</li>',
    'before_title' => '<h3 class="widget-title">',
    'after_title' => '</h3>',
  ));
}
add_action('wp_head', 'ag_pingback_header');
function ag_pingback_header()
{
  if (is_singular() && pings_open()) {
    printf('<link rel="pingback" href="%s">' . "\n", esc_url(get_bloginfo('pingback_url')));
  }
}
add_action('comment_form_before', 'ag_enqueue_comment_reply_script');
function ag_enqueue_comment_reply_script()
{
  if (get_option('thread_comments')) {
    wp_enqueue_script('comment-reply');
  }
}
function ag_custom_pings($comment)
{
?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>"><?php echo esc_url(comment_author_link()); ?></li>
<?php
}
add_filter('get_comments_number', 'ag_comment_count', 0);
function ag_comment_count($count)
{
  if (!is_admin()) {
    global $id;
    $get_comments = get_comments('status=approve&post_id=' . $id);
    $comments_by_type = separate_comments($get_comments);
    return count($comments_by_type['comment']);
  } else {
    return $count;
  }
}



// Logo
function setup()
{
  add_theme_support('post-thumbnails');

  add_theme_support('custom-logo', array(
    'height'      => 250,
    'width'       => 250,
    'flex-height' => true,
    'flex-width'  => true,
  ));
}
add_action('after_setup_theme', 'setup');




// Registro do menu
function menu_ag()
{
  register_nav_menus(array(
    'menu_rodape' => __('Menu Footer'),
    'social' => __('Social Footer'),
  ));
}
add_action('init', 'menu_ag');


// Inclui a classe Walker
require_once get_stylesheet_directory() . '/template-parts/class-social-menu-walker.php';

// Single category
function single_category($single_template)
{
  global $post;

  $categories = array('blog', 'projetos', 'palestras', 'notas');
  foreach ($categories as $category) {
    if (in_category($category, $post->ID)) {
      $template = get_stylesheet_directory() . '/single-' . $category . '.php';
      if (file_exists($template)) {
        return $template;
      }
    }
  }

  return $single_template;
}
add_filter('single_template', 'single_category');


// SVG Upload
add_filter('upload_mimes', function ($upload_mimes) {
  if (! current_user_can('administrator')) {
    return $upload_mimes;
  }

  $upload_mimes['svg']  = 'image/svg+xml';
  $upload_mimes['svgz'] = 'image/svg+xml';

  return $upload_mimes;
});

// Add thumbail inside rss
function wpcode_snippet_rss_post_thumbnail($content)
{
  global $post;
  if (has_post_thumbnail($post->ID)) {
    $content = '<p>' . get_the_post_thumbnail($post->ID) . '</p>' . $content;
  }

  return $content;
}
add_filter('the_excerpt_rss', 'wpcode_snippet_rss_post_thumbnail');
add_filter('the_content_feed', 'wpcode_snippet_rss_post_thumbnail');

// Remove WordPress version
add_filter('the_generator', '__return_empty_string');

// Add SVG files mime check.
add_filter(
  'wp_check_filetype_and_ext',
  function ($wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime) {

    if (! $wp_check_filetype_and_ext['type']) {

      $check_filetype  = wp_check_filetype($filename, $mimes);
      $ext             = $check_filetype['ext'];
      $type            = $check_filetype['type'];
      $proper_filename = $filename;

      if ($type && 0 === strpos($type, 'image/') && 'svg' !== $ext) {
        $ext  = false;
        $type = false;
      }

      $wp_check_filetype_and_ext = compact('ext', 'type', 'proper_filename');
    }

    return $wp_check_filetype_and_ext;
  },
  10,
  5
);
add_filter('wp_check_filetype_and_ext', function ($wp_check_filetype_and_ext, $file, $filename, $mimes, $real_mime) {
  if (! $wp_check_filetype_and_ext['type']) {
    $check_filetype  = wp_check_filetype($filename, $mimes);
    $ext             = $check_filetype['ext'];
    $type            = $check_filetype['type'];
    $proper_filename = $filename;

    if ($type && 0 === strpos($type, 'image/') && 'svg' !== $ext) {
      $ext  = false;
      $type = false;
    }

    $wp_check_filetype_and_ext = compact('ext', 'type', 'proper_filename');
  }

  return $wp_check_filetype_and_ext;
}, 10, 5);

// Calculate Reading time for the content
function calculate_reading_time($content)
{
  $word_count    = str_word_count(strip_tags($content));
  $reading_speed = 200;
  $reading_time  = ceil($word_count / $reading_speed);
  return $reading_time;
}




// Display Reading time
function display_reading_time()
{
  $content      = get_post_field('post_content', get_the_ID());
  $reading_time = calculate_reading_time($content);
  if (1 === $reading_time) {
    return sprintf(__('%s minuto', 'text_domain'), $reading_time);
  } else {
    return sprintf(__('%s minutos', 'text_domain'), $reading_time);
  }
}

add_shortcode('reading_time', 'display_reading_time');