<?php

// if session variable exists for 'basket'
if (isset($_SESSION['basket'])) {
  $num_items_in_basket = (count($_SESSION['basket']) - 1);
} else {
  $num_items_in_basket = 0;
}
?>


<nav class="nav" id="nav">
  <div class="logo__burger__contain">
    <i class="logo"><img src="<?= APP_URL ?>../assets/img/itc-logo-01.png"></i>
    <span class="navbar-toggle" id="js-navbar-toggle">
      <i class="fas fa-bars"></i>
    </span>
  </div>
  <ul class="nav__links" id="js-menu">
    <a id="nav__link" class="nav__link" href="<?= APP_URL ?>/">Home<span class="sr-only">(current)</span></a>
    <a id="nav__link" class="nav__link" href="<?= APP_URL ?>/views/about.php">About</a>
    <a id="nav__link" class="nav__link" href="<?= APP_URL ?>/views/contact.php">Contact</a>
    <a id="nav__link" class="nav__link">Shop</a>
    <a id="nav__link" class="nav__link">Sustainability</a>
    <?php if (!$request->session()->has("email")) {
    ?>
      <a class="register" href="<?= APP_URL ?>/views/auth/register-login-form.php">Login/Register</a>
    <?php } else { ?>
      <li class="nav-item">
        <a id="nav__link" class="nav-link" href="<?= APP_URL ?>/actions/logout.php">Logout</a>
      </li>

      <?php

      // If the logged in user is an admin, show the button to add a new product
      $role = $request->session()->get("role");
      if ($role == "admin") { ?>
        <a class="nav-item">
          <a id="nav__link" class="nav-link" href="<?= APP_URL ?>/views/admin/timber-create.php">Add Product</a>
        </a>
      <?php } ?>
    <?php } ?>
    <li class="nav-item">
      <a id="nav__link" class="nav-link" href="<?= APP_URL ?>/views/basket.php"><i class="fas fa-shopping-basket"></i><span><?= $num_items_in_basket ?></span></a>
    </li>
  </ul>
</nav>