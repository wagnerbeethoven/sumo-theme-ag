<?php get_header(); ?>
<header class="entry-header mb-5 ">
  <h1 class="page-title pt-5entry-title" itemprop="name">
    <?php single_term_title(); ?>
  </h1>
  <div class="archive-meta col-12 col-md-8" itemprop="description">
    <?php if ('' != get_the_archive_description()) {
      echo get_the_archive_description();
    } ?>
  </div>
</header>

<ul class="loop-post">
  <?php
  // Query para listar todos os posts
  $all_posts = new WP_Query(array(
    'post_type' => 'post',  // Tipo de post
    'posts_per_page' => -1, // -1 para listar todos
    'category_name'  => 'recursos', // Substitua pelo slug da sua categoria
    'order'  =>  'ASC' ,
    'orderby' =>  'title'

  ));

  if ($all_posts->have_posts()) :
    while ($all_posts->have_posts()) : $all_posts->the_post(); ?>

      <li class="loop-post-item">

        <span class="loop-post-date">
          <!-- <time datetime="<?php echo get_the_date('Y-m-d'); ?>">
              <?php echo get_the_date(); ?>:
            </time> -->
          <?php
          // Recupera o valor do campo personalizado 'tipo'
          $campo_personalizado = get_post_meta(get_the_ID(), 'badge_type', true);

          if (! empty($campo_personalizado)) :
            // Slugifica o valor
            $slugified_value = sanitize_title($campo_personalizado);
          ?> <?php echo esc_html($campo_personalizado); ?>: 
          <?php endif; ?>
        </span>

        <h3 class="loop-post-title">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>


      </li>
    <?php endwhile;
    wp_reset_postdata();  // Resetar o loop
  else : ?>
    <li>Nenhum post encontrado.</li>
  <?php endif; ?>
</ul>
<?php get_template_part('nav', 'below'); ?>
<?php get_footer(); ?>