    <!-- get_the_excerpt -->
    <?php
    if (has_excerpt()) :
      echo '<p class="post-summary"><strong>Nesta página: </strong>';
      echo strip_tags(get_the_excerpt());
      echo '</p>';
    endif;
    ?>
    <!-- get_the_excerpt -->