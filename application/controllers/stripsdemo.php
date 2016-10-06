<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Stripe_payment extends CI_Controller {
 
	public function __construct() {
 
		parent::__construct();
 
		}
 
          public function index()
         {
             $this->load->view(stripe);
          }
 
	public function checkout()
	{
		try {	
			require_once(APPPATH.'libraries/Stripe/lib/Stripe.php');//or you
			Stripe::setApiKey("sk_test_P8MOWskuNC1klwukMH6HmvbI"); //Replace with your Secret Key
 
			$charge = Stripe_Charge::create(array(
				"amount" => 10000,
				"currency" => "usd",
				"card" => $_POST['stripeToken'],
				"description" => "Demo Transaction"
			));
			echo "<h1>Your payment has been completed.</h1>";	
		}
 
		catch(Stripe_CardError $e) {
 
		}
		catch (Stripe_InvalidRequestError $e) {
 
		} catch (Stripe_AuthenticationError $e) {
		} catch (Stripe_ApiConnectionError $e) {
		} catch (Stripe_Error $e) {
		} catch (Exception $e) {
		}
	}
 
}