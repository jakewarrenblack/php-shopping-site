<?php

// if session variable exists for 'cart'
if (isset($_SESSION['cart'])) {
  $num_items_in_cart = (count($_SESSION['cart']) - 1);
} else {
  $num_items_in_cart = 0;
}
?>

<nav class="navbar navbar-expand-md navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#div-navbar-items" aria-controls="div-navbar-items" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="div-navbar-items">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="<?= APP_URL ?>/">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= APP_URL ?>/views/about.php">About us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?= APP_URL ?>/views/contact.php">Contact us</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <?php if (!$request->session()->has("email")) {
      ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= APP_URL ?>/views/auth/login-form.php">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= APP_URL ?>/views/auth/register-form.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= APP_URL ?>/views/basket.php"><i class="fas fa-shopping-cart"></i><span><?= $num_items_in_cart ?></span></a>
        </li>
      <?php } else { ?>
        <li class="nav-item">
          <a class="nav-link" href="<?= APP_URL ?>/actions/logout.php">Logout</a>
        </li>

        <?php

        // If the logged in user is an admin, show the button to add a new product
        $role = $request->session()->get("role");
        if ($role == "admin") { ?>
          <li class="nav-item">
            <a class="nav-link" href="<?= APP_URL ?>/views/admin/timber-create.php">Add Product</a>
          </li>
        <?php } ?>
      <?php } ?>
    </ul>
  </div>
</nav>