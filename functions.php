<?php

/**
    @ Khai bao hang gia tri
        @ THEME_URL = lay huong dan thu muc theme
        @ CORE = lay duong dan cua thu muc /core
 **/

define('THEME_URL', get_stylesheet_directory());
define('CORE', THEME_URL . "/core");

// Nhung file /core/init.php

require_once(CORE . "/init.php");

// Thiet lap chieu rong noi dung

if (!isset($content_width)) {
    $content_width = 620;
}

// Khai bao chuc nang cua theme

if (!function_exists('trunghien_theme_setup')) {
    function trunghien_theme_setup()
    {
        // thiet lap textdomain
        $language_folder = THEME_URL . '/languages';
        load_theme_textdomain('trunghien', $language_folder);

        // Tu don them link RSS len <head> 
        add_theme_support('automatic-feed-links');

        // Them post thumbnail
        add_theme_support('post-thumbnails');

        // Post Format
        add_theme_support('post-formats', array(
            'image',
            'video',
            'gallery',
            'quote',
            'link'
        ));

        // Them title-tag
        add_theme_support('title-tag');

        // Them custom background
        $default_background = array(
            'default-color' => '#e8e8e8'
        );
        add_theme_support('custom-background', $default_background);

        // Them menu
        register_nav_menu('primary-menu', __('Primary Menu', 'trunghien'));

        // Tao sidebar
        $sidebar = array(
            'name' => __('Main Sidebar', 'trunghien'),
            'id' => 'main-sidebar',
            'description' => __('Default sidebar'),
            'class' => 'main-sidebar',
            'before_title' => '<h3 class=" widgettitle " >',
            'after_title' => '</h3>'
        );
        register_sidebar($sidebar);
    }

    add_action('init', 'trunghien_theme_setup');
}

/**
 @TEMPLATE FUNCTION
 */
if (!function_exists('trunghien_header')) {
    function trunghien_header()
    { ?>
        <div class="site-name">
            <?php
            global $tp_options;
            if( $tp_options['logo-on'] == 0){

                if (is_home()) {
                    printf(
                        '<h1><a href="%1$s" title="%2$s" > %3$s </a></h1>',
                        get_bloginfo('url'),
                        get_bloginfo('description'),
                        get_bloginfo('sitename')
                    );
                } else {
                    printf(
                        '<p><a href="%1$s" title="%2$s" > %3$s </a></p>',
                        get_bloginfo('url'),
                        get_bloginfo('description'),
                        get_bloginfo('sitename')
                    );
                }
            } else {
            ?>
                <img src="<?php echo $tp_options['logo-image']['url']; ?>">
            <?php
            }
            ?>

        </div>
        <div class="site-description"><?php bloginfo('description'); ?></div> <?php

    }
}

// Thiet lap menu
if(!function_exists('trunghien_menu')){
    function trunghien_menu($menu){
        $menu = array(
            'theme_location' => $menu,
            'container' => 'nav',
            'container_class' => $menu,
            'items_wrap' => '<ul id="%1$s" class="%2$s sf-menu">%3$s '
        );
        wp_nav_menu( $menu );
    }
}

// ham tao phan trang
if(!function_exists('trunghien_pagination')){
    function trunghien_pagination(){
        if( $GLOBALS['wp_query']->max_num_pages < 2){
            return '';
        } ?>
        <nav class="pagination" role="navigation">
            <?php if ( get_next_posts_link() ) : ?>
                <div class="prev"><?php next_posts_link( __('Older Posts', 'trunghien') ); ?></div>
            <?php endif; ?>
            <?php if ( get_previous_posts_link() ) : ?>
                <div class="next"><?php previous_posts_link( __('Newer Posts', 'trunghien') ); ?></div>
            <?php endif; ?>
        </nav>
        
        <?php
    }
}

// Ham hien thi thumbnail
if( !function_exists('trunghien_thumbnail') ){
    function trunghien_thumbnail($size){
        if( !is_single( ) && has_post_thumbnail( ) && !post_password_required( ) || has_post_format('image') ) : ?>
        <figure class="post-thumbnail"><?php the_post_thumbnail( $size ); ?></figure>
        <?php
        endif;
    }
}

// Ham hien thi tieu de post
if(!function_exists('trunghien_entry_header')){
    function trunghien_entry_header(){
        if( is_single( )): ?>
            <h1 class="entry-title"><a href="<?php the_permalink( ) ?>" title="<?php the_title(); ?>"> <?php the_title(); ?> </a></h1>
        <?php 
        else :
        ?>
        <h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title() ?>"> <?php the_title(); ?> </a></h2>
        <?php 
        endif;
        ?>
        <?php
    }
}


// Ham lay du lieu post
if(!function_exists('trunghien_entry_meta')){
    function trunghien_entry_meta(){
        if( !is_page()) : ?>
        <div class="entry-meta">
        <?php
            printf(__('<span class="author"> Posted by %1$s', 'trunghien'), get_the_author() );

            printf(__('<span class="date-published"> at %1$s', 'trunghien'), get_the_date() );

            printf(__('<span class="category"> in %1$s ', 'trunghien'), get_the_category_list(',') );

            if(comments_open()) :
                echo '<span class="meta-reply" >';
                comments_popup_link(
                    __('Leave a comment', 'trunghien'),
                    __('One comment', 'trunghien'),
                    __('% comments', 'trunghien'),
                    __('Read all comment', 'trunghien'),
                );
                echo '</span>';
            endif;
        ?>
        </div>  
        <?php
        endif;
    }
}

// Ham hien thi noi dung cua post/page
if(!function_exists('trunghien_entry_content')){
    function trunghien_entry_content(){
        if(!is_single() && !is_page()){
            the_excerpt(); //hien thi rut gon
        }else{
            the_content();
        }

        // phan trang trong single

        $link_pages = array(
            'before' => __('<p>Page: ', 'trunghien'),
            'after' => '</p>',
            'nextpagelink' => __('Next Page', 'trunghien' ),
            'previouspagelink' => __('Previous Page', 'trunghien')
        );
        wp_link_pages($link_pages);
    }
}

// READ MORE
function trunghien_readmore(){
    return '<a class="read-more" href="'. get_permalink( get_the_ID()) . '">'.__('Read More', 'trunghien').'</a>'; 
}
add_filter('excerpt_more', 'trunghien_readmore');

// hien thi tag
if(!function_exists('trunghien_entry_tag')){
    function trunghien_entry_tag(){
        if(has_tag()) :
            echo '<div class="entry_tag">';
            printf(__('Tagged in %1$s', 'trunghien'), get_the_tag_list('', ','));
            echo '</div>';
        endif;
    }
}

// ----------------Nhúng file css--------------------------//
function trunghien_style(){
    wp_register_style('main-style', get_template_directory_uri() ."/style.css", 'all');
    wp_enqueue_style('main-style');
    wp_register_style('reset-style', get_template_directory_uri() ."/reset.css", 'all');
    wp_enqueue_style('reset-style');

    // Superfish-menu
    
    wp_register_style('superfish-style', get_template_directory_uri() ."/superfish.css", 'all');
    wp_enqueue_style('superfish-style');
    wp_register_script('superfish-sript', get_template_directory_uri() ."/superfish.js", array('jquery') );
    wp_enqueue_script('superfish-sript');

    // Custom-menu
    wp_register_script('custom-sript', get_template_directory_uri() ."/custom.js", array('jquery') );
    wp_enqueue_script('custom-sript');
}
add_action('wp_enqueue_scripts', 'trunghien_style');