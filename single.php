<?php get_header(); ?>

<?php
if ( have_posts() ) :
    while ( have_posts() ) : the_post();

        if ( in_category( 'palestras' ) ) {
            get_template_part( 'content/palestras', 'palestras' );
        } elseif ( in_category( 'recursos' ) ) {
            get_template_part( 'content/recursos', 'recursos' );
        }  elseif ( in_category( 'projetos' ) ) {
            get_template_part( 'content/projetos', 'projetos' );
        } else {
            // Exibe o conteúdo padrão
            get_template_part( 'content/padrao', 'padrao' );
        }

    endwhile;
endif;
?>

<?php get_footer(); ?>
