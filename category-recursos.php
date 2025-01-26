<?php get_header(); ?>
<header class="entry-header mb-5">
  <h1 class="page-title pt-5 entry-title" itemprop="name">
    <?php single_term_title(); ?>
  </h1>
  <div class="archive-meta col-12 col-md-8" itemprop="description">
    <?php if (get_the_archive_description()) {
      echo get_the_archive_description();
    } ?>
  </div>
</header>

  <?php
  // Query para listar todos os posts
  $all_posts = new WP_Query(array(
    'post_type' => 'post',  // Tipo de post
    'posts_per_page' => -1, // -1 para listar todos
    'category_name'  => 'recursos', // Substitua pelo slug da sua categoria
    'order'  => 'ASC',
    'orderby' => 'meta_value',
    'meta_key' => 'badge_type'
  ));

  $grouped_posts = [];

  if ($all_posts->have_posts()) :
    while ($all_posts->have_posts()) : $all_posts->the_post();
      $post_id = get_the_ID();
      $post_title = get_the_title();
      $post_content = apply_filters('the_content', get_the_content());

      // Recupera os campos personalizados
      $campo_personalizado = get_post_meta($post_id, 'badge_type', true);
      $link_adicional = get_post_meta($post_id, 'publication_url', true);
      $nome_link_adicional = get_post_meta($post_id, 'publication_source', true);

      // Agrupa os posts pelo campo personalizado
      if (!isset($grouped_posts[$campo_personalizado])) {
        $grouped_posts[$campo_personalizado] = [];
      }
      $grouped_posts[$campo_personalizado][] = [
        'id' => $post_id,
        'title' => $post_title,
        'content' => $post_content,
        'link_adicional' => $link_adicional,
        'nome_link_adicional' => $nome_link_adicional
      ];
    endwhile;
    wp_reset_postdata();
  endif;

  // Exibe os posts agrupados
  if (!empty($grouped_posts)) :
    ksort($grouped_posts); // Ordena os grupos pelo campo personalizado
    foreach ($grouped_posts as $campo => $posts) :
  ?>
        <h2 class="loop-post-group-title"><?php echo esc_html($campo ?: 'Sem Categoria'); ?></h2>
        <ul class="loop-post">

          <?php foreach ($posts as $post) : ?>
            <li class="loop-post-item">
              <h3 class="loop-post-title">
                <a href="#" data-bs-toggle="modal" data-bs-target="#modal-<?php echo esc_attr($post['id']); ?>">
                  <?php echo esc_html($post['title']); ?>
                </a>
              </h3>
              <div class="modal fade" id="modal-<?php echo esc_attr($post['id']); ?>" tabindex="-1" aria-labelledby="modalLabel-<?php echo esc_attr($post['id']); ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="modalLabel-<?php echo esc_attr($post['id']); ?>">
                        <?php echo esc_html($post['title']); ?>
                      </h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" title="Fechar" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <?php echo $post['content']; ?>
                    </div>
                    <div class="modal-footer d-flex align-items-center justify-content-between">
                      <?php if (!empty($post['link_adicional'])) : ?>
                        <a class="icon-link lh-1" href="<?php echo esc_url($link_adicional); ?>" target="_blank">
                    <span class="bi bi-link-45deg" aria-hidden="true"></span>
                    <?php echo esc_html($nome_link_adicional); ?>
                    <span class="bi bi-arrow-right-short" aria-hidden="true"></span>
                </a>
                      <?php endif; ?>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          <?php endforeach; ?>
          <div class="p-4"></div>
        </ul>
  <?php
    endforeach;
  else :
  ?>
    <li>Nenhum post encontrado.</li>
  <?php endif; ?>

<?php get_template_part('nav', 'below'); ?>
<?php get_footer(); ?>
