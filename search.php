<?php get_header(); ?>
<div class="content">

    <section id="main-content">
        <div class="search-info">
            <?php 
                $search_query = new WP_Query('s='.$s.'&showpost=-1');
                $search_keyword = wp_specialchars( $s, 1);
                $search_count = $search_query->post_count;
                printf(__('<h3>Có %1$s từ khóa được tìm thấy </h3>','trunghien'), $search_count);

            ?>
        </div>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <?php get_template_part('content', get_post_format()) ?>
        <?php
            endwhile ?>
           <?php trunghien_pagination();
        else :
            get_template_part('content', 'none');
        endif;
        ?>
    </section>
    <section id="sidebar">
        <?php get_sidebar(); ?>
    </section>

</div>


<?php get_footer(); ?>