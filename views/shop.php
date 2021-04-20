<?php require_once '../config.php'; ?>
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

$sort = null;
$order = null;

if (isset($_POST['sort'])) {
  $request->session()->set("flash_data", $request->all());
  $sort = $_POST['sort'];
  // check if default is selected
  if ($sort != "null") {
    $timbers = Timber::findAll($start, $per_page, $sort);
  } else {
    $timbers = Timber::findAll($start, $per_page);
  }
} else {
  $timbers = Timber::findAll($start, $per_page);
}


// select timbers, start at $start, limit to $per_page;


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
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/scale.css">
  <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>

</head>

<body class="body shop__body">
  <?php require 'include/navbar.php'; ?>
  <?php require 'include/header.php'; ?>
  <?php require 'include/flash.php'; ?>

  <div class="container">
    <h1 class="d-flex justify-content-center step-3">Our products</h1>
    <div class="container__inner__shop">
      <div class="container__inner__shop__sorting">
        <div class="page__list">
          <p>Showing Page <?= ($_POST['start'] + 1) ?> of <?= $paginations ?></p>
        </div>
        <div class="sorting__dropdown">
          <label for="sort">Sort By</label>
          <form id="sortingForm" name="sort" action="" method="post">
            <select name="sort" id="sort" onchange='submitForm();'>
              <option value="null" <?= chosen("sort", "null") ? "selected" : "" ?>>Default</option>
              <option value="price ASC" <?= chosen("sort", "price ASC") ? "selected" : "" ?>>Price (Low to high)</option>
              <option value="price DESC" <?= chosen("sort", "price DESC") ? "selected" : "" ?>>Price (High to low)</option>
              <option value="minimum_order ASC" <?= chosen("sort", "minimum_order ASC") ? "selected" : "" ?>>Minimum Order (Low to high)</option>
              <option value="minimum_order DESC" <?= chosen("sort", "minimum_order DESC") ? "selected" : "" ?>>Minimum Order (High to low)</option>
            </select>
          </form>
        </div>
        <script type='text/javascript'>
          function submitForm() {
            document.getElementById('sortingForm').submit();
          }
        </script>
      </div>
      <?php foreach ($timbers as $timber) { ?>
        <div class="container__inner__shop__product">
          <div class="container__inner__shop__link">
            <?php
            $timber_image = Image::findById($timber->image_id);
            if ($timber_image !== null) {
            ?>
              <img src="<?= APP_URL . "/actions/" . $timber_image->filename ?>" alt="Timber image">
            <?php
            }
            ?>
          </div>
          <div class="container__product__banner d-flex align-items-center flex-column p-1em">
            <h3 class="container__inner__shop__product__title"><?= $timber->title ?></h3>
            <h3 class="container__inner__shop__product__title step--0">&euro;<?= $timber->price ?> per unit</h3>
            <h3 class="container__inner__shop__product__title step--0">Minimum order: <?= $timber->minimum_order ?></h3>
            <a href="timber-view.php?id=<?php echo $timber->id; ?>" target="_new" class="w-50 mt-05"><button class="btn w-100">VIEW</button></a>
          </div>
        </div>
      <?php } ?>
      <div class="pagination__contain">
        <ul class="pagination">
          <?php
          for ($j = 1; $j < $paginations; $j++) {
          ?>
            <form method="post" action="shop.php">
              <input type="hidden" name="start" value="<?= $previous ?>" />
              <button><i class=" fas fa-caret-left"></i></button>
            </form>

            <form method="post" action="shop.php">
              <input type="hidden" name="start" value="0" />
              <button>1</button>
            </form>

            <form method="post" action="shop.php">
              <input type="hidden" name="start" value="<?= $j ?>" />
              <button><?= ($j + 1) ?></button>
            </form>
            <?php
            if ($j != $page_counter) {
            ?>
              <form method="post" action="shop.php">
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