<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
    <div class="entry-header">
        <?php 
            trunghien_entry_header();
        ?>
    </div>
    <div class="entry-content">
        <?php 
            the_content();
            (is_single() ? trunghien_entry_tag() : "") ;
        ?>
    </div>
</article>