<?php
$args = array(
  'category_name'  => 'palestras', // Substitua pelo slug da sua categoria
  'posts_per_page' => 10, // Número de posts a exibir (-1 para todos)
);

$custom_query = new WP_Query($args);

if ($custom_query->have_posts()) : ?>

  <ul class="loop-post">
    <?php
    while ($custom_query->have_posts()) : $custom_query->the_post();
    ?>
      <li id="post-<?php the_ID(); ?>" <?php post_class(' loop-post-item'); ?>>
        <span class="loop-post-date">
          <time datetime="<?php echo get_the_modified_date('Y-m-d'); ?>">
            <?php echo get_the_modified_date(); ?>
          </time>
          <!-- Atualizado em: <?php echo get_the_modified_date(); ?> -->
        </span>

        <h3 class="loop-post-title">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <?php
        $campo_personalizado = get_post_meta(get_the_ID(), 'badge_type', true);

        if (! empty($campo_personalizado)) :
          $slugified_value = sanitize_title($campo_personalizado);
        ?>
          <small class="post-badge post-badge-<?php echo esc_attr($slugified_value); ?>">
            <?php echo esc_html($campo_personalizado); ?>
          </small>
        <?php endif; ?>
      </li>
    <?php
    endwhile;
    ?>
  </ul>

<?php
  wp_reset_postdata();

else :
  echo '<p>Nenhuma publicação encontrado nesta seção.</p>';
endif;
?>