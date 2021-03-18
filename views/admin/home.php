<?php require_once '../../config.php'; ?>
<?php

use BookWorms\Model\User;
use BookWorms\Model\Customer;
use BookWorms\Model\Transaction;
use BookWorms\Model\Timber;
use BookWorms\Model\Image;
use BookWorms\Model\Category;


try {
  $customers = Customer::findAll();
} catch (Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->redirect("/index.html");
}

try {
  $transactions = Transaction::findAll();
} catch (Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->redirect("/index.html");
}

try {
  $timbers = Timber::findAll();
} catch (Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->redirect("/index.html");
}





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
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/flickity.css" media="screen">
  <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>
</head>

<body class="body shop__body">
  <?php require 'include/navbar.php'; ?>
  <?php require 'include/flash.php'; ?>
  <div class="container mb-20">
    <div class="tab-contain">
      <button id="view-customers" class="btn">Customers</button>
      <button id="view-transactions" class="btn">Customers</button>
      <button id="view-timbers" class="btn">Timbers</button>
    </div>
    <hr>
    <table id="customers_table" class="home_table">
      <thead>
        <tr>
          <th>id</th>
          <th>address</th>
          <th>phone</th>
          <th>user_id</th>
          <th>image_id</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($customers as $customer) { ?>
          <tr>
            <td><?= $customer->id ?></td>
            <td><?= $customer->address ?></td>
            <td><?= $customer->phone ?></td>
            <td><?= $customer->user_id ?></td>
            <td>
              <?php
              $customerImage = Image::findById($customer->image_id);
              if ($customerImage !== null) {
              ?>
                <img width="40" src="<?= APP_URL . "/actions/" . $customerImage->filename ?>" alt="Customer image">
              <?php
              }
              ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <table id="transactions_table" class="home_table">
      <thead>
        <tr>
          <th>id</th>
          <th>customer_id</th>
          <th>status</th>
          <th>date</th>
          <th>total</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($transactions as $transaction) { ?>
          <tr>
            <td><?= $transaction->id ?></td>
            <td><?= $transaction->customer_id ?></td>
            <td><?= $transaction->status ?></td>
            <td><?= $transaction->date ?></td>
            <td><?= $transaction->date ?></td>
            <td><?= $transaction->total ?></td>
          </tr>
        <?php } ?>
      </tbody>
    </table>

    <table id="timbers_table" class="home_table">
      <thead>
        <tr>
          <th>id</th>
          <th>title</th>
          <th>description</th>
          <th>price</th>
          <th>category</th>
          <th>minimum_order</th>
          <th>image</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($timbers as $timber) { ?>
          <tr>
            <td><?= $timber->id ?></td>
            <td><?= $timber->title ?></td>
            <td><?= $timber->description ?></td>
            <td><?= $timber->price ?></td>
            <td>
              <?php
              $category = Category::findById($timber->category_id);
              ?>
            </td>
            <td><?= $timber->minimum_order ?></td>
            <td>
              <?php
              $timberImage = Image::findById($timber->image_id);
              if ($timberImage !== null) {
              ?>
                <img width="40" src="<?= APP_URL . "/actions/" . $timberImage->filename ?>" alt="Timber image">
              <?php
              }
              ?>
            </td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
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
  <script src="<?= APP_URL ?>/assets/js/home_tabs.js"></script>
</body>

</html>