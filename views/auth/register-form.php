<?php require_once '../../config.php'; ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Book Worms - Register form</title>

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
      <div class="row d-flex justify-content-center">
        <h1 class="t-peta engie-head pb-5">Register</h1>
      </div>
      <div class="row d-flex justify-content-center">
        <div class="col-lg-10">
          <form name='register' action="<?= APP_URL . '/actions/register.php' ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
              <label class="labelHidden" for="email">Email:</label>
              <input placeholder="Email" class="form-control" type="text" name="email" id="email" value="<?= old("email") ?>" />
              <span class="error"><?= error("email") ?></span>
            </div>

            <div class="form-group">
              <label class="labelHidden" for="password">Password:</label>
              <input placeholder="Password" class="form-control" type="password" name="password" id="password" />
              <span class="error"><?= error("password") ?></span>
            </div>

            <div class="form-group">
              <label class="labelHidden" for="name">Name:</label>
              <input placeholder="Name" class="form-control" type="text" name="name" id="name" value="<?= old("name") ?>" />
              <span class="error"><?= error("name") ?></span>
            </div>
            <div class="form-group">
              <label class="labelHidden" for="address">Address:</label>
              <textarea placeholder="Address" class="form-control" type="text" name="address" id="address" value=""><?= old("address") ?></textarea>
              <span class="error"><?= error("address") ?></span>
            </div>
            <div class="form-group">
              <label class="labelHidden" for="phone">Phone:</label>
              <input placeholder="Phone" class="form-control" type="text" name="phone" id="phone" value="<?= old("phone") ?>" />
              <span class="error"><?= error("phone") ?></span>
            </div>
            <div class="form-group">
              <!--An uploaded file is moved into a temporary directory-->
              <label for="profile">Profile image:</label>
              <input type="file" name="profile" id="profile">
              <span class="error"><?= error("profile") ?></span>
            </div>
            <button type="submit" class="btn myBtn btn-primary" name="submit" value="Submit">Submit</button>
            <a class="btn btn-light" href="<?= APP_URL . "/" ?>">Cancel</a>
          </form>
        </div>
      </div>
    </main>
    <?php require 'include/footer.php'; ?>
  </div>
  <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
  <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php
?>