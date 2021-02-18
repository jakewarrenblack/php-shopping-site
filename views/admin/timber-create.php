<?php require_once '../../config.php'; ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Create Timber</title>

  <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">

</head>

<body>
  <div class="container-fluid p-0">
    <?php require 'include/header.php'; ?>
    <?php require 'include/navbar.php'; ?>
    <?php require 'include/flash.php'; ?>
    <main role="main">
      <div>
        <div class="row d-flex justify-content-center">
          <h1>Create Timber</h1>
        </div>

        <div class="row justify-content-center">
          <div class="col-lg-8">
            <?php require "include/flash.php"; ?>
          </div>
        </div>

        <div class="row justify-content-center pt-4">
          <div class="col-lg-10">
            <form name='timber-create' action="<?= APP_URL . '/actions/timber-store.php' ?>" method="post" enctype="multipart/form-data">
              <div class="form-group">
                <label for="ticketPrice">Title</label>
                <input placeholder="Title" name="title" type="text" id="title" class="form-control" value="<?= old("title") ?>" />
                <span class="error"><?= error("title") ?></span>
              </div>

              <div class="form-group">
                <label for="date">Description</label>
                <textarea placeholder="Description" name="description" rows="3" id="description" class="form-control" value=""><?= old("description") ?></textarea>
                <span class="error"><?= error("description") ?></span>
              </div>

              <div class="form-group">
                <label for="location">Category</label>
                <select class="form-control" name="category" id="category">
                  <!--Check to see if the data in our form value was this location.-->
                  <option value="Hardwood" <?= chosen("category", "Hardwood") ? "selected" : "" ?>>Hardwood</option>
                  <option value="Softwood" <?= chosen("category", "Softwood") ? "selected" : "" ?>>Softwood</option>
                </select>
                <span class="error"><?= error("category") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="price">Price</label>
                <input placeholder="Price" type="number" name="price" class="form-control" id="price" value="<?= old("price") ?>" />
                <span class="error"><?= error("price") ?></span>
              </div>

              <div class="form-group">
                <label class="labelHidden" for="minimum_order">Minimum Order</label>
                <input placeholder="Minimum Order" type="number" name="minimum_order" class="form-control" id="minimum_order" value="<?= old("minimum_order") ?>" />
                <span class="error"><?= error("minimum_order") ?></span>
              </div>

              <div class="form-group">
                <label for="profile">Image:</label>
                <input type="file" name="profile" id="profile">
                <span class="error"><?= error("profile") ?></span>
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