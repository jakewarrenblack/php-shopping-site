<?php

namespace views\Basket;

require_once '../config.php'; ?>
<?php

use Exception;
use BookWorms\Model\Image;
use BookWorms\Model\Timber;
use BookWorms\Model\Cart;
use BookWorms\Model\CartItem;

$cart = Cart::get($request);
$subtotal = 0;


?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Your Basket</title>
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style_purged.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/flickity.css" media="screen">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/scale.css" media="screen">
    <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>
</head>

<body class="body shop__body">
    <?php require 'include/navbar.php'; ?>
    <?php require 'include/flash.php'; ?>
    <div class="basket__contain">
        <div class="basket__title">
            <h1>Your Basket</h1>
            <hr>
        </div>

        <div class="table-contain">
            <?php if ($cart->empty()) { ?>
                <h2>Your basket is empty.</h2>
            <?php } else { ?>
                <div class="grid-container">
                    <div class="head">Image</div>
                    <div class="head">Product</div>
                    <div class="head">Price (Per unit)</div>
                    <div class="head">Quantity</div>
                    <div class="head">Subtotal</div>
                    <div class="head">Delete</div>
                    <!--------------------->
                    <?php foreach ($cart->items as $item) {
                        // $total = $item->timber->price * $item->quantity;
                        $total = CartItem::getTotal($item->timber->price, $item->quantity);
                        $subtotal += $total;
                        $request->session()->set('subtotal', $subtotal);
                    ?>
                        <?php
                        try {
                            $image = Image::findById($item->timber->image_id);
                        } catch (Exception $e) {
                        }
                        if ($image !== null) {
                        ?>
                            <div class="cell"><img width="50%" src="<?= APP_URL . "/actions/" . $image->filename ?>" </img></div>
                        <?php
                        }
                        ?>

                        <div class="cell">
                            <a href="timber-view.php?id=<?= $item->timber->id ?>"><?= $item->timber->title ?></a><br>
                            <?= $item->profiling; ?><br>
                            <?= $item->sqfootage; ?> square feet<br>
                            Fire rated:<?php echo ($item->fire_rated === "on") ? "Yes" : 'No'; ?>
                        </div>
                        <div class="cell">&euro;<?= $item->timber->price; ?>4</div>
                        <div class="cell">
                            <form class="d-flex align-items-center" method="post">
                                <input type="hidden" name="timber_id" value="<?= $item->timber->id ?>" />
                                <input type="hidden" name="profiling" value="<?= $item->profiling ?>" />
                                <input type="hidden" name="sqfootage" value="<?= $item->sqfootage ?>" />
                                <input type="hidden" name="fire_rated" value="<?= $item->fire_rated ?>" />
                                <input type="hidden" name="quantity" value="1" />
                                <div class="quantity-contain d-flex d-row align-items-center">
                                    <button class="btn btn-light" type="submit" formaction="<?= APP_URL ?>/actions/cart-remove.php">&lt;</button>
                                    <span class="spanpad"><?= $item->quantity ?></span>
                                    <button class="btn btn-light" type="submit" formaction="<?= APP_URL ?>/actions/cart-add.php">&gt;</button>
                                </div>
                            </form>
                        </div>
                        <div class="cell">&euro;<?= $item->timber->price * $item->quantity ?></div>
                        <div class="cell">
                            <form class="deleteBtn" method="post" action="<?= APP_URL . '/actions/cart-remove.php' ?>">
                                <input type="hidden" name="timber_id" value="<?= $item->timber->id ?>" />
                                <input type="hidden" name="quantity" value="<?= $item->quantity ?>" />
                                <button><i class="fas fa-trash"></i></button>
                            </form>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            <?php
            }
            ?>
            <hr>
        </div>

        <div class="basket__bottom__contain">
            <div class="basket__bottom">
                <?php if (!$cart->empty()) { ?>
                    <div class="basket__bottom__info">
                        <p class="grand-total"><strong>Grand total: </strong>&euro;<?= $request->session()->get("subtotal") ?></p>
                    </div>
                    <div class="basket__order__btn__contain">
                        <form method="post" name="basket_submit" action="<?= APP_URL ?>/views/checkout.php">
                            <button type="submit" class="btn checkout form_btn_active place__order">Checkout</button>
                        </form>
                    </div>
                <?php } ?>

            </div>
        </div>
    </div>
    <?php require 'include/footer.php'; ?>
    <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?= APP_URL ?>/assets/js/script.js"></script>
</body>

</html>