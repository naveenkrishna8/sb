<?php
require_once('recurly-client-php-master/lib/recurly.php');

// Required for the API
Recurly_Client::$subdomain = 'salesboost-local';
Recurly_Client::$apiKey = 'c80020769e1e4cfdb301ce4d2e0a5062';

function process_payment_data() {
	$retrieved_nonce = $_REQUEST['_wpnonce'];
	if (!wp_verify_nonce($retrieved_nonce, 'process_payment_action' ) ) {
		wp_redirect($_POST['_wp_http_referer']);
		exit;
	}
	$plan_id = !empty($_POST['SelectedPlanId'])? $_POST['SelectedPlanId']:"";
	$plan_type = !empty($_POST['Type']) && $_POST['Type'] == 'manager'? FALSE: TRUE;
	$plan_code = getPlanCodeById($plan_id, $plan_type);
	$payment_details = array(
		'first-name'=> $_POST['FirstName'],
		'last-name'=> $_POST['LastName'],
		'unique_value'=> $_POST['Email'],
		'email'=> $_POST['Email'],
		'recurly-token' => $_POST['recurly-token'],
		'plan_code' => $plan_code
		);
	$result = create_account($payment_details);
	$url = $_POST['_wp_http_referer'];
	$new_url = add_query_arg( array(
	    'success' => $result['status'],
	    'message' => $result['message']
	), $url );
	wp_redirect($new_url);
	exit;
}

function create_account($payment_details){
	try {

	  	$subscription = new Recurly_Subscription();
	    $subscription->plan_code = $payment_details['plan_code'];
	    $subscription->currency = 'USD';
	    // Create an account with a uniqid and the customer's first and last name
	    $subscription->account = new Recurly_Account($payment_details['email']);
	    $subscription->account->first_name = $payment_details['first-name'];
	    $subscription->account->last_name = $payment_details['last-name'];
	    $subscription->account->email = $payment_details['email'];

	    // Now we create a bare BillingInfo with a token
	    $subscription->account->billing_info = new Recurly_BillingInfo();
	    $subscription->account->billing_info->token_id = $payment_details['recurly-token'];
	    // Create the subscription
	    $subscription->create();
	    $data = retunData(1,'Success');

	} catch (Recurly_ValidationError $e) {
	  // The data or card are invalid
	  $data = retunData(0,$e->getMessage());
	} catch (Recurly_NotFoundError $e) {
	  // Could not find account
	  $data = retunData(0,$e->getMessage());
	}
	return $data;
}

function retunData($status,$message){
	return array(
    	'status'=> $status,
    	'message'=> $message
	);
}