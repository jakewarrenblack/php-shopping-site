<?php require_once '../../../config.php'; ?>
<?php

use BookWorms\Model\Timber;

try {
  $rules = [
    'timber_id' => 'present|integer|min:1'
  ];
  $request->validate($rules);
  if (!$request->is_valid()) {
    throw new Exception("Illegal request");
  }
  $timber_id = $request->input('timber_id');
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
  <title>Create Timber</title>
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style.css">
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/scale.css" media="screen">
  <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">

</head>

<body>
  <?php require 'include/navbar.php'; ?>
  <div class="container-fluid p-0">

    <?php require 'include/flash.php'; ?>
    <main role="main">
      <div>
        <div class="row d-flex justify-content-center">
          <h1>Edit Timber</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-8">
            <?php require "include/flash.php"; ?>
          </div>
        </div>

        <div class="row justify-content-center pt-4">
          <div class="col-lg-10">
            <form name='timber-create' action="<?= APP_URL . '/actions/timber-update.php' ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="timber_id" value="<?= $timber->id ?>" />

              <div class="form-group">
                <label for="ticketPrice">Title</label>
                <input placeholder="Title" name="title" type="text" id="title" class="form-control" value="<?= $timber->title ?>" />
                <span class="error"><?= error("title") ?></span>
              </div>

              <div class="form-group">
                <label for="date">Description</label>
                <textarea placeholder="Description" name="description" rows="3" id="description" class="form-control" value=""><?= $timber->description ?></textarea>
                <span class="error"><?= error("description") ?></span>
              </div>

              <div class="form-group">
                <label for="location">Category</label>
                <select class="form-control" name="category_id" id="category_id">
                  <option value="1" <?= chosen("category", "1") ? "selected" : "" ?>>Hardwood</option>
                  <option value="2" <?= chosen("category", "2") ? "selected" : "" ?>>Softwood</option>
                </select>
                <span class="error"><?= error("category") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="price">Price</label>
                <input placeholder="Price" type="number" step="0.01" name="price" class="form-control" id="price" value="<?= $timber->price ?>" />
                <span class="error"><?= error("price") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="minimum_order">Minimum Order</label>
                <input placeholder="Minimum Order" type="number" step="0.01" name="minimum_order" class="form-control" id="minimum_order" value="<?= $timber->minimum_order ?>" />
                <span class="error"><?= error("minimum_order") ?></span>
              </div>

              <div class="form-group">
                <label for="profile">Image:</label>
                <input type="file" name="profile" id="profile">
                <span class="error"><?= error("profile") ?></span>
              </div>

              <label for="profile">Related images:</label>
              <div class="related_images d-flex">
                <div class="form-group">
                  <input type="file" name="related_image_1" id="related_image_1">
                  <span class="error"><?= error("related_image_1") ?></span>
                </div>

                <div class="form-group">
                  <input type="file" name="related_image_2" id="related_image_2">
                  <span class="error"><?= error("related_image_2") ?></span>
                </div>

                <div class="form-group">
                  <input type="file" name="related_image_3" id="related_image_3">
                  <span class="error"><?= error("related_image_3") ?></span>
                </div>
              </div>

              <div class="form-group">
                <a class="btn btn-default" href="<?= APP_URL ?>/index.php">Cancel</a>
                <button type="submit" class="btn btn-primary">Store</button>
              </div>
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