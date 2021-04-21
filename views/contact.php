<?php require_once '../config.php'; ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Book Worms - Contact us</title>
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style_purged.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/flickity.css" media="screen">
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/scale.css" media="screen">
  <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>
</head>

<body class="body">
  <?php require 'include/navbar.php'; ?>
  <?php require 'include/flash.php'; ?>

  <br>
  <div class="text__contain">
    <h1>Want to get in touch?</h1>
    <h4>Our team aims to respond to all queries within one working day.</h4>
  </div>


  <div class="form__contain form__alt">
    <div class="container">
      <form id="signin_register_form" name="register" action="<?= APP_URL . '/actions/email/email.php' ?>" method="post" method="post" enctype="multipart/form-data" class="form">

        <div class="form-group">
          <label class="main__label" for="email">Email:</label>
          <input placeholder="Email" class="form__input" type="text" name="email" id="email" value="<?= old("email") ?>" />
          <span class="error"><?= error("email") ?></span>
        </div>

        <div class="form-group">
          <label class="main__label" for="subject">Subject:</label>
          <input class="form__input" type="subject" name="subject" id="subject" />
          <span class="error"><?= error("subject") ?></span>
        </div>

        <div class="form-group">
          <label class="main__label" for="name">Name:</label>
          <input placeholder="Name" class="form__input" type="text" name="name" id="name" value="<?= old("name") ?>" />
          <span class="error"><?= error("name") ?></span>
        </div>



        <div class="form-group">
          <label class="main__label" for="message">Message:</label>
          <textarea name="message" id="message" rows="5"><?= old("message") ?></textarea>
          <span class="error"><?= error("message") ?></span>
        </div>


        <div class="form-group">
          <!--An uploaded file is moved into a temporary directory-->
          <label for="attachment">Attachment:</label>
          <input type="file" name="attachment" id="attachment">
          <span class="error"><?= error("attachment") ?></span>
        </div>
        <button type="submit" class="btn form__btn myBtn btn-primary" name="submit" value="Send">Submit</button>
      </form>
    </div>
  </div>




  <?php require 'include/footer.php'; ?>
  <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
  <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>
  <script src="<?= APP_URL ?>/assets/js/script.js"></script>
</body>

</html>