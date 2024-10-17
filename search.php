<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
  <header class="entry-header mb-5">
    <h1 class="page-title pt-5 entry-title" itemprop="name">
      <?php printf( esc_html__( 'Resultado de pesquisa para: %s', 'ag' ), esc_html( get_search_query() ) ); ?>
    </h1>
  </header>

  <ul class="loop-post">
    <?php while ( have_posts() ) : the_post(); ?>
      <li class="loop-post-item">
        <span class="loop-post-date">
          <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
            <?php echo esc_html( get_the_date() ); ?>:
          </time>
        </span>

        <!-- Título do post com link -->
        <h3 class="loop-post-title">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <!-- Campo personalizado 'badge_type' -->
        <?php
        $campo_personalizado = get_post_meta( get_the_ID(), 'badge_type', true );

        if ( ! empty( $campo_personalizado ) ) :
          $slugified_value = sanitize_title( $campo_personalizado );
        ?>
          <small class="post-badge post-badge-<?php echo esc_attr( $slugified_value ); ?>">
            <?php echo esc_html( $campo_personalizado ); ?>
          </small>
        <?php endif; ?>

        <!-- Trecho do conteúdo 
        <div style="font-size: small" class="loop-post-excerpt">
          <?php the_excerpt(); ?>
        </div>-->
      </li>
    <?php endwhile; ?>
  </ul>

  <?php get_template_part( 'nav', 'below' ); ?>

<?php else : ?>
  <article id="post-0" class="post no-results not-found">
    <header class="header">
      <h1 class="entry-title" itemprop="name"><?php esc_html_e( 'Não encontrado', 'ag' ); ?></h1>
    </header>
    <div class="entry-content" itemprop="mainContentOfPage">
      <p><?php esc_html_e( 'Desculpe, nada correspondeu à sua pesquisa. Por favor, tente novamente.', 'ag' ); ?></p>
      <?php get_search_form(); ?>
    </div>
  </article>
<?php endif; ?>

<?php get_footer(); ?>
