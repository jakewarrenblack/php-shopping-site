<?php require_once '../config.php'; ?>
<?php

use BookWorms\Model\Timber;
use BookWorms\Model\Image;
use BookWorms\Model\Category;
use BookWorms\Model\Attribute;
use BookWorms\Model\Timber_Attribute;

try {
  $timber_id = $_GET['id'];

  $timber = Timber::findById($timber_id);
  if ($timber === null) {
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
  <title>Welcome to Book Worms</title>

  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/flickity.css" media="screen">
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/scale.css" media="screen">
  <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>

</head>

<body class="body">
  <?php require 'include/navbar.php'; ?>
  <?php require 'include/flash.php'; ?>
  <div class="container">
    <div class="container__inner">
      <aside class="img__left">
        <?php
        try {
          $image = Image::findById($timber->image_id);
        } catch (Exception $e) {
        }
        if ($image !== null) {
        ?>
          <img src="<?= APP_URL . "/actions/" . $image->filename ?>" class="" alt="Timber image">
        <?php
        }
        ?>
      </aside>
      <article class="main__body">
        <div class="main__header">
          <h1 class="main__title"><?= $timber->title ?></h1>
          <h2 class="main__subtitle">Minimum Order: <?= $timber->minimum_order ?></h2>
          <h3 class="attribute">
            <?php
            $timber_attributes = Timber_Attribute::findByTimberId($timber->id);

            if ($timber_attributes != null) {
              $attribute = array();
              foreach ($timber_attributes as $timber_attribute) {
                $attribute[] = Attribute::findById($timber_attribute->attribute_id)->name;

                if (count($attribute) > 1) {
                  echo implode(", ", $attribute);
                }
              }
            } else {
              echo "No attributes set";
            }
            ?>
          </h3>
          <br>
        </div>
        <div class="main__copy">
          <p>
            <?= $timber->description ?>
          </p>
        </div>
        <form action="<?= APP_URL . '/actions/cart-add.php' ?>" class="product__view__form" method="post">
          <div class="main__profiling">
            <label class="main__label">Profiling</label>
            <select select class="main__input" name="profiling">
              <option default value="Straight cut">Straight cut</option>
              <option value="Architrave">Architrave</option>
              <option value="Skirting">Skirting</option>
            </select>
          </div>
          <div class="main__footage">
            <label class="main__label">Square Footage</label>
            <input class="main__input" name="sqfootage" type="number" placeholder="Square Footage" required></input>
          </div>
          <div class="main__footage">
            <label class="main__label" for="">Quantity (Minimum Order <?= $timber->minimum_order ?>)
            </label>
            <input placeholder="Quantity" type="number" name="quantity" step="1" class="main__input" id="endDate" value="<?= $timber->minimum_order ?>" />
          </div>
          <div class="main__fireRated">
            <label class="main__fireRated__label">Fire Rated
              <input name="fire_rated" type="checkbox" checked="checked">
              <span class="main__fireRated__label_span"></span>
            </label>
          </div>

          <input type="hidden" name="timber_id" value="<?= $timber_id ?>">

          <div class="buttons__contain">
            <a class="btn btn-cart" href="<?= APP_URL ?>/index.php">Cancel</a>
            <input class="btn btn-cart" type="submit" value="Add to Basket"></input>

          </div>

        </form>

      </article>
      <div class="carousel js-flickity" data-flickity='{ "setGallerySize": false }'>
        <div class="carousel-cell singleProduct__carousel"><img class="carousel-cell-image related" src="<?= APP_URL ?>../assets/img/timber6.jpg"></div>
        <div class="carousel-cell singleProduct__carousel"><img class="carousel-cell-image related" src="<?= APP_URL ?>../assets/img/timber7.jpg"></div>
        <div class="carousel-cell singleProduct__carousel"><img class="carousel-cell-image related" src="<?= APP_URL ?>../assets/img/timber-panels.jpg"></div>
        <div class="carousel-cell singleProduct__carousel"><img class="carousel-cell-image related" src="<?= APP_URL ?>../assets/img/timber6.jpg"></div>
        <div class="carousel-cell singleProduct__carousel"><img class="carousel-cell-image related" src="<?= APP_URL ?>../assets/img/timber-panels.jpg"></div>
        <div class="carousel-cell singleProduct__carousel"><img class="carousel-cell-image related" src="<?= APP_URL ?>../assets/img/timber6.jpg"></div>

      </div>

      <div class="related__info">
        <ul>
          <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta numquam voluptates dolorum enim neque cumque fugit reiciendis maxime pariatur optio aut minima, corrupti deserunt architecto adipisci. Non molestiae laborum qui.</li>
        </ul>
      </div>
    </div>
  </div>
  <?php require 'include/footer.php'; ?>
  <script src="<?= APP_URL ?>/assets/js/flickity.pkgd.min.js"></script>
  <script>
    var flkty = new Flickity('.carousel', {
      // options
      cellAlign: 'left',
      contain: true,
      cellSelector: '.carousel-cell',
      wrapAround: true,
      pageDots: false,
      groupCells: true
    });
  </script>
  <script src="<?= APP_URL ?>/assets/js/script.js"></script>

</body>

</html>