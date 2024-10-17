<?php get_header(); ?>

<?php
if ( have_posts() ) :
    while ( have_posts() ) : the_post();

        if ( in_category( 'palestras' ) ) {
            // Inclui um template parcial ou adiciona código específico para 'categoria1'
            get_template_part( 'content/palestras', 'palestras' );
        } elseif ( in_category( 'recursos' ) ) {
            // Inclui um template parcial ou adiciona código específico para 'categoria2'
            get_template_part( 'content/recursos', 'recursos' );
        } else {
            // Exibe o conteúdo padrão
            get_template_part( 'content/padrao', 'padrao' );
        }

    endwhile;
endif;
?>

<?php get_footer(); ?>
