<?php require_once '../../../config.php'; ?>
<?php

use BookWorms\Model\Timber;
use BookWorms\Model\Attribute;
use BookWorms\Model\Timber_Attribute;
use BookWorms\Model\Image;
use BookWorms\Model\Timber_Related_Image;
use BookWorms\Model\Related_Image;

try {
  $rules = [
    'timber_id' => 'present|integer|min:1'
  ];
  $request->validate($rules);
  if (!$request->is_valid()) {
    throw new Exception("Illegal request! Please select a record first!");
  }
  $timber_id = $request->input('timber_id');
  $timber = Timber::findById($timber_id);
  if ($timber === null) {
    throw new Exception("Illegal request parameter!");
  }
  $timber_related_images = Timber_Related_Image::findByTimberId($timber_id);
} catch (Exception $ex) {
  $request->session()->set("flash_message", $ex->getMessage());
  $request->session()->set("flash_message_class", "alert-warning");

  $request->redirect("/views/admin/home.php");
}

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Create Timber</title>
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style_purged.css">
  <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/scale.css" media="screen">
</head>

<body class="body">
  <?php require 'include/navbar.php'; ?>
  <div class="container-fluid p-0">

    <?php require 'include/flash.php'; ?>
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
        <div class="form__contain form__alt">
          <div class="container">
            <form class="form" name='timber-create' action="<?= APP_URL . '/actions/timber-update.php' ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="timber_id" value="<?= $timber->id ?>" />

              <div class="form-group">
                <label class="main__label" for="ticketPrice">Title</label>
                <input placeholder="Title" name="title" type="text" id="title" class="form__input" value="<?= $timber->title ?>" />
                <span class="error"><?= error("title") ?></span>
              </div>

              <div class="form-group">
                <label class="main__label" for="date">Description</label>
                <textarea placeholder="Description" name="description" rows="3" id="description" class="form__input" value=""><?= $timber->description ?></textarea>
                <span class="error"><?= error("description") ?></span>
              </div>

              <div class="form-group">
                <label class="main__label" for="location">Category</label>
                <select class="form__input" name="category_id" id="category_id">
                  <option value="1" <?= chosen("category", "1") ? "selected" : "" ?>>Hardwood</option>
                  <option value="2" <?= chosen("category", "2") ? "selected" : "" ?>>Softwood</option>
                </select>
                <span class="error"><?= error("category") ?></span>
              </div>

              <div class="form-group">
                <label class="main__label" class="labelHidden" for="price">Price</label>
                <input placeholder="Price" type="number" step="0.01" name="price" class="form__input" id="price" value="<?= $timber->price ?>" />
                <span class="error"><?= error("price") ?></span>
              </div>

              <div class="form-group">
                <label class="main__label" class="labelHidden" for="minimum_order">Minimum Order</label>
                <input placeholder="Minimum Order" type="number" step="0.01" name="minimum_order" class="form__input" id="minimum_order" value="<?= $timber->minimum_order ?>" />
                <span class="error"><?= error("minimum_order") ?></span>
              </div>

              <div class="form-group">
                <label class="main__label" for="profile">Main Image:</label>
                <?php
                    $image = Image::findById($timber->image_id);
                    if ($image !== null){
                    ?>
                    <img src="<?= APP_URL . "/actions/". $image->filename ?>" height="150px" width="150px" />
                    <?php
                    }
                    ?>
                <input type="file" name="profile" id="profile" value="<?= $image->filename ?>">
                <span class="error"><?= error("profile") ?></span>
              </div>

              <div class="form-group">
                <details>
                  <summary>Attributes (Select up to 2)</summary>
                  <?php
                  $attributes = Attribute::findAll();

                  foreach ($attributes as $attribute) {
                  ?>
                    <input type="checkbox" id="<?= $attribute->id ?>" name="attributes[]" value="<?= $attribute->name ?>">
                    <label for="<?= $attribute->id ?>"><?= $attribute->name ?></label><br>
                  <?php
                  }
                  ?>
                </details>
                <span class="error"><?= error("attributes") ?></span>
              </div>

              <label class="main__label" for="profile">Related images:</label>
              <div class="related_images">
                <div class="form-group">
                    <?php
                      $related_image_1 = Related_Image::findById($timber_related_images[0]->related_image_id);
                      if ($related_image_1 !== null){
                      ?>
                        <img src="<?= APP_URL . "/actions/" . $related_image_1->filename ?>" height="150px" width="150px" />
                      <?php
                      }
                    ?>
                  <input type="file" name="related_image_1" id="related_image_1" value="<?= $related_image_1->filename ?>">
                  <span class="error"><?= error("related_image_1") ?></span>
                </div>

                <div class="form-group">
                    <?php
                      $related_image_2 = Related_Image::findById($timber_related_images[1]->related_image_id);
                      if ($related_image_2 !== null){
                      ?>
                        <img src="<?= APP_URL . "/actions/" . $related_image_2->filename ?>" height="150px" width="150px" />
                      <?php
                      }
                    ?>
                  <input type="file" name="related_image_2" id="related_image_2" value="<?= $related_image_2->filename ?>">
                  <span class="error"><?= error("related_image_2") ?></span>
                </div>

                <div class="form-group">
                    <?php
                      $related_image_3 = Related_Image::findById($timber_related_images[2]->related_image_id);
                      if ($related_image_3 !== null){
                      ?>
                        <img src="<?= APP_URL . "/actions/" . $related_image_3->filename ?>" height="150px" width="150px" />
                      <?php
                      }
                    ?>
                  <input type="file" name="related_image_3" id="related_image_3" value="<?= $related_image_3->filename ?>">
                  <span class="error"><?= error("related_image_3") ?></span>
                </div>

                <div class="form-group">
                    <?php
                      $related_image_4 = Related_Image::findById($timber_related_images[3]->related_image_id);
                      if ($related_image_4 !== null){
                      ?>
                        <img src="<?= APP_URL . "/actions/" . $related_image_4->filename ?>" height="150px" width="150px" />
                      <?php
                      }
                    ?>
                  <input type="file" name="related_image_4" id="related_image_4" value="<?= $related_image_4->filename ?>">
                  <span class="error"><?= error("related_image_4") ?></span>
                </div>
              </div>

              <div class="d-flex form-group">
                <a class="btn mb-1 d-flex justify-content-center align-items-center w-100 btn-default" href="<?= APP_URL ?>/views/admin/home.php">Cancel</a>
                <button type="submit" class="btn w-100 justify-content-center align-items-center btn-primary">Store</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php require 'include/footer.php'; ?>
  </div>
  <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
  <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>

  <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>

</body>

</html>