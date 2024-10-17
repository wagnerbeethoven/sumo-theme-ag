<?php
/* Template Name: List All Posts and Pages */
get_header(); ?>


<h1><?php the_title(); ?></h1>
<section class="section-posts">
  <h2 class="section-title">Publicações</h2>
  <ul class="loop-post">
    <?php
    // Query para listar todos os posts
    $all_posts = new WP_Query(array(
      'post_type' => 'post',  // Tipo de post
      'posts_per_page' => -1, // -1 para listar todos
    ));

    if ($all_posts->have_posts()) :
      while ($all_posts->have_posts()) : $all_posts->the_post(); ?>

        <li class="loop-post-item">

          <span class="loop-post-date">
            <time datetime="<?php echo get_the_date('Y-m-d'); ?>">
              <?php echo get_the_date(); ?>:
            </time>
            <!-- Ou para data de atualização -->
            <!-- Atualizado em: <?php echo get_the_date(); ?> -->
          </span>

          <h3 class="loop-post-title">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h3>

          <?php
          // Recupera o valor do campo personalizado 'tipo'
          $campo_personalizado = get_post_meta(get_the_ID(), 'badge_type', true);

          if (! empty($campo_personalizado)) :
            // Slugifica o valor
            $slugified_value = sanitize_title($campo_personalizado);
          ?>
            <small class="post-badge post-badge-<?php echo esc_attr($slugified_value); ?>">
              <?php echo esc_html($campo_personalizado); ?>
            </small>
          <?php endif; ?>
        </li>
      <?php endwhile;
      wp_reset_postdata();  // Resetar o loop
    else : ?>
      <li>Nenhum post encontrado.</li>
    <?php endif; ?>
  </ul>
</section>
<div class="row">
  <div class="col-12 col-md">
    <section class="section-pages">
      <h2 class="section-title">Seções do site</h2>
      <ul class="loop-post">
        <?php
        $categories = get_categories(array(
          'orderby' => 'name',  // Ordenar pelo nome (alfabeticamente)
          'order' => 'ASC'      // Ordem ascendente (A-Z)
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
          'post_type' => 'page',  // Tipo de página
          'posts_per_page' => -1, // -1 para listar todas as páginas
          'post__not_in' => array(get_option('page_on_front'), get_the_ID()), // Excluir página inicial e página atual
          'orderby' => 'title',  // Ordenar alfabeticamente pelo título
          'order' => 'ASC',      // Ordem ascendente (A-Z)
        ));

        if ($all_pages->have_posts()) :
          while ($all_pages->have_posts()) : $all_pages->the_post(); ?>
            <li class="loop-post-item">
              <h3 class="loop-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
              </h3>
            </li>
          <?php endwhile;
          wp_reset_postdata();  // Resetar o loop
        else : ?>
          <li>Nenhuma página encontrada.</li>
        <?php endif; ?>
      </ul>
    </section>
  </div>
</div>
<section class="section-pages">
  <h2 class="section-title">Assuntos</h2>
  <form action="" method="get" class="col-12 col-md-6 form-floating"onsubmit="return false;">
      <select name="tag-dropdown" onchange="document.location.href=this.options[this.selectedIndex].value;"class="form-select" id="assuntos"  aria-label="Selecione o assunto">
        <option value="">Escolha uma opção</option>
        <?php
        $tags = get_tags(array(
          'orderby' => 'name',  // Ordenar pelo nome (alfabeticamente)
          'order' => 'ASC'      // Ordem ascendente (A-Z)
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