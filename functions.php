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

function child_stylesheets(){
	wp_enqueue_style( 'hubspot-style', get_stylesheet_directory_uri() . '/salesboost-hubspot.css' );
}



function ds_ct_loadjs() {
	wp_register_script( 'recurly', 'https://js.recurly.com/v4/recurly.js');
	wp_enqueue_script( 'ds-theme-script', get_stylesheet_directory_uri() . '/ds-script.js',

        array( 'jquery' )

	);
	if ( is_page_template('pricing.php') ) {
        wp_enqueue_script('pricing-script', get_stylesheet_directory_uri() . '/pricing.js',array('recurly'),'1.1',True);
    } 

}

add_action( 'wp_enqueue_scripts', 'ds_ct_enqueue_parent' );

add_action( 'wp_enqueue_scripts', 'child_stylesheets' );

add_action( 'wp_enqueue_scripts', 'ds_ct_loadjs' );

function wordpress_dd($data){
	print "<pre>";
	print_r($data);
	print "</pre>";
	exit;
}
$stylesheet_directory =  get_stylesheet_directory();
require_once( $stylesheet_directory . '/includes/subscriptions.api.php' );