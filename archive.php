<?php get_header(); ?>
<header class="entry-header mb-5 ">
  <h1 class="page-title pt-5entry-title" itemprop="name">
  <?php the_archive_title(); ?>

  </h1>
  <div class="archive-meta col-12 col-md-8" itemprop="description">
  <?php if ( '' != get_the_archive_description() ) {
        echo get_the_archive_description();
      } ?>
  </div>
</header>
<ul class="loop-post">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>


      <li class="loop-post-item"><span class="loop-post-date">
          <time datetime="<?php echo get_the_date('Y-m-d'); ?>">
            <?php echo get_the_date(); ?>:
          </time>
          <!-- Ou para data de atualização -->
          <!-- Atualizado em: <?php echo get_the_date(); ?> -->
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


  <?php endwhile;
  endif; ?>
</ul>
<?php get_template_part('nav', 'below'); ?>
<?php get_footer(); ?>