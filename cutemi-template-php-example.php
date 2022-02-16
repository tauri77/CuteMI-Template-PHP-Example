<?php
/**
 * Plugin Name: CuteMI Template PHP Example
 * Version:     0.1
 * Author:      Mauricio Galetto
 * Author URI:  https://geletto.info
 * Text Domain: cute-mediainfo
 * License:     GPL v3
 * Requires at least: 4.5
 * Requires PHP: 5.6
*/

if ( ! defined( 'ABSPATH' ) ) {
	die( 'Invalid request.' );
}

/**
 * Define the new PHP templated profile
 */
function cutemi_template_php_example_get_templated_profiles($profiles) {
	$profiles['example-php'] = [
			'template' => dirname( __FILE__ ) . '/templates/cutemi-example-template.php',
			'label'    => 'Template PHP'
	];

	return $profiles;
}
add_filter( 'cutemi_get_templated_profiles', 'cutemi_template_php_example_get_templated_profiles' );


/**
 * Add styles to cutemi css
 */
function cutemi_template_php_activate(){
	do_action('cutemi_refresh_css');
}
register_activation_hook( __FILE__, 'cutemi_template_php_activate' );

function cutemi_template_php_deactivate(){
	remove_filter( 'cutemi_table_generic_style', 'cutemi_template_php_example_css' );
	do_action('cutemi_refresh_css');
}
register_deactivation_hook( __FILE__, 'cutemi_template_php_deactivate' );

function cutemi_template_php_example_css($css) {
	$css .= '
.vfi-template-php {
    width: 100%;
    margin: 0 auto;
    max-width: 900px;
    background: #ccc;
    color: #000;
}
.vfi-template-php caption {
    background: #f3f3f3;
    color: #000;
    text-align: center;
    padding: 0.6em;
}
.vfi-template-php td {
    text-align: center;
    padding: 0.6em;
}
	';

	return $css;
}
add_filter( 'cutemi_table_generic_style', 'cutemi_template_php_example_css' );
