<?php
/* Template Name: Recursos */
get_header();
?>

<?php get_template_part('template-parts/banner', 'banner'); ?>
<header class="entry-header mb-5">
  <?php the_title('<h1 class="page-title entry-title mb-4" itemprop="name">', '</h1>'); ?>
</header>


<div class="row pt-4">
      <?php get_template_part('template-parts/sidebar', 'sidebar'); ?>

      <div class="col-12 col-md-8 entry-content">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


          <div class="article_content">
            <?php the_content(); ?>
          </div>
        </article>
      </div>
    </div>

<?php
// Obter os links SOMENTE da categoria "Links"
$links_links = get_bookmarks(array(
    'orderby'    => 'name',
    'order'      => 'ASC',
    'category_name' => 'Recursos' // Filtra apenas a categoria Links
));

$grouped_links = [];
$symbols_links = []; // Armazena links que começam com números ou símbolos

// Agrupar links pela primeira letra do nome
foreach ($links_links as $link) {
    $first_char = strtoupper(mb_substr($link->link_name, 0, 1));

    // Se for um número ou símbolo, armazena separadamente
    if (!preg_match('/[A-Z]/', $first_char)) {
        $symbols_links[] = $link;
    } else {
        if (!isset($grouped_links[$first_char])) {
            $grouped_links[$first_char] = [];
        }
        $grouped_links[$first_char][] = $link;
    }
}

// Criar a lista de letras disponíveis
$letters = range('A', 'Z');
$available_letters = array_keys($grouped_links);
?>

<!-- Navegação Alfabética -->
<nav class="mb-4">
    <ul class="nav justify-content-start">
        <?php
        foreach ($letters as $letter) {
            if (in_array($letter, $available_letters)) {
                echo '<li class="nav-item"><a class="nav-link fw-bold text-dark" href="#' . $letter . '">' . $letter . '</a></li>';
            } else {
                echo '<li class="nav-item"><span class="nav-link text-muted">' . $letter . '</span></li>';
            }
        }

        // Adiciona um item para números/símbolos se existirem
        if (!empty($symbols_links)) {
            echo '<li class="nav-item"><a class="nav-link fw-bold text-dark" href="#symbols">#</a></li>';
        } else {
            echo '<li class="nav-item"><span class="nav-link text-muted">#</span></li>';
        }
        ?>
    </ul>
</nav>

<!-- Exibir links organizados por letras -->
<?php
foreach ($grouped_links as $letter => $links_array) {
    echo '<h2 id="' . $letter . '" class="mt-5 display-5 fw-bold text-dark">' . $letter . '</h2>';
    echo '<ul class="list-group list-group-flush">';
    foreach ($links_array as $link) {
        echo '<li class="px-0 list-group-item">';
        echo '<a href="' . esc_url($link->link_url) . '" target="_blank" class="stretched-link text-decoration-none text-dark fw-bold">' . esc_html($link->link_name) . '</a>: ';
        if (!empty($link->link_description)) {
            echo '<span class="mb-0 text-muted small">' . esc_html($link->link_description) . '</span>';
        }
        echo '</li>';
    }
    echo '</ul>';
}
?>

<!-- Exibir links que começam com números ou símbolos -->
<?php if (!empty($symbols_links)) { ?>
    <h2 id="symbols" class="mt-5 display-5 fw-bold text-dark">#</h2>
    <ul class="list-group list-group-flush">
        <?php
        foreach ($symbols_links as $link) {
            echo '<li class="px-0 list-group-item">';
            echo '<a href="' . esc_url($link->link_url) . '" target="_blank" class="stretched-link text-decoration-none text-dark fw-bold">' . esc_html($link->link_name) . '</a>: ';
            if (!empty($link->link_description)) {
                echo '<span class="mb-0 text-muted small">' . esc_html($link->link_description) . '</span>';
            }
            echo '</li>';
        }
        ?>
    </ul>
<?php } ?>

<?php
get_footer();
?>
