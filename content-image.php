<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> >
    <div class="entry-thumbnail">
        <?php trunghien_thumbnail('large'); ?>
    </div>
    <div class="entry-header">
        <?php 
            trunghien_entry_header();
            $attachment = get_children( array('post_parent' => $post->ID)) ; //dem xem co bao nhieu thanh phan con trong post parent
            $attachment_number = count( $attachment );
            printf(__('This image post contains %1$s photos', 'thachpham'), $attachment_number );
        ?>
    </div>
    <div class="entry-content">
        <?php 
            trunghien_entry_content();
            (is_single() ? trunghien_entry_tag() : "") ;
        ?>
    </div>
</article>