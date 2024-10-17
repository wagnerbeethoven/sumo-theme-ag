<div class="related-post">
  <?php
    // Obter o post anterior
    $prev_post = get_previous_post();
    if ( ! empty( $prev_post ) ) : ?>
  <a class="related-post-prev" href="<?php echo get_permalink( $prev_post->ID ); ?>"
    title="Leia a publicação &quot;<?php echo esc_attr( get_the_title( $prev_post->ID ) ); ?>&quot;">
    <small>Publicação anterior</small>
    <p>
      <span class="bi bi-arrow-left-square"></span>
      <span><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
    </p>
  </a>
  <?php endif; ?>

  <?php
    // Obter o próximo post
    $next_post = get_next_post();
    if ( ! empty( $next_post ) ) : ?>
  <a class="related-post-next" href="<?php echo get_permalink( $next_post->ID ); ?>"
    title="Leia a publicação &quot;<?php echo esc_attr( get_the_title( $next_post->ID ) ); ?>&quot;">
    <small>Próxima publicação</small>
    <p>
      <span><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
      <span class="bi bi-arrow-right-square"></span>
    </p>
  </a>
  <?php endif; ?>
</div>