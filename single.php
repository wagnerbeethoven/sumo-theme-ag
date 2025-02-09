<?php get_header(); ?>

<?php
if (have_posts()):
    while (have_posts()):
        the_post();

        if (in_category('palestras')) {
            get_template_part('content/presentation', 'presentation');
        }
        
        elseif (in_category('projetos')) {
            get_template_part('content/project', 'project');
        } else {
            // Exibe o conteúdo padrão
            get_template_part('content/default', 'default');
        }

    endwhile;
endif;
?>

<?php get_footer(); ?>