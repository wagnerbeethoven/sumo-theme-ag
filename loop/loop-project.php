
<?php
// Definir os argumentos da consulta
$args = array(
  'post_type' => 'post', // Ou 'projetos' se for um custom post type
  'category_name' => 'projetos', // Substitua pelo slug da categoria dos projetos
  'posts_per_page' => 8,
);

// Criar a consulta personalizada
$projetos_query = new WP_Query($args);

// Verificar se há posts
if ($projetos_query->have_posts()) :
  // Início do loop
  while ($projetos_query->have_posts()) : $projetos_query->the_post();
    // Obter a categoria para a classe CSS
    $categories = get_the_category();
    $category_slug = '';
    if (! empty($categories)) {
      $category_slug = $categories[0]->slug;
    }

    // Obter o ícone do campo personalizado 'icone'
    $icon_name = get_post_meta(get_the_ID(), 'project-icon', true);
    if (empty($icon_name)) {
      $icon_name = 'default-icon';
    }

    // Obter as tags do post
    $post_tags = get_the_tags();
?>
    <div class="loop-project-item">
      <div class="project-container p-0 card card-<?php echo esc_attr($category_slug); ?>">

        <div class="card-body">
          <div class="w-100">
            <?php if (has_post_thumbnail()) : ?>
              <figure class="project-figure ratio ratio-4x3">
                <?php the_post_thumbnail('medium', array('class' => 'rounded')); ?>
              </figure>
            <?php endif; ?>
            <div>
              <span class="card-icon me-3 bi bi-<?php echo esc_attr($icon_name); ?>"></span>
              <span class="visually-hidden"><?php echo esc_html($icon_name); ?></span>

              <h3 class=" card-title">
                <a href="<?php the_permalink(); ?>">
                  <?php the_title(); ?>
                </a>
              </h3>
            </div>
            <?php
            if (has_excerpt()):
              echo '<p>';
      echo strip_tags(get_the_excerpt());
      echo '</p>';
    endif;
    ?>
          </div>
          <?php
          // Exibe os valores do campo personalizado 'project_tag'
          $project_tag = get_post_meta(get_the_ID(), 'project_tag', true);
          if ($project_tag) {
            $tags_array = explode(',', $project_tag);
            foreach ($tags_array as $tag) {
              echo '<small class="border-top pt-3 mt-3 w-100 d-block">' . esc_html(trim($tag)) . '</small>';
            }
          }
          ?>
        </div>
      </div>
    </div>
<?php
  // Fim do loop
  endwhile;
  // Restaura os dados originais da consulta
  wp_reset_postdata();
else :
  echo '<p>Nenhum projeto encontrado.</p>';
endif;
?>
