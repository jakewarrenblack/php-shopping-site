<?php require_once 'config.php'; ?>
<?php 
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Welcome to Book Worms</title>

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
          <h1>Welcome to Book Worms</h1>
          <p class="lead">
            Nam eget sollicitudin nunc. Quisque volutpat felis mi, in rutrum ligula 
            dictum in. Curabitur augue ex, blandit id pellentesque interdum, aliquet 
            ac tellus. Vivamus sit amet augue posuere, ultricies purus a, pharetra 
            ante. Nullam congue, mauris vel vehicula dictum, velit risus posuere 
            metus, ut luctus sapien nisl in risus. Donec faucibus dictum ornare. 
            Quisque interdum velit dui. Vestibulum sem ex, accumsan non ultricies vel, 
            blandit vitae enim. Pellentesque quis tortor quis nulla hendrerit porta. 
            Proin facilisis ac nibh in hendrerit.
          </p>
          <p>
            Pellentesque orci dui, consectetur non nisi vitae, imperdiet condimentum 
            neque. Cras ullamcorper arcu eget dui consectetur interdum. Cras ac ex ut 
            odio sollicitudin ultrices. Nam dapibus mi dictum tellus dignissim ornare. 
            Quisque scelerisque tellus eu nunc rhoncus aliquet et et quam. Etiam id 
            pretium purus. Aliquam ullamcorper, sapien vitae tempor vulputate, lacus 
            ante sollicitudin leo, nec tempus lacus felis vitae nisi.
          </p>
        </div>
      </main>
      <?php require 'include/footer.php'; ?>
    </div>
    <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
