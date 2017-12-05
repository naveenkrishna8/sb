<?php

/**

 * @author Divi Space

 * @copyright 2017

 */

if (!defined('ABSPATH')) die();

define('SUBSCRIPTION_API_URL','http://35.164.133.47:81/Home/GetGeneralPlanSettings?isIndividual=');
define('BILLING_YEARLY','year');
define('BILLING_MONTHLY','month');

function ds_ct_enqueue_parent() { wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); }



function ds_ct_loadjs() {

	wp_enqueue_script( 'ds-theme-script', get_stylesheet_directory_uri() . '/ds-script.js',

        array( 'jquery' )

    );

}



add_action( 'wp_enqueue_scripts', 'ds_ct_enqueue_parent' );

add_action( 'wp_enqueue_scripts', 'ds_ct_loadjs' );

function wordpress_dd($data){
	print "<pre>";
	print_r($data);
	print "</pre>";
	exit;
}
$stylesheet_directory =  get_stylesheet_directory();
require_once( $stylesheet_directory . '/includes/subscriptions.api.php' );

function arphabet_widgets_init() {

	register_sidebar( array(
		'name'          => 'Home right sidebar',
		'id'            => 'home_right_1',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'arphabet_widgets_init' );