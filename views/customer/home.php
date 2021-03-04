<?php require_once '../../config.php'; ?>
<?php

use BookWorms\Model\Image;
use BookWorms\Model\User;
use BookWorms\Model\Customer;

if (!$request->is_logged_in()) {
  $request->redirect("/views/auth/login-form.php");
}
$role = $request->session()->get("role");
if ($role !== "customer") {
  $request->redirect("/actions/logout.php");
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Book Worms - Home</title>

  <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style.css">
</head>

<body>
  <div class="container">
    <?php require 'include/header.php'; ?>
    <?php require 'include/navbar.php'; ?>
    <?php require 'include/flash.php'; ?>
    <main role="main">
      <div>
        <h1>Customer home</h1>
        <p class="lead">
          Hello, <?= $request->session()->get("name") ?>
          <?php
          $email = $request->session()->get("email");
          $user = User::findByEmail($email);
          $user_id = $user->id;
          if ($user->role_id == 4) {
            $customer = Customer::findByUserID($user_id);
          }
          ?>
        </p>
        <br>
        <h3>Your profile info:</h3>
        <hr>
        <?php
        try {
          $image = Image::findById($customer->image_id);
        } catch (Exception $e) {
        }
        if ($image !== null) {
        ?>
          <img src="<?= APP_URL . "/actions/" . $image->filename ?>" width="205px" alt="image" class="mt-2 mb-2" />
        <?php
        }
        ?>
        <p><strong>Address: </strong><?= $customer->address ?></p>
        <p><strong>Phone: </strong><?= $customer->phone ?></p>
        <hr>
      </div>
    </main>
    <?php require 'include/footer.php'; ?>
  </div>
  <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
  <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>