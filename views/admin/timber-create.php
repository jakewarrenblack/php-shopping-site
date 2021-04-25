<?php require_once '../../config.php'; ?>
<?php

use BookWorms\Model\Attribute;
use BookWorms\Model\Timber_Attribute;

?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Create Timber</title>
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style_purged.css">
  <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">
  <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/scale.css" media="screen">

</head>

<body class="body">
  <?php require 'include/navbar.php'; ?>

  <?php require 'include/flash.php'; ?>
  <div class=" row d-flex justify-content-center">
    <h1>Create Timber</h1>
  </div>

  <div class="row justify-content-center">
    <div class="col-lg-8">
      <?php require "include/flash.php"; ?>
    </div>
  </div>


  <div class="form__contain">
    <div class="container">
      <form class="form" name='timber-create' action="<?= APP_URL . '/actions/timber-store.php' ?>" method="post" enctype="multipart/form-data">
        <div class="form-group">
          <label for="ticketPrice">Title</label>
          <input required placeholder="Title" name="title" type="text" id="title" class="form-control" value="<?= old("title") ?>" />
          <span class="error"><?= error("title") ?></span>
        </div>

        <div class="form-group">
          <label for="date">Description</label>
          <textarea required placeholder="Description" name="description" rows="3" id="description" class="form-control" value=""><?= old("description") ?></textarea>
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
          <input required placeholder="Price" type="number" step="0.01" name="price" class="form-control" id="price" value="<?= old("price") ?>" />
          <span class="error"><?= error("price") ?></span>
        </div>

        <div class="form-group">
          <label class="labelHidden" for="minimum_order">Minimum Order</label>
          <input required placeholder="Minimum Order" type="number" step="0.01" name="minimum_order" class="form-control" id="minimum_order" value="<?= old("minimum_order") ?>" />
          <span class="error"><?= error("minimum_order") ?></span>
        </div>

        <div class="form-group">
          <label for="profile">Image:</label>
          <input required type="file" name="profile" id="profile">
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

        <!-- Related images-->

        <label for="profile">Related images:</label>
        <div class="related_images">
          <div class="form-group">
            <input required type="file" name="related_image_1" id="related_image_1">
            <span class="error"><?= error("related_image_1") ?></span>
          </div>

          <div class="form-group">
            <input required type="file" name="related_image_2" id="related_image_2">
            <span class="error"><?= error("related_image_2") ?></span>
          </div>

          <div class="form-group">
            <input required type="file" name="related_image_3" id="related_image_3">
            <span class="error"><?= error("related_image_3") ?></span>
          </div>

          <div class="form-group">
            <input required type="file" name="related_image_4" id="related_image_4">
            <span class="error"><?= error("related_image_4") ?></span>
          </div>
        </div>

        <div class="form-group">
          <a class="btn w-100 btn-default" href="<?= APP_URL ?>/index.php">Cancel</a>
          <button type="submit" class="btn w-100 btn-primary">Store</button>
        </div>
      </form>
    </div>

  </div>
  <?php require 'include/footer.php'; ?>
  <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
  <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>

  <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>

</body>

</html>