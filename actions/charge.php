<?php
require_once '../config.php';
require_once('vendor/autoload.php');


use Stripe\Stripe\StripeClient;
use Stripe\Stripe\Charge;
use BookWorms\Model\Cart;
use BookWorms\Model\Customer;
use BookWorms\Model\Transaction;
use BookWorms\Model\Transaction_Timber;
use BookWorms\Model\User;
use BookWorms\Model\Timber;
$cart = Cart::get($request);

$stripe = new \Stripe\StripeClient('***REMOVED***');

$email = $request->input("email");
$fullname = $request->input("fullname");
$phone = $request->input("phone");
$address1 = $request->input("address");
$subtotal = intval($request->session()->get("subtotal")."00");
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

$total_quantity = 0;

foreach ($cart->items as $item){
    $total_quantity += intval($item->quantity);
}


if($request->is_logged_in()){
    if(User::findByEmail($email) != null){
        $user = User::findByEmail($email);
        //just add this transaction_id to the existing customer
        if(Customer::findByUserID($user->id) != null){
            $customer = Customer::findByUserID($user->id);

            //create new transaction and apply to existing customer
            $transaction = new Transaction();
            $transaction->id = $charge->id;
            $transaction->customer_id = $customer->id;
            $transaction->status = $charge->status;
            $transaction->date = date("Y-m-d H:i:s");
            $transaction->save();

            //create transaction_timber record
            foreach($cart->items as $item){
                $transaction_timber = new Transaction_Timber();
                $transaction_timber->quantity = $item->quantity;
                $transaction_timber->transaction_id = $charge->id;
                $transaction_timber->timber_id = (Timber::findByTitle($item->timber->title))->id;
                $transaction_timber->save();
            }
        }
    }
}else{
    $request->session()->set("flash_message", "Please login to check out.");
    $request->session()->set("flash_message_class", "alert-warning");
    $request->redirect("/index.php");
}


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
