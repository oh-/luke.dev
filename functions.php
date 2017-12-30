<?php

add_action( 'wp_enqueue_scripts', 'twenty_seventeen_parent_theme_enqueue_styles' );

function twenty_seventeen_parent_theme_enqueue_styles() {
    wp_enqueue_style( 'twenty-seventeen-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'lukef-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( 'twenty-seventeen-style' )
    );

}
add_action('customize_register','my_customize_register');
function my_customize_register( $wp_customize ) {
 
  $wp_customize->add_section(
    'header_section_car', array(
      'title'     => __('front page Carousel', 'lukef'),
      'priority'  => 30,
  ) );
  $slides = lf_get_carousel_choices();
  $wp_customize->add_setting(
    'header_carousel', array(
    'default' => slides[0],
  ) );
	$wp_customize->add_control( 'lf_car_picker', array(
		'label'     => __( 'Front page carousel', 'lukef' ),
		'section'   => 'theme_options',
		'settings'  => 'header_carousel',
    'type'      => 'select',
    'choices'   => lf_get_carousel_choices(),
	) );
}

function lf_get_carousel_choices($args = 64) {
		$posts = get_posts( array(
				'post_type' => 'ml-slider',
				'post_status' => 'publish',
				'orderby' => 'date',
				'order' => 'ASC',
				'posts_per_page' => -1
			) );

		foreach ( $posts as $post ) {
			$active = $selected_slider == $post->ID ? true : false;

			$sliders[] = array(
				'active' => $active,
				'title' => $post->post_title,
				'id' => $post->ID
			);
		}
    // TODO: Convert the following to an array that can be used in the choices array listed in lf_car_picker
    $rval = array();
		foreach ( $sliders as $slider ) {
      $sid = $slider['id'];
      $sttl = $slider['ttl'];
			$rval[$sid] = $sttl;
		}

  $slider_test = array(
    'left'  => 'left',
    'right' => 'right');
  return $rval;
};

