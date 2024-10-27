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

<div class="row" data-masonry="{&quot;percentPosition&quot;: true }">
  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <div class="resources" id="resources-<?php the_ID(); ?>">
    <div class="resources-container resources-<?php $campo_personalizado = get_post_meta(get_the_ID(), 'badge_type', true); if (! empty($campo_personalizado)) : $slugified_value = sanitize_title($campo_personalizado); ?><?php echo esc_html($slugified_value); ?><?php endif; ?>">
      <div class="resources-body">
        <span class="resources-category">
          <!-- ícone -->
          <?php $campo_personalizado = get_post_meta(get_the_ID(), 'project-icon', true); if (! empty($campo_personalizado)) : $slugified_value = sanitize_title($campo_personalizado); ?> <span class="me-2 bi bi-<?php echo esc_attr($slugified_value); ?>"> </span> <?php endif; ?>

          <!-- texto -->
          <?php $campo_personalizado = get_post_meta(get_the_ID(), 'badge_type', true); if (! empty($campo_personalizado)) : $slugified_value = sanitize_title($campo_personalizado); ?> <span class="resource-type"> <?php echo esc_html($campo_personalizado); ?> </span> <?php endif; ?>

        </span>
        <!-- título -->
        <h2 class="resources-title"><?php the_title(); ?></h2>
        <!-- título -->
        <div class="resources-text">
          <?php the_content(); ?>
        </div>
        
      </div>
      <div class="resources-footer">
        <?php $link_adicional = get_post_meta(get_the_ID(), 'publication_url', true); $nome_link_adicional = get_post_meta(get_the_ID(), 'publication_source', true); if (! empty($link_adicional)) :?>
        <a class="text-truncate" href="<?php echo esc_url($link_adicional); ?>">
          <?php echo esc_html($nome_link_adicional); ?>
        </a>
        <?php endif; ?>
      </div>
    </div>
  </div>


  <?php endwhile;
  endif; ?>
</div>
<?php get_template_part('nav', 'below'); ?>
<?php get_footer(); ?>