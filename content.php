<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
    <div class="entry-thumbnail">
        <?php trunghien_thumbnail('thumbnail'); ?>
    </div>
    <div class="entry-header">
        <?php 
            trunghien_entry_header();
            trunghien_entry_meta();
        ?>
    </div>
    <div class="entry-content">
        <?php 
            trunghien_entry_content();
            (is_single() ? trunghien_entry_tag() : "") ;
        ?>
    </div>
</article>