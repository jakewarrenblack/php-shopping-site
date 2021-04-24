<?php require_once '../config.php'; ?>
<?php

use BookWorms\Model\Timber;
use BookWorms\Model\Cart;



try {

    //validate the product being sent
    $rules = [
        "timber_id" => "present|integer|min:1",
        "quantity" => "present|integer|min:1"
    ];

    $request->validate($rules);
    if (!$request->is_valid()) {
        throw new Exception("Something went wrong!");
    }

    //We've passed these from the timber view page
    $timber_id = $request->input("timber_id");
    $quantity = $request->input("quantity");
    $profiling = $request->input("profiling");
    $sqfootage = $request->input("sqfootage");
    // will be either 'on' or null
    $fire_rated = $request->input("fire_rated");

    if ($timber_id === null || $quantity === null || $sqfootage === null) {
        throw new Exception("Invalid argument!");
    }

    $timber = Timber::findById($timber_id);

    $cart = Cart::get($request);
    $cart->add($timber, $quantity, $profiling, $sqfootage, $fire_rated);

    $request->redirect("/views/basket.php");
} catch (exception $ex) {
    $request->session()->set("flash_message", $ex->getMessage());
    $request->session()->set("flash_message_class", "alert-warning");
    $request->session()->set("flash_data", $request->all());
    $request->session()->set("flash_errors", $request->errors());
    $request->redirect("/index.php");
}
?>