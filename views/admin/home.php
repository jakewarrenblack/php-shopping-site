<?php require_once '../../config.php'; ?>
<?php

use BookWorms\Model\User;

if (!$request->is_logged_in()) {
  $request->redirect("/views/auth/login-form.php");
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

  <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">
</head>

<body>
  <div class="container">
    <?php require 'include/header.php'; ?>
    <?php require 'include/navbar.php'; ?>
    <?php require 'include/flash.php'; ?>
    <main role="main">
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
    </main>
    <?php require 'include/footer.php'; ?>
  </div>
  <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
  <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>