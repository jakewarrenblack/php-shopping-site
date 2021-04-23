<?php
require_once '../config.php';
require_once('vendor/autoload.php');

use BookWorms\Model\Cart;
use BookWorms\Model\Customer;
use BookWorms\Model\Transaction;
use BookWorms\Model\Transaction_Timber;
use BookWorms\Model\User;
use BookWorms\Model\Timber;

$cart = Cart::get($request);

// create StripeClient instance using my API key
$stripe = new \Stripe\StripeClient('***REMOVED***');

// retrieve data from checkout form
$email = $request->input("email");
$fullname = $request->input("fullname");
$phone = $request->input("phone");
$address1 = $request->input("address");
// Stripe formatting needs this .00 appended
$subtotal = intval($request->session()->get("subtotal") . "00");
$token = $request->input("stripeToken");

// we're going to get all the product titles to use as our Stripe charge object's description
// eg a transaction description could be 'Iroko, American Alder, Ash'
$description = [];
foreach ($cart->items as $item) {
    // push timber->title under key to $description array
    array_push($description, $item->timber->title);
}
// implode will join the array by the ", " separator
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
    'description' => $description_result,
    'customer' => $customer->id
]);

$total_quantity = 0;

foreach ($cart->items as $item) {
    $total_quantity += intval($item->quantity);
}


if ($request->is_logged_in()) {
    if (User::findByEmail($email) != null) {
        $user = User::findByEmail($email);
        //just add this transaction_id to the existing customer
        if (Customer::findByUserID($user->id) != null) {
            $customer = Customer::findByUserID($user->id);

            //create new transaction and apply to existing customer
            // the transaction table will provide info on the overall transaction and link to the customer who made the purchase
            $transaction = new Transaction();
            $transaction->id = $charge->id;
            $transaction->customer_id = $customer->id;
            $transaction->status = $charge->status;
            $transaction->date = date("Y-m-d H:i:s");
            $transaction->total = intval($request->session()->get("subtotal"));
            $transaction->save();

            // create transaction_timber record
            // looping through products involved in this transaction
            foreach ($cart->items as $item) {
                // transaction_timber table will store a record for each product involved in our transaction
                $transaction_timber = new Transaction_Timber();
                $transaction_timber->quantity = $item->quantity;
                $transaction_timber->profiling = $item->profiling;
                $transaction_timber->sqfootage = $item->sqfootage;

                // Database needs a 0 or 1, our checkbox passes 'on' or null, so change it to suit:
                $fire_rated = null;
                if ($item->fire_rated === null) {
                    $fire_rated = 0;
                } else {
                    $fire_rated = 1;
                }

                $transaction_timber->fire_rated = $fire_rated;
                $transaction_timber->transaction_id = $charge->id;
                $transaction_timber->timber_id = (Timber::findByTitle($item->timber->title))->id;
                $transaction_timber->save();
            }
        } else {
            // if no customer exists for this user->id, this must be an admin. only customers can make purchases.
            $request->session()->set("flash_message", "Only customers may place orders. You are logged in as an administrator.");
            $request->session()->set("flash_message_class", "alert-warning");
            $request->redirect("/views/checkout.php");
        }
    }
} else {
    // user must not be logged in, so ask them to log in first
    $request->session()->set("flash_message", "Please login to check out.");
    $request->session()->set("flash_message_class", "alert-warning");
    $request->redirect("/views/checkout.php");
}

// Always empty the cart after a transaction is completed
$cart->empty();
unset($_SESSION['cart']);
//Redirect to success page, passing charge_id and description to be retrieved via $_GET
$request->redirect("/views/success.php?tid=" . $charge->id . "&product=" . $charge->description);

?>
<!DOCTYPE html>
<html lang="en">
<!-- Was just using this as my success page before adding the redirect to success.php -->

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