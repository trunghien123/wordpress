<?php 
/*
    Template Name: Contact
*/
?>
<?php get_header(); ?>
<div class="content">

    <section id="main-content">
        <div class="contact-form">
            <h4>Địa chỉ liên hệ</h4>
            <p>181 Dinh Tien Hoang, Q1, TPHCM</p>
            <p>03213231312</p>
        </div>
        <div class="contact-form">
            <?php echo do_shortcode('[contact-form-7 id="1451" title="Contact form 1"]'); ?>
        </div>
    </section>
    <section id="sidebar">
        <?php get_sidebar(); ?>
    </section>

</div>


<?php get_footer(); ?>