<?php
// Verifica se estamos em um post individual
if (is_single()) :
    // Obtém o valor do campo personalizado 'exibir_toc' para o post atual
    $exibir_toc = get_post_meta(get_the_ID(), 'exibir_toc', true);

    // Exibe a <details> apenas se $exibir_toc for true
    if ($exibir_toc):
        ?>
        <details class="toc-post">
            <summary>Índice da página</summary>
            <?php
            // Exibe o TOC usando o shortcode
            echo do_shortcode('[toc]');
            ?>

            <div class="border-top pt-2 mt-3">
                <i class="bi bi-arrow-left me-3"></i> Todos os <?php the_category(', '); ?>
            </div>
        </details>
        <?php
    endif; // Fim da verificação de $exibir_toc
endif; // Fim da verificação de is_single()
?>
