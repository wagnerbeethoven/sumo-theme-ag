<?php if ( has_post_thumbnail() ) : ?>
  <figure class="page-banner">
    <?php
    // Exibe a imagem destacada com a classe CSS desejada
    the_post_thumbnail( 'full', array( 'class' => 'page-banner-img' ) );

    // Obtém a legenda da imagem destacada
    $caption = get_the_post_thumbnail_caption();

    if ( $caption ) :
    ?>
      <figcaption class="page-banner-legend">
        <?php echo wp_kses_post( $caption ); ?>
      </figcaption>
    <?php endif; ?>
  </figure>
<?php else : ?>
  <div class="py-4"></div>

<?php endif; ?>
