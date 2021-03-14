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
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style.css">
    <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>
</head>

<body class="body shop__body">
<?php require 'include/navbar.php'; ?>
  <?php require 'include/flash.php'; ?>
    <div class="basket__contain">
        <div class="basket__title">
            <h1>Your Basket</h1>
        </div>
        <div class="basket__top">
            <?php if ($cart->empty()) { ?>
                <h2>Your basket is empty.</h2>
            <?php } else { ?>
                <?php foreach ($cart->items as $item){
                    $total = $item->timber->price * $item->quantity;
                    $subtotal += $total;
                ?>
                    <div class="basket__item__contain">
                    <div class="product__contain">
                        <div class="basket__product__img">
                        <?php
                            try {
                                $image = Image::findById($item->timber->image_id);
                            } 
                            catch (Exception $e) {
                            }
                            if ($image !== null) {
                        ?>
                        <img class="" width="40" src="<?= APP_URL . "/actions/" . $image->filename ?>" class="" alt="Timber image">
                        <?php
                            }
                        ?>
                        </div>
                        <div class="product_info">
                            <h1 class="product_title">
                            <a href="timber-view.php?id=<?= $item->timber->id ?>"><?= $item->timber->title ?></a>
                            </h1>
                            <p class="product__profile"><strong>Profile:</strong><?= $item->profiling ?></p>
                            <p class="product__dimensions"><strong>Sq Footage:</strong><?= $item->sqfootage ?></p>
                        </div>
                    </div>
                    <div class="product__info__contain">
                        <div class="product_info">
                            <p class="product__profile"><strong>Price:</strong>&euro;<?= $item->timber->price ?></p>
                            <p class="product__profile"><strong>Quantity:</strong>
                            <input name="quantity" type="number" value="<?= $item->quantity ?>" min="1" placeholder="Quantity" required>
                            <p class="product__subtotal"><strong>Subtotal:</strong>&euro;<?= $item->timber->price * $item->quantity ?></p>
                            <form class="deleteBtn" method="post" action="<?= APP_URL . '/actions/cart-remove.php' ?>">
                                <input type="hidden" name="timber_id" value="<?= $item->timber->id ?>" />
                                <input type="hidden" name="quantity" value="<?= $item->quantity ?>" />
                                <button><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    </div>
                    </div>

                <?php }; ?>
            <?php }; ?>
            <?php if (!$cart->empty()) { ?>
                <div class="basket__button__contain">
                <button class="btn">Update</button>
            </div>
            <?php } ?>

        </div>
        <div class="basket__bottom__contain">
            <div class="basket__bottom">
                <?php if(!$cart->empty()){ ?>
                    <div class="basket__bottom__info">
                        <p class="subtotal"><strong>Subtotal: </strong>&euro;<?= $subtotal ?></p>
                        <p class="shipping"><strong>Shipping: </strong>Enter address to calculate shipping</p>
                        <p class="grand-total"><strong>Grand total: </strong>&euro;<?= $subtotal ?></p>
                    </div>
                    <div class="basket__order__btn__contain">
                        <a href="<?= APP_URL ?>/views/checkout.php"><button class="btn form_btn_active place__order">Checkout</button></a>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
    <?php require 'include/footer.php'; ?>
    <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>