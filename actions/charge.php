<?php
require_once '../config.php';
require_once('vendor/autoload.php');


use Stripe\Stripe\StripeClient;
use Stripe\Stripe\Charge;
use BookWorms\Model\Cart;
use BookWorms\Model\Customer;
$cart = Cart::get($request);

$stripe = new \Stripe\StripeClient('***REMOVED***');

$email = $request->input("email");
$fullname = $request->input("fullname");
$country = $request->input("country");
$address1 = $request->input("address");
$county = $request->input("county");
$zip = $request->input("zip");
$subtotal = intval($request->input("subtotal"));
$token = $request->input("stripeToken");

$description = [];
foreach ($cart->items as $item){
    array_push($description,$item->timber->title);
}
$description_result = implode(", ", $description);

//Create a Stripe customer
$customer = $stripe->customers->create([
    'email' => $email,
    'source' => $token
]);

//Charge the customer
$charge = $stripe->charges->create([
    'amount' => $subtotal,
    'currency' => 'eur',
    'description' =>$description_result,
    'customer' => $customer->id
  ]);

//Instantiate customer




//Redirect to success page
$request->redirect("/views/success.php?tid=".$charge->id."&product=".$charge->description);

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
