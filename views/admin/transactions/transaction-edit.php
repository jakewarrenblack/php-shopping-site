<?php require_once '../../../config.php'; ?>
<?php

use BookWorms\Model\Transaction;
use BookWorms\Model\Customer;
use BookWorms\Model\User;

try {
  $rules = [
    'transaction_id' => 'present'
  ];
  $request->validate($rules);
  if (!$request->is_valid()) {
    throw new Exception("Illegal request");
  }
  $transaction_id = $request->input('transaction_id');
  $transaction = Transaction::findById($transaction_id);
  if ($transaction === null) {
    throw new Exception("Illegal request parameter");
  }
} catch (Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->session()->set("flash_message_class", "alert-warning");

  $request->redirect("/index.php");
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Edit Transaction</title>
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style.css">
  <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/scale.css" media="screen">
  <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">

</head>

<body>
  <?php require 'include/navbar.php'; ?>
  <div class="container-fluid p-0">

    <?php require 'include/flash.php'; ?>
    <main role="main">
      <div>
        <div class="row d-flex justify-content-center">
          <h1>Edit Transaction</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-8">
            <?php require "include/flash.php"; ?>
          </div>
        </div>

        <div class="row justify-content-center pt-4">
          <div class="col-lg-10">
            <form name='timber-create' action="<?= APP_URL . '/actions/transaction-update.php' ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="transaction_id" value="<?= $transaction->id ?>" />

              <div class="form-group">
                <label for="location">Customer</label>
                <select class="form-control" name="customer_id" id="customer_id">
                  <?php
                  $customers = Customer::findAll();
                  foreach ($customers as $customer) {
                    $user = User::findById($customer->user_id);
                  ?>
                    <option value="<?= $customer->id ?>" <?= chosen("customer", "<?= $customer->id ?>") ? "selected" : "" ?>><?= $user->name ?></option>
                  <?php
                  }
                  ?>
                </select>
                <span class="error"><?= error("customer_id") ?></span>
              </div>

              <div class="form-group">

                <label for="location">Status</label>
                <select class="form-control" name="status" id="status">
                  <option value="succeeded" <?= chosen("status", "succeeded") ? "selected" : "" ?>>succeeded</option>
                  <option value="failed" <?= chosen("status", "failed") ? "selected" : "" ?>>failed</option>
                </select>
                <span class="error"><?= error("status") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="startDate">Date</label>
                <input placeholder="Start Date" type="date" name="date" class="form-control" id="date" value="<?= $transaction->date ?>" />
                <span class="error"><?= error("start_date") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="total">Total</label>
                <input placeholder="Total" type="number" step="0.01" name="total" class="form-control" id="total" value="<?= $transaction->total ?>" />
                <span class="error"><?= error("total") ?></span>
              </div>

              <div class="form-group">
                <a class="btn btn-default" href="<?= APP_URL ?>/index.php">Cancel</a>
                <button type="submit" class="btn btn-primary">Store</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
    <?php require 'include/footer.php'; ?>
  </div>
  <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
  <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>

  <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>

</body>

</html>