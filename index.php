<?php require_once 'config.php'; ?>
<?php

use BookWorms\Model\Image;
use BookWorms\Model\Timber;

$per_page = 6;
$page_counter = 0;
$timber_count = count(Timber::findAll());

if (!isset($_POST['start'])) {
  $_POST['start'] = 0;
}

$start = $_POST['start'];

//if previous page not already received from form, set it to page_counter
$previous = isset($_POST['previous']) ? $_POST['previous'] : $page_counter;
//if next page not already received from form, set to start + 1
$next = isset($_POST['next']) ? $_POST['next'] : $start + 1;

$page_counter =  $start;
$start = $start *  $per_page;

// select timbers, start at $start, limit to $per_page;
$timbers = Timber::findAll($start, $per_page);

// we calculate our page number by dividing the total number of timbers by the number we want on the page
// ceil rounds up fractions, we only want whole numbers
$paginations = ceil($timber_count / $per_page);
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
  <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>

</head>

<body class="body shop__body">
  <?php require 'include/navbar.php'; ?>
  <?php require 'include/header.php'; ?>
  <?php require 'include/flash.php'; ?>

  <div class="container">
    <div class="container__categories">
      <h2 class="container__categories__title">Our Products</h2>
      <br>
      <div class="container__categories__row">
        <div class="container__categories__row__category">
          <h3>European</h3>
        </div>
        <div class="container__categories__row__category">
          <h3>African</h3>
        </div>
        <div class="container__categories__row__category">
          <h3>Carribbean</h3>
        </div>
        <div class="container__categories__row__category">
          <h3>American</h3>
        </div>
      </div>
    </div>
    <div class="container__inner__shop">
      <div class="container__inner__shop__sorting">
        <div class="page__list">
          <p>Showing Page <?= ($_POST['start'] + 1) ?> of <?= $paginations ?></p>
        </div>
        <div class="sorting__dropdown">
          <label for="sort">Sort By</label>
          <select name="sort" id="sort">
            <option value="Default">Default</option>
            <option value="Price">Price</option>
            <option value="Popularity">Popularity</option>
          </select>
        </div>
      </div>
      <?php foreach ($timbers as $timber) { ?>
        <div class="container__inner__shop__product">
          <a class="container__inner__shop__link" href="views/timber-view.php?id=<?php echo $timber->id; ?>" target="_new">
            <?php
            $timber_image = Image::findById($timber->image_id);
            if ($timber_image !== null) {
            ?>
              <img src="<?= APP_URL . "/actions/" . $timber_image->filename ?>" alt="Timber image">
            <?php
            }
            ?>
            <h3 class="container__inner__shop__product__title"><?= $timber->title ?></h3>
          </a>
        </div>
      <?php } ?>
      <div class="pagination__contain">
        <ul class="pagination">
          <?php
          for ($j = 1; $j < $paginations; $j++) {
          ?>
            <form method="post" action="index.php">
              <input type="hidden" name="start" value="<?= $previous ?>" />
              <button><i class=" fas fa-caret-left"></i></button>
            </form>

            <form method="post" action="index.php">
              <input type="hidden" name="start" value="0" />
              <button>1</button>
            </form>

            <form method="post" action="index.php">
              <input type="hidden" name="start" value="<?= $j ?>" />
              <button><?= ($j + 1) ?></button>
            </form>
            <?php
            if ($j != $page_counter) {
            ?>
              <form method="post" action="index.php">
                <input type="hidden" name="start" value="<?= $next ?>" />
                <button><i class=" fas fa-caret-right"></i></button>
              </form>
          <?php
            }
          }
          ?>
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