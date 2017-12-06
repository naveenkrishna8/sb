<?php
require_once('recurly-client-php-master/lib/recurly.php');

// Required for the API
Recurly_Client::$subdomain = 'salesboost-local';
Recurly_Client::$apiKey = 'c80020769e1e4cfdb301ce4d2e0a5062';

/**
* Payment Function
* This is function create a new account if it does not exist and add a new subscription to it
*/
function process_payment_data() {
	$retrieved_nonce = $_REQUEST['_wpnonce'];
	if (!wp_verify_nonce($retrieved_nonce, 'process_payment_action' ) ) {
		wp_redirect($_POST['_wp_http_referer']);
		exit;
	}
	// get plan code by plan id
	$plan_id = !empty($_POST['SelectedPlanId'])? $_POST['SelectedPlanId']:"";
	$plan_type = !empty($_POST['Type']) && $_POST['Type'] == 'managers'? FALSE: TRUE;	
	$plan_code = getPlanCodeById($plan_id, $plan_type);
	
	// set api parameters
	$payment_details = array(
		'first-name'=> $_POST['FirstName'],
		'last-name'=> $_POST['LastName'],
		'unique_value'=> $_POST['Email'],
		'email'=> $_POST['Email'],
		'recurly-token' => $_POST['recurly-token'],
		'plan_code' => $plan_code,
		'account_name' => $_POST['AccountName'],
		'team_size' => empty($_POST['TeamSize'])? 1:$_POST['TeamSize'] 
		);

	$result = create_account($payment_details);

	// redirect url
	$url = $_POST['_wp_http_referer'];

	// set payment status and message
	$_SESSION['payment_status'] = $result['status'];
	$_SESSION['payment_message'] = $result['message'];
	wp_redirect($url);
	exit;
}

/**
* Recurly API Function
* Connect with recurly api and create account and subscription
**/
function create_account($payment_details){
	try {

	  	$subscription = new Recurly_Subscription();
	    $subscription->plan_code = $payment_details['plan_code'];
	    $subscription->currency = 'USD';
	    $subscription->quantity = $payment_details['team_size'];

	    // Create an account with a uniqid and the customer's first and last name
	    $subscription->account = new Recurly_Account($payment_details['email']);
	    $subscription->account->first_name = $payment_details['first-name'];
	    $subscription->account->last_name = $payment_details['last-name'];
	    $subscription->account->email = $payment_details['email'];
	    $subscription->account->username = $payment_details['account_name'];

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
	}catch (Exception $e) {
	  // Could not find account
	  $data = retunData(0,$e->getMessage());
	}
	return $data;
}

/*
* Setup return Data
*/
function retunData($status,$message){
	return array(
    	'status'=> $status,
    	'message'=> $message
	);
}

/**
* Setup success/error message after payment 
*/
function displayMessages(){
	$message = "";
	if(isset($_SESSION['payment_status'])){
		if($_SESSION['payment_status']){
			$message = '<div class="success-mgs">Payment Success.Please check mail for transaction details.</div>';
		}else{
			$msg = isset($_SESSION['payment_message'])? $_SESSION['payment_message']:"";
			$message = '<div class="error-mgs">Payment Failed.' .$msg. '</div>';
		}
	}else{
		echo "No";
	}
	unset($_SESSION['payment_status']);
	unset($_SESSION['payment_message']);
	return $message;
}