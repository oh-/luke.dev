<?php

add_action( 'wp_enqueue_scripts', 'twenty_seventeen_parent_theme_enqueue_styles' );

function twenty_seventeen_parent_theme_enqueue_styles() {
    wp_enqueue_style( 'twenty-seventeen-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'lukef-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'twenty-seventeen-style' )
    );

}
