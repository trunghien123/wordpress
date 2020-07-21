<?php get_header(); ?>
<div class="content">

    <section id="main-content">
    <?php 
        _e('<h1>404 NOT FOUND</h1>', 'trunghien');
        _e('<p>Không tìm thấy các bài viết đã tìm</p>','trunghien');
        get_search_form();

        _e('<h3>Content categories: </h3>', 'trunghien');
        echo '<div class="404-cat-list">';
            wp_list_categories(array('title_li' => '') );
        echo '</div>';

        _e('Tag Cloud','trunghien');
        wp_tag_cloud();
    ?>
    </section>
    <section id="sidebar">
        <?php get_sidebar(); ?>
    </section>

</div>


<?php get_footer(); ?>