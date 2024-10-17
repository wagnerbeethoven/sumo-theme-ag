<?php
/*
Template Name: Home
*/ ?>
<?php get_header(); ?>


<h1 class="page-title">Olá, sou <mark>Wagner</mark></h1>

<?php the_content(); ?>


<?php get_template_part('template-parts/menu') ?>
<?php get_template_part('template-parts/social') ?>


<section id="portfolio">
  <h2 class="section-title">Acesse meus <?php $slug_categoria = 'projetos';
                                        $categoria = get_category_by_slug($slug_categoria);
                                        if (! is_wp_error($categoria)) {
                                          echo '<a href="' . esc_url(get_category_link($categoria->term_id)) . '">projetos</a>';
                                        } ?></h2>
  <p class="section-subtitle lead">Todos os links dos meus projetos levam para o Behance</p>
  <div class="row">
    <?php get_template_part('loop/loop-project'); ?>

  </div>
</section>


<section id="blog">
  <h2 class="section-title">Leia meus <?php $slug_categoria = 'textos';
                                      $categoria = get_category_by_slug($slug_categoria);
                                      if (! is_wp_error($categoria)) {
                                        echo '<a href="' . esc_url(get_category_link($categoria->term_id)) . '">textos</a>';
                                      } ?> do
    blog</h2>
  <?php get_template_part('loop/loop-textos'); ?>
</section>

<section id="palestras">
  <h2 class="section-title">Confira minhas <?php $slug_categoria = 'palestras';
                                            $categoria = get_category_by_slug($slug_categoria);
                                            if (! is_wp_error($categoria)) {
                                              echo '<a href="' . esc_url(get_category_link($categoria->term_id)) . '">palestras</a>';
                                            } ?></h2>
  <?php get_template_part('loop/loop-presentation'); ?>
</section>

<?php get_footer(); ?>