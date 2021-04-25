<?php require_once '../../config.php'; ?>
<?php
if ($request->is_logged_in()) {
  $role = $request->session()->get("role");
  $request->redirect("/views" . "/" . $role . "/home.php");
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Book Worms - Register form</title>
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style_purged.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/flickity.css" media="screen">
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/scale.css" media="screen">
  <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>

</head>

<body class="body shop__body">

  <?php require 'include/navbar.php'; ?>
  <?php require 'include/flash.php'; ?>

  <div class="form__contain form__alt">
    <div class="btn__contain underline">
      <div id="sign_in" class="btn btn form_btn form_btn_active">Sign In</div>
      <div id="register" class="btn btn form_btn">Register</div>
    </div>
    <div class="container">
      <form id="signin_register_form" name="register" action="<?= APP_URL . '/actions/login.php' ?>" method="post" enctype="multipart/form-data" class="form">

        <div class="form-group">
          <label class="main__label" for="email">Email:</label>
          <input required placeholder="Email" class="form__input" type="text" name="email" id="email" value="<?= old("email") ?>" />
          <span class="error"><?= error("email") ?></span>
        </div>

        <div class="form-group">
          <label class="main__label" for="password">Password:</label>
          <input required placeholder="Password" class="form__input" type="password" name="password" id="password" />
          <span class="error"><?= error("password") ?></span>
        </div>

        <div class="form-group register__element">
          <label class="main__label" for="name">Name:</label>
          <input placeholder="Name" class="form__input" type="text" name="name" id="name" value="<?= old("name") ?>" />
          <span class="error"><?= error("name") ?></span>
        </div>
        <div class="form-group register__element">
          <label class="main__label" for="address">Address:</label>
          <textarea placeholder="Address" class="form__input" type="text" name="address" id="address" value=""><?= old("address") ?></textarea>
          <span class="error"><?= error("address") ?></span>
        </div>
        <div class="form-group register__element">
          <label class="main__label" for="phone">Phone:</label>
          <input placeholder="Format xxx-xxxxx" class="form__input" type="text" name="phone" id="phone" value="<?= old("phone") ?>" />
          <span class="error"><?= error("phone") ?></span>
        </div>
        <div class="form-group register__element">
          <!--An uploaded file is moved into a temporary directory-->
          <label for="profile">Profile image:</label>
          <input type="file" name="profile" id="profile">
          <span class="error"><?= error("profile") ?></span>
        </div>
        <button type="submit" class="btn form__btn myBtn btn-primary" name="submit" value="Submit">Submit</button>
      </form>
    </div>
  </div>
  <?php require 'include/footer.php'; ?>
  <script src="<?= APP_URL ?>/assets/js/script.js"></script>
</body>

</html>
<?php
$request->session()->forget("flash_data");
$request->session()->forget("flash_errors");
?>