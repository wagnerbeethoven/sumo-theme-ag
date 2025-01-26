<?php
/* Template Name: List All Posts and Pages */
get_header(); ?>
<h1><?php the_title(); ?></h1>
<section class="section-posts">
  <h2 class="section-title">Publicações</h2>
  <?php
  // Obter todas as categorias, ordenadas pela data do último post
  $categories = get_categories(array(
    'orderby' => 'term_id',
    'order' => 'DESC', // Exibe categorias com posts mais recentes primeiro
    'hide_empty' => true // Excluir categorias sem posts
  ));

  foreach ($categories as $category) : ?>
    <section class="category-section">
      <h3 class="category-title mt-5 mb-3">
        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
          <?php echo esc_html($category->name); ?>
        </a>
      </h3>
      <ul class="loop-post">
        <?php
        // Query para listar os posts de cada categoria
        $category_posts = new WP_Query(array(
          'cat' => $category->term_id, // ID da categoria atual
          'posts_per_page' => -1, // Listar todos os posts
          'orderby' => 'date', // Ordenar posts por data
          'order' => 'DESC' // Posts mais recentes primeiro
        ));

        if ($category_posts->have_posts()) :
          while ($category_posts->have_posts()) : $category_posts->the_post(); ?>
            <li class="loop-post-item">
              <span class="loop-post-date">
                <time datetime="<?php echo get_the_date('Y-m-d'); ?>">
                  <?php echo get_the_date(); ?>:
                </time>
              </span>
              <h4 class="loop-post-title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h4>
              <?php
              // Exibir badge do campo personalizado, se existir
              $badge_type = get_post_meta(get_the_ID(), 'badge_type', true);
              if (!empty($badge_type)) :
                $slugified_badge = sanitize_title($badge_type);
              ?>
                <small class="post-badge post-badge-<?php echo esc_attr($slugified_badge); ?>">
                  <?php echo esc_html($badge_type); ?>
                </small>
              <?php endif; ?>
            </li>
          <?php endwhile;
          wp_reset_postdata();
        else : ?>
          <li>Nenhum post nesta categoria.</li>
        <?php endif; ?>
      </ul>
    </section>
  <?php endforeach; ?>
</section>

<div class="row">
  <div class="col-12 col-md">
    <section class="section-pages">
      <h2 class="section-title">Seções do site</h2>
      <ul class="loop-post">
        <?php
        $categories = get_categories(array(
          'orderby' => 'name', // Ordenar pelo nome (alfabeticamente)
          'order' => 'ASC' // Ordem ascendente (A-Z)
        ));
        foreach ($categories as $category) {
          echo '<li class="loop-post-item">
        <h3 class="loop-post-title"><a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a></h3></li>';
        }
        ?>
      </ul>
    </section>
  </div>
  <div class="col-12 col-md">
    <section class="section-pages">
      <h2 class="section-title">Páginas</h2>
      <ul class="loop-post">
        <?php
        // Query para listar todas as páginas
        $all_pages = new WP_Query(array(
          'post_type' => 'page',
          'posts_per_page' => -1,
          'post__not_in' => array(get_option('page_on_front'), get_the_ID()),
          'orderby' => 'title',
          'order' => 'ASC',
        ));

        if ($all_pages->have_posts()) :
          while ($all_pages->have_posts()) : $all_pages->the_post(); ?>
            <li class="loop-post-item">
              <h3 class="loop-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h3>
            </li>
          <?php endwhile;
          wp_reset_postdata();
        else : ?>
          <li>Nenhuma página encontrada.</li>
        <?php endif; ?>
      </ul>
    </section>
  </div>
</div>
<section class="section-pages">
  <h2 class="section-title">Assuntos</h2>
  <form action="" method="get" class="col-12 col-md-6 form-floating" onsubmit="return false;">
    <select name="tag-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;" class="form-select" id="assuntos" aria-label="Selecione o assunto">
      <option value="">Escolha uma opção</option>
      <?php
      $tags = get_tags(array(
        'orderby' => 'name',
        'order' => 'ASC',
      ));

      foreach ($tags as $tag) {
        echo '<option value="' . get_tag_link($tag->term_id) . '">' . $tag->name . '</option>';
      }
      ?>
    </select>
    <label for="assuntos">Selecione o assunto</label>
  </form>
</section>

<?php get_footer(); ?>
