<?php require_once '../../config.php'; ?>
<?php
if (!$request->is_logged_in()) {
  $request->redirect("/views/auth/register-login-form.php");
}
$role = $request->session()->get("role");
if ($role !== "admin") {
  $request->redirect("/actions/logout.php");
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Book Worms - Home</title>
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">
  <link href="<?= APP_URL ?>/assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/scale.css" media="screen">
  <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>
</head>

<body class="body shop__body">
  <?php require 'include/navbar.php'; ?>
  <?php require 'include/flash.php'; ?>
  <div class="container">
    <h1>Admin home</h1>
    <ul class="nav nav-tabs" id="tab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="products-tab" data-toggle="tab" href="#products" role="tab" aria-controls="products" aria-selected="true">
          Products
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="transactions-tab" data-toggle="tab" href="#transactions" role="tab" aria-controls="orders" aria-selected="false">
          Transactions
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="customers-tab" data-toggle="tab" href="#customers" role="tab" aria-controls="customers" aria-selected="false">
          Customers
        </a>
      </li>
    </ul>
    <div class="tab-content" id="tabContent">
      <div class="tab-pane fade show active" id="products" role="tabpanel" aria-labelledby="products-tab">
        <?php require 'views/admin/products/index.php'; ?>
      </div>
      <div class="tab-pane fade" id="transactions" role="tabpanel" aria-labelledby="transactions-tab">
        <?php require 'views/admin/transactions/index.php'; ?>
      </div>
      <div class="tab-pane fade" id="customers" role="tabpanel" aria-labelledby="customers-tab">
        <?php require 'views/admin/customers/index.php'; ?>
      </div>
    </div>
    <hr>


    <div>
      <h1>Admin home</h1>
      <p class="lead">
        Hello, <?= $request->session()->get("name") ?>
      </p>
      <br>
      <h3>Your profile info:</h3>
      <hr>
      <p><strong>Name: </strong><?= $request->session()->get("name") ?></p>
      <p><strong>Email: </strong><?= $request->session()->get("email") ?></p>
    </div>
  </div>
  <?php require 'include/footer.php'; ?>
  <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
  <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>
  <script src="<?= APP_URL ?>/assets/js/products.js"></script>
  <script src="<?= APP_URL ?>/assets/js/customers.js"></script>
  <script src="<?= APP_URL ?>/assets/js/transactions.js"></script>
  <script src="<?= APP_URL ?>/assets/js/script.js"></script>
</body>

</html>