<?php

/**

 * @author Divi Space

 * @copyright 2017

 */

if (!defined('ABSPATH')) die();

$stylesheet_directory =  get_stylesheet_directory();

// Subscription api details
define('SUBSCRIPTION_API_URL','http://35.164.133.47:81/Home/GetGeneralPlanSettings?isIndividual=');
define('BILLING_YEARLY','year');
define('BILLING_MONTHLY','month');

// recurly sub domain
define('RECURLY_SUBDOMAIN','salesboost-local');
// recurly api key
define('RECURLY_API_KEY','c80020769e1e4cfdb301ce4d2e0a5062');

define('RECURLY_PUBLIC_KEY','ewr1-Av43hbhS0Jky7BGksuoFSk');

define('RECURLY_OPENSSL_PATH','D:\xampp\php\cacert.pem');



function ds_ct_enqueue_parent() { wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' ); }

function child_stylesheets(){
	wp_enqueue_style( 'hubspot-style', get_stylesheet_directory_uri() . '/salesboost-hubspot.css' );
}



function ds_ct_loadjs() {
	wp_register_script( 'recurly', 'https://js.recurly.com/v4/recurly.js');
	wp_enqueue_script( 'ds-theme-script', get_stylesheet_directory_uri() . '/ds-script.js',

        array( 'jquery' )

	);
	if ( is_page_template('pricing.php') || is_page_template('pricing-managers.php') ) {
        wp_enqueue_script('pricing-script', get_stylesheet_directory_uri() . '/pricing.js',array('recurly'),'1.1',True);
    } 

}

add_action( 'wp_enqueue_scripts', 'ds_ct_enqueue_parent' );

add_action( 'wp_enqueue_scripts', 'child_stylesheets' );

add_action( 'wp_enqueue_scripts', 'ds_ct_loadjs' );

add_action( 'admin_post_nopriv_process_payment', 'process_payment_data' );

add_action( 'admin_post_process_payment', 'process_payment_data' );

function register_my_session()
{
  if( !session_id() )
  {
    session_start();
  }
}

add_action('init', 'register_my_session');

function wordpress_dd($data){
	print "<pre>";
	print_r($data);
	print "</pre>";
	exit;
}

require_once( $stylesheet_directory . '/includes/subscriptions.api.php' );

require_once( $stylesheet_directory . '/includes/payment.php' );