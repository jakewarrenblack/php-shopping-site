<?php

namespace views\Basket;

require_once '../config.php'; ?>
<?php

use Exception;
use BookWorms\Model\Image;
use BookWorms\Model\Timber;
use BookWorms\Model\Cart;

$cart = Cart::get($request);
$subtotal = 0;


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Your Basket</title>
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style.css">
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
                        <!--if there are no products, just display this message-->
                        <?php if ($cart->empty()) { ?>
                            <tr>
                                <td colspan="5" style="text-align:center;">Your basket is empty.</td>
                            </tr>
                            <!--if there are products, loop through and display them-->
                        <?php } else { ?>
                            <?php foreach ($cart->items as $item) {
                                $total = $item->timber->price * $item->quantity;
                                $subtotal += $total;
                            ?>

                                <tr>
                                    <td class="img">
                                        <?php
                                        try {
                                            $image = Image::findById($item->timber->image_id);
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
                                        <a href="timber-view.php?id=<?= $item->timber->id ?>"><?= $item->timber->title ?></a>
                                    </td>
                                    <td class="price">&euro;<?= $item->timber->price ?></td>
                                    <td class="quantity">
                                        <input type="number" value="<?= $item->quantity ?>" min="1" placeholder="Quantity" required>
                                    </td>
                                    <td class="price">&euro;<?= $item->timber->price * $item->quantity ?></td>

                                    <td>
                                        <form method="post" action="<?= APP_URL . '/actions/cart-remove.php' ?>">
                                            <input type="hidden" name="timber_id" value="<?= $item->timber->id ?>" />
                                            <input type="hidden" name="quantity" value="<?= $item->quantity ?>" />
                                            <button><i class="fas fa-trash"></i></button>
                                        </form>

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