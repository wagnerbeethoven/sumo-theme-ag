<?php
// Defina os parâmetros da consulta
$args = array(
  'category_name'  => 'textos', // Substitua pelo slug da sua categoria
  'posts_per_page' => 10, // Número de posts a exibir (-1 para todos)
);

// Crie a consulta personalizada
$custom_query = new WP_Query($args);

// Verifique se há posts
if ($custom_query->have_posts()) : ?>

<ul class="loop-post">
  <?php
    // Início do loop
    while ($custom_query->have_posts()) : $custom_query->the_post();
    ?>
  <li id="post-<?php the_ID(); ?>" <?php post_class(' loop-post-item'); ?>>
    <!-- Exibe a data de publicação ou atualização -->
    <span class="loop-post-date">
      <time datetime="<?php echo get_the_modified_date('Y-m-d'); ?>">
        <?php echo get_the_modified_date(); ?>
      </time>
      <!-- Ou para data de atualização -->
      <!-- Atualizado em: <?php echo get_the_modified_date(); ?> -->
    </span>

    <!-- Exibe o título com link para o post -->
    <h3 class="loop-post-title">
      <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
    </h3>

    <!-- Exibe o campo personalizado -->
    <!-- Seu código personalizado -->
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
  <?php
    // Fim do loop
    endwhile;
    ?>
</ul>

<?php
  // Restaura os dados originais da consulta
  wp_reset_postdata();

else :
  echo '<p>Nenhum post encontrado nesta categoria.</p>';
endif;
?>