<?php

get_header();
?>
<Section>
    <?php
    if (have_posts()):
        while (have_posts()):
            the_post(); ?>
            <article class="my-post">
               
                <?php the_content(); ?>
            </article>
        <?php endwhile;
    endif;
    ?>
</Section>
<?php

get_footer();

