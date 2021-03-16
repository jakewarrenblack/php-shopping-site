<?php

namespace views\Checkout;

require_once '../config.php'; ?>

<?php

use Exception;
use BookWorms\Model\Image;
use BookWorms\Model\Timber;
use BookWorms\Model\Cart;

$cart = Cart::get($request);
$subtotal = intval($request->session()->get("subtotal") . "00");

$email = null;
$name = null;
$address = null;
$phone = null;

if ($request->is_logged_in()) {
  $email = $request->session()->get("email");
  $name = $request->session()->get("name");
  $address = $request->session()->get("address");
  $phone = $request->session()->get("phone");
} else {
  $request->session()->set("flash_message", "Please login to check out.");
  $request->session()->set("flash_message_class", "alert-warning");
  $request->redirect("/index.php");
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/flickity.css" media="screen">
  <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>
  <title>Irish Timber Company</title>
</head>

<body class="body shop__body">
  <?php require 'include/navbar.php'; ?>

  <body class="body shop__body">
    <div class="basket__contain checkout__contain">
      <!--flickity product list, used for mobile-->
      <div class="top__bottom__contain">
        <div class="basket__top checkout__mobile">
          <div class="carousel js-flickity" data-flickity='{ "setGallerySize": false }'>
            <?php foreach ($cart->items as $item) {
              $total = $item->timber->price * $item->quantity;
              $subtotal += $total;
            ?>
              <div class="carousel-cell">
                <div class="basket__top">
                  <div class="product__contain">
                    <div class="basket__product__img">
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
                    </div>
                    <div class="product_info">
                      <h1 class="checkout_product_title">
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
              </div>
            <?php }; ?>
          </div>
        </div>

        <!--used on desktop, no flickity-->
        <div class="basket__top checkout__desktop">
          <?php foreach ($cart->items as $item) {
            $total = $item->timber->price * $item->quantity;
            $subtotal += $total;
          ?>
            <div class="basket__item__contain">
              <div class="product__contain">
                <div class="basket__product__img__checkout__desktop">
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
                </div>
                <div class="product_info">
                  <h1 class="checkout_product_title">
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
          <p class="grand-total"><strong>Grand total: </strong>€8400</p>
        </div>
      </div>


      <!--FORM END-->
      <!--another form-->
      <div class="form__contain checkout__form__contain checkout__product__mobile checkout__form__contain">
        <div class="container">
          <form id="payment-form" name="paymentform" action="<?= APP_URL . '/actions/charge.php' ?>" method="post">
            <div class="form-group">
              <label class="main__label" for="email">Email:</label>
              <input placeholder="name@example.com" class="form__input StripeElement StripeElement--empty" type="email" name="email" id="email" value="<?= $email ?>" />
            </div>
            <div class="form-group">
              <label class="main__label" for="email">Full name</label>
              <input placeholder="Full name" class="form__input StripeElement StripeElement--empty" type="text" name="name" id="name" value="<?= $name ?>" />
            </div>
            <div class="form-group">
              <label class="main__label" for="phone">Phone</label>
              <input placeholder="Phone number" class="form__input StripeElement StripeElement--empty" type="text" name="phone" id="phone" value="<?= $phone ?>" />
            </div>
            <div class="form-group">
              <label class="main__label" for="">Street Address:</label>
              <div class="form-group">
                <input placeholder="Address" class="form__input StripeElement StripeElement--empty" type="text" name="address" id="address" value="<?= $address ?>" />
              </div>
            </div>
            <div class="form-row">

              <div id="card-element" class="form-group">
                <!-- A Stripe Element will be inserted here. -->
              </div>

              <!-- Used to display Element errors. -->
              <div id="card-errors" role="alert"></div>
            </div>
            <input name="subtotal" type="hidden" value="<?= intval($subtotal) ?>">

            <button class="checkout" type="submit" value="Submit">Submit Payment</button>
          </form>
        </div>
      </div>
    </div>


    </div>
    <?php require 'include/footer.php'; ?>
    <script src="<?= APP_URL ?>/assets/js/flickity.pkgd.min.js"></script>
    <script>
      var flkty = new Flickity('.carousel', {
        // options
        cellAlign: 'left',
        contain: true,
        cellSelector: '.carousel-cell',
        wrapAround: true,
        pageDots: false,
        groupCells: true
      });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="<?= APP_URL ?>/assets/js/charge.js"></script>
    <script src="<?= APP_URL ?>/assets/js/accountCheckbox.js"></script>

  </body>

</html>