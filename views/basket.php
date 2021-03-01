<?php

namespace views\Basket;

require_once '../config.php'; ?>
<?php

use Exception;
use BookWorms\Model\Image;
use BookWorms\Model\Timber;
use Bookworms\Model\DB;

try {
    $db = new DB();
    $db->open();
    $conn = $db->get_connection();

    $timber_id = $request->input("timber_id");
    $quantity = $request->input("quantity");


    if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
        //if key for timber_id already exists, just increase quantity
        if (array_key_exists($timber_id, $_SESSION['cart'])) {
            $_SESSION['cart'][$timber_id] += $quantity;
            //if not exists, set quantity
        } else {
            //value for index 'timber_id' is quantity
            $_SESSION['cart'][$timber_id] = $quantity;
        }
        //if cart session variable not set, set it
    } else {
        if ($quantity > 0) {
            $_SESSION['cart'] = array($timber_id => $quantity);
        }
    }



    if (isset($_GET['remove']) && is_numeric($_GET['remove']) && isset($_SESSION['cart']) && isset($_SESSION['cart'][$_GET['remove']])) {
        // Remove the product from the shopping cart
        unset($_SESSION['cart'][$_GET['remove']]);
    }


    //ternary operator ? to shorten if/else statement
    //this is the same as saying:

    /*
    if(isset($_SESSION['cart])){
        $products_in_cart = $_SESSION['cart];
    }else{
        $products_in_cart = array();
    }
    */

    $products_in_cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    // initialise $products to empty array, it will then be populated by our foreach
    $products = array();
    $subtotal = 0.00;

    if ($products_in_cart) {
        // repeat the given string '?,' up to the length of the count of the array keys in $products_in_cart - 1
        //if we didn't use -1 at the end and append a final '?', we'd end up with '?, ' at the end, which would break our sql statement
        $question_marks = str_repeat("?, ", count(array_keys($products_in_cart)) - 1) . "?";
        // question marks will be passed to be used in prepared statement, we'll also pass IDs to replace them with
        $products = Timber::findWhereIdIn($question_marks, $products_in_cart);
        //loop through the results of our findWhereIdIn function
        foreach ($products as $product) {
            $subtotal += (float)$product->price * (int)$products_in_cart[$product->id];
        }
    }
} catch (exception $ex) {
    $request->session()->set("flash_message", $ex->getMessage());
    $request->session()->set("flash_message_class", "alert-warning");
    $request->session()->set("flash_data", $request->all());
    $request->session()->set("flash_errors", $request->errors());
    $request->redirect("/index.php");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Your Basket</title>

    <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="container-fluid">
        <?php require 'include/navbar.php'; ?>
        <?php require 'include/flash.php'; ?>
        <div class="container">
            <div class="row justify-content-center">
                <h2 class="text-center mt-5">Your basket</h2>
            </div>
            <br>
            <div class="row flex-column-reverse">
                <table class="table mt-5">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Title</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($products)) { ?>
                            <tr>
                                <td colspan="5" style="text-align:center;">Your basket is empty.</td>
                            </tr>
                        <?php } else { ?>
                            <?php foreach ($products as $product) { ?>
                                <tr>
                                    <td class="img">
                                        <?php
                                        try {
                                            $image = Image::findById($product->image_id);
                                        } catch (Exception $e) {
                                        }
                                        if ($image !== null) {
                                        ?>
                                            <img class="" width="40" src="<?= APP_URL . "/actions/" . $image->filename ?>" class="" alt="Timber image">
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="timber-view.php?id=<?= $product->id ?>"><?= $product->title ?></a>
                                    </td>
                                    <td class="price">&euro;<?= $product->price ?></td>
                                    <td class="quantity">
                                        <input type="number" value="<?= $products_in_cart[$product->id] ?>" min="1" placeholder="Quantity" required>
                                    </td>
                                    <td class="price">&euro;<?= $product->price * $products_in_cart[$product->id] ?></td>
                                    <td>
                                        <a href="basket.php?remove=<?= $product->id ?>" class="remove"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                            <?php }; ?>
                        <?php }; ?>
                    </tbody>
                    <div class="row justify-content-end">
                        <div>
                            <span class="fw-bold">Subtotal</span>
                            <span>&euro;<?= $subtotal ?></span>
                        </div>
                    </div>
                </table>
            </div>

        </div>
        <?php require 'include/footer.php'; ?>
    </div>
    <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>