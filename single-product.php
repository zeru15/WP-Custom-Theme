<?php

get_header();
?>
<Section>
    <?php
    if (have_posts()):
        while (have_posts()):
            the_post(); ?>
            <article class="my-post">
                <h2><?php the_title(); ?></h2>
                <p>Published On <?php the_time('F j, Y'); ?> by <?php the_author();
                   the_content(); ?>
                   <button>Add to cart</button>
            </article>
        <?php endwhile;
    endif;
    ?>
</Section>
<?php

get_footer();

