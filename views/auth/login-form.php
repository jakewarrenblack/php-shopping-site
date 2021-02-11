<?php require_once '../../config.php'; ?>
<?php
if ($request->is_logged_in()) {
  $role = $request->session()->get("role");
  $request->redirect("/views"."/".$role."/home.php");
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Book Worms - Login form</title>

    <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">
    <link href="<?= APP_URL ?>/assets/css/form.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <?php require 'include/header.php'; ?>
      <?php require 'include/navbar.php'; ?>
      <?php require 'include/flash.php'; ?>
      <main role="main">
        <div>
          <h1>Login form</h1>
          <form name='login' action="<?= APP_URL . '/actions/login.php' ?>" method="post">
            <div class="form-field">
              <label for="email">Email:</label>
              <input type="text" name="email" id="email" value="<?= old("email") ?>" />
              <span class="error"><?= error("email") ?></span>
            </div>
            <div class="form-field">
              <label for="password">Password:</label>
              <input type="password" name="password" id="password" />
              <span class="error"><?= error("password") ?></span>
            </div>
            <div class="form-field">
              <label></label>
              <input class="btn btn-primary" type="submit" name="submit" value="Login" />
              <a class="btn btn-light" href="<?= APP_URL . "/" ?>" >Cancel</a>
            </div>
        </form>
        </div>
      </main>
      <?php require 'include/footer.php'; ?>
    </div>
    <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<?php
$request->session()->forget("flash_data");
$request->session()->forget("flash_errors");
?>