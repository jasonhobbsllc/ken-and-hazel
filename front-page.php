<?php
/*
 * This page adds the front page for the Ken and Hazel Foundation
 *
 */

add_action( 'genesis_meta', 'gg_home_genesis_meta' );
/**
 * Add widget support for homepage.*
 */
function gg_home_genesis_meta() {

	remove_action( 'genesis_loop', 'genesis_do_loop' );
	add_action( 'genesis_after_header', 'gg_after_header' );
	add_action( 'genesis_loop', 'gg_home_sections' );
	add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );
	add_filter( 'body_class', 'gg_add_home_body_class' );
}

//* Home top section
function gg_after_header() { ?>

	<section class="row-1">
		<div class="wrap">
			<i class="fa <?php the_field('top_icon/logo'); ?>"></i>
			<h2><?php the_field('top_title'); ?></h2>
			<p><?php the_field('top_description'); ?></p>
			<div class="row-1-button"><a href="<?php the_field('top_button_link'); ?>" class="banner-button button"><?php the_field('top_button_text'); ?></a></div>
		</div>
	</section> <?php

}

//* Home middle and bottom sections
function gg_home_sections() { ?>

 	<section class="row-2"> <?php
 			if( get_field('middle_grid_section') ):
 				while( has_sub_field('middle_grid_section') ): ?>
 					<a href="<?php the_sub_field('grid_item_link'); ?>">
 						<div class="grid-item<?php echo gg_grid_item_style(); ?>">
 							<i class="fa <?php the_sub_field('grid_item_icon'); ?> fa-lg"></i>
							<h2 class="grid-item-title"><?php the_sub_field('grid_item_title'); ?></h2>
							<div class="grid-item-text"><?php the_sub_field('grid_item_text'); ?></div>
						</div>
					</a> <?php
				endwhile;
			endif; ?>
	</section>

	<section class="row-3"> <?php
 			if( get_field('bottom_section_bullet_points') ):
 				while( has_sub_field('bottom_section_bullet_points') ): ?>
 						<div class="bullet-point-section">
							<div class="bulleted-point">
	 							<i class="fa <?php the_sub_field('bullet_point_icon'); ?>" style="background: <?php the_sub_field('icon_background_color'); ?>"></i>
							</div>
							<div class="bullet-text">
								<h3 class="bullet-title"><?php the_sub_field('bullet_point_title'); ?></h3>
								<p><?php the_sub_field('bullet_point_text'); ?></p>
							</div>
						</div> <?php
				endwhile;
			endif; ?>
	</section>  <?php

}

//* Add background image to top section
function gg_home_top_background() {

		if ( ! get_field('top_background_image') )
			return;

		$bg_image = get_field('top_background_image');

        // vars
		$url = $bg_image['url'];
		$width = $bg_image['width'];
		$height = $bg_image['height'];

		// calculate bottom padding based on image ratio
		$padding = $height/$width*100;

        $custom_css = "
                .row-1 {
                        background-image: url({$url});
                        background-repeat: no-repeat;
                        background-size: cover;
                        height: 0;
                        padding-bottom: {$padding}%;
                }";
        wp_add_inline_style( 'ken-and-hazel-hobbs', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'gg_home_top_background' );


//* Create inline background style for grid items
function gg_grid_item_style() {

	//Get image from custom field
	$image = get_sub_field('grid_item_background_image');

 	//Get color hex code from custom field
	$color = get_sub_field('grid_item_background_color');

	//If wide item box is ticked add to CSS class
	$class = ( get_sub_field( 'grid_wide_item' ) ) ? ' wide-item' : '';

	if ($image) {
		$style = " background-image: url($image); background-color: $color; background-position: center center; background-repeat: no-repeat; background-size: cover;";
    } else {
	   	$style = " background-color: $color; background-position: center center; background-repeat: no-repeat; background-size: cover;";
    }

	return $class . '" style="' . $style;
}

//* Add body class to home page
function gg_add_home_body_class( $classes ) {

	$classes[] = 'gg-home';
	return $classes;

}

genesis();
