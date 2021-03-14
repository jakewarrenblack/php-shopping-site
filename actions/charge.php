<?php
require_once '../config.php';
require_once('vendor/autoload.php');

use Stripe\Stripe\StripeClient;
use Stripe\Customer;
use Stripe\Stripe\Charge;

$stripe = new \Stripe\StripeClient('sk_test_51IUfgkLBrNI420twkT9IILtHne9NDCKgXikENZHVRaBfp7nfV7zgNyJKUUh0rB7B8RLAdJqVmpOriEOe5gK6Ggoc000g422Jhc');

$email = $request->input("email");
$firstname = $request->input("firstname");
$surname = $request->input("surname");
$country = $request->input("country");
$address1 = $request->input("address1");
$address2 = $request->input("address2");
$county = $request->input("county");
$zip = $request->input("zip");
$token = $request->input("stripeToken");

//Create a Stripe customer
$customer = $stripe->customers->create([
    'email' => $email,
    'source' => $token
]);

//Charge the customer
$charge = $stripe->charges->create([
    'amount' => 2000,
    'currency' => 'eur',
    'description' => 'Customer bought timber',
    'customer' => $customer->id
  ]);


  //Print human-readable info about our $charge variable
  print_r($charge)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<br>
<h1>Thank you for your purchase</h1>  
</body>
</html>
