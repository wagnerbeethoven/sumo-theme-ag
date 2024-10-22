<?php get_header(); ?>

<div class="author-page">
  <div class="author-info">
    <?php
    $author = get_queried_object();

    // Exibe o avatar do autor
    echo get_avatar( $author->ID, 128 );

    // Exibe o nome do autor
    echo '<h1>' . esc_html( $author->display_name ) . '</h1>';

    // Exibe a biografia
    if ( ! empty( $author->description ) ) {
      echo '<p>' . esc_html( $author->description ) . '</p>';
    }

    // Exibe as redes sociais
    echo '<div class="author-social">';
    $social_networks = array( 'facebook', 'twitter', 'instagram', 'linkedin' );
    foreach ( $social_networks as $network ) {
      $profile_url = get_the_author_meta( $network, $author->ID );
      if ( $profile_url ) {
        echo '<a href="' . esc_url( $profile_url ) . '">' . ucfirst( $network ) . '</a> ';
      }
    }
    echo '</div>';
    ?>
  </div>

  <div class="author-posts">
    <h2>Publicações de <?php echo esc_html( $author->display_name ); ?></h2>
    <?php if ( have_posts() ) : ?>
      <ul>
        <?php while ( have_posts() ) : the_post(); ?>
          <li>
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <span><?php echo get_the_date(); ?></span>
          </li>
        <?php endwhile; ?>
      </ul>

      <?php the_posts_pagination(); ?>

    <?php else : ?>
      <p>Este autor ainda não possui publicações.</p>
    <?php endif; ?>
  </div>
</div>

<?php get_footer(); ?>
