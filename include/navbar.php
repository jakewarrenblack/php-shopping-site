<?php

use BookWorms\Model\Cart;

$cart = Cart::get($request);

$num_items_in_basket = count($cart->items);

$role = null;

if ($request->session()->has("email")) {
  $role = $request->session()->get("role");
} else {
  $role = null;
}

?>


<nav class="nav" id="nav">
  <div id="logo" class="logo__burger__contain">
    <a class="d-contents" href="<?= APP_URL ?>/index.php"><i class="logo"><img src="<?= APP_URL ?>../assets/img/itc-logo-01.png"></i></a>
    <span class="navbar-toggle" id="js-navbar-toggle">
      <i class="fas fa-bars"></i>
    </span>
  </div>
  <ul class="nav__links" id="js-menu">
    <a id="nav__link" class="nav-link" href="<?= APP_URL ?>/index.php">Home</a>
    <a id="nav__link" class="nav-link" href="<?= APP_URL ?>/views/about.php">About</a>
    <a id="nav__link" class="nav-link" href="<?= APP_URL ?>/views/contact.php">Contact</a>
    <a id="nav__link" class="nav-link" href="<?= APP_URL ?>/views/shop.php">Shop</a>
    <?php if (!$request->session()->has("email")) {
    ?>
      <a class="register" href="<?= APP_URL ?>/views/auth/register-login-form.php">Login/Register</a>
    <?php } else { ?>

      <a id="nav__link" class="nav-link" href="<?= APP_URL ?>/views/<?= $role ?>/home.php">Profile</a>

      <a id="nav__link" class="nav-link" href="<?= APP_URL ?>/actions/logout.php">Logout</a>


      <?php

      // If the logged in user is an admin, show the button to add a new product

      if ($role == "admin") { ?>

        <a id="nav__link" class="nav-link" href="<?= APP_URL ?>/views/admin/timber-create.php">Add Product</a>

      <?php } ?>
    <?php } ?>

    <a id="nav__link" class="nav-link" href="<?= APP_URL ?>/views/basket.php"><i class="fas fa-shopping-basket"></i><span><?= $num_items_in_basket ?></span></a>

  </ul>
</nav>