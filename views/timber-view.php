<?php require_once '../config.php'; ?>
<?php

use BookWorms\Model\Timber;
use BookWorms\Model\Image;
use BookWorms\Model\Category;

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
  <title>View Customer</title>

  <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">
  <link href="<?= APP_URL ?>/assets/css/style.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">


</head>

<body>
  <div class="container-fluid p-0">
    <?php require 'include/navbar.php'; ?>
    <main role="main">
      <div>
        <div class="row d-flex justify-content-center">
          <h1 class="t-peta engie-head pt-5 pb-5">View Timber</h1>
        </div>

        <div class="row pt-2">
          <div class="col-lg-6">
            <?php
            try {
              $image = Image::findById($timber->image_id);
            } catch (Exception $e) {
            }
            if ($image !== null) {
            ?>
              <img class="w-100" src="<?= APP_URL . "/actions/" . $image->filename ?>" class="" alt="Timber image">
            <?php
            }
            ?>
          </div>
          <div class="col-lg-6">
            <form method="get">
              <div class="form-group">
                <label class="labelHidden" for="ticketPrice">Title</label>
                <input placeholder="Title" type="text" id="title" class="form-control" value="<?= $timber->title ?>" disabled />
              </div>

              <div class="form-group">
                <label class="labelHidden" for="ticketPrice">Category</label>
                <input placeholder="category" type="text" id="category" class="form-control" value="<?php
                                                                                                    try {
                                                                                                      $category = Category::findById($timber->category_id);
                                                                                                    } catch (Exception $e) {
                                                                                                    }
                                                                                                    if ($category !== null) {
                                                                                                      $title = $category->title;
                                                                                                      echo trim($category->title);
                                                                                                    }
                                                                                                    ?>" disabled />
              </div>

              <div class="form-group">
                <label class="labelHidden" for="date">Description</label>
                <textarea name="description" rows="3" id="description" class="form-control" disabled><?= $timber->description ?></textarea>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="venueCapacity">Price</label>
                <input placeholder="" type="number" step="0.01" class="form-control" id="startDate" value="<?= $request->session()->get("id") ?>" disabled />
              </div>
            </form>
            <form action="basket.php" class="form-group" method="post">
              <label class="labelHidden" for="venueCapacity">Quantity (Minimum Order <?= $timber->minimum_order ?>)
              </label>
              <input placeholder="Quantity" type="number" name="quantity" step="1" class="form-control" id="endDate" value="<?= $timber->minimum_order ?>" />
              <input type="hidden" name="timber_id" value="<?= $timber_id ?>">
              <input class="btn btn-primary mt-4" type="submit" value="Add to Basket"></a>
              <a class="btn btn-default mt-4" href="<?= APP_URL ?>/index.php">Cancel</a>
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