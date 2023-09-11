<?php 
function druco_child_register_scripts(){
    $parent_style = 'druco-style';

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css', array('font-awesome-5', 'druco-reset'), druco_get_theme_version() );
    wp_enqueue_style( 'druco-child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style )
    );
}
add_action( 'wp_enqueue_scripts', 'druco_child_register_scripts', 99 );

add_action('wp_footer', function() {
    ?>

    <a href='https://wa.me/543492643820' class="whatsapp-button"><i class="fa-brands fa-whatsapp"></i></a>

    <?php
});