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
  <div class="logo__burger__contain">
    <a class="d-contents" href="<?= APP_URL ?>/index.php"><i class="logo"><img src="<?= APP_URL ?>../assets/img/itc-logo-01.png"></i></a>
    <span class="navbar-toggle" id="js-navbar-toggle">
      <i class="fas fa-bars"></i>
    </span>
  </div>
  <ul class="nav__links" id="js-menu">
    <a id="nav__link" class="nav__link" href="<?= APP_URL ?>/index.php">Home</a>
    <a id="nav__link" class="nav__link" href="<?= APP_URL ?>/views/about.php">About</a>
    <a id="nav__link" class="nav__link" href="<?= APP_URL ?>/views/contact.php">Contact</a>
    <a id="nav__link" class="nav__link" href="<?= APP_URL ?>/views/shop.php">Shop</a>
    <?php if (!$request->session()->has("email")) {
    ?>
      <a class="register" href="<?= APP_URL ?>/views/auth/register-login-form.php">Login/Register</a>
    <?php } else { ?>
      <li class="nav-item">
        <a id="nav__link" class="nav__link" href="<?= APP_URL ?>/views/<?= $role ?>/home.php">Profile</a>
      </li>
      <li class="nav-item">
        <a id="nav__link" class="nav-link" href="<?= APP_URL ?>/actions/logout.php">Logout</a>
      </li>

      <?php

      // If the logged in user is an admin, show the button to add a new product

      if ($role == "admin") { ?>
        <li class="nav-item">
          <a id="nav__link" class="nav-link" href="<?= APP_URL ?>/views/admin/timber-create.php">Add Product</a>
        </li>
      <?php } ?>
    <?php } ?>
    <li class="nav-item">
      <a id="nav__link" class="nav-link" href="<?= APP_URL ?>/views/basket.php"><i class="fas fa-shopping-basket"></i><span><?= $num_items_in_basket ?></span></a>
    </li>
  </ul>
</nav>