<?php require_once '../config.php'; ?>
<?php

use BookWorms\Model\Timber;
use BookWorms\Model\Image;
use BookWorms\Model\Category;
use BookWorms\Model\Attribute;
use BookWorms\Model\Timber_Attribute;
use BookWorms\Model\Related_Image;
use BookWorms\Model\Timber_Related_Image;

try {
  $timber_id = $_GET['id'];
  $related_products_final = array();

  $timber = Timber::findById($timber_id);
  if ($timber === null) {
    throw new Exception("Illegal request parameter");
  }

  $timber = Timber::findById($timber_id);
  $related_products = null;

  if (Timber_Attribute::findByTimberId($timber_id, 4) != null) {
    // find the attributes of *this* timber product
    $this_product_attributes = Timber_Attribute::findByTimberId($timber_id);


    foreach($this_product_attributes as $this_product_attribute){
      $related_products = Timber_Attribute::findByAttributeId($this_product_attribute->attribute_id);
    }

    foreach($related_products as $related_product){
      // the current product will be found in here, so loop through and remove it from the array
      // we don't want to display the product the user is currently viewing in the related products
      if($related_product->timber_id === $timber_id){
        $key = array_search($related_product, $related_products); 
        unset($related_products[$key]);
      }
    }

    if(count($related_products)>4){
      $related_products = array_slice($related_products, 0, 4);
    }

    // We want at least 4 to fill the row. So, if this product has less than 4
    // other products with a common attribute, find more related by category.
    if ($related_products != null) {
      if (count($related_products) < 4) {
        // now we make up the difference
        $remainder = (4 - count($related_products));
        $related_products = array_merge($related_products, Timber::findByCategoryId($timber->category_id, $remainder));
      }
      // if we didn't find any timber products related by attribute that aren't the product being currently viewed
    } else {
      $related_products = Timber::findByCategoryIdExcluding($timber->category_id, $timber_id, 4);
    }
  } else {
    $related_products = Timber::findByCategoryIdExcluding($timber->category_id, $timber_id, 4);
  }

  if ($related_products != null) {
    // just make sure we strip out duplicates
    $related_products = array_unique($related_products, SORT_REGULAR);
    foreach($related_products as $related_product){
      $timber_obj = Timber::findById($related_product->timber_id);
      array_push($related_products_final,$timber_obj);
    }
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
              }
              if (count($attribute) > 1) {
                echo implode(", ", $attribute);
              } else {
                // there is only one index, so echo that
                echo $attribute[0];
              }
            } else {
              echo "No attributes set";
            }
            ?>
          </h3>
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
            <a class="btn btn-cart" href="<?= APP_URL ?>/views/shop.php">Cancel</a>
            <input class="btn btn-cart" type="submit" value="Add to Basket"></input>

          </div>

        </form>

      </article>
      <div class="carousel js-flickity" data-flickity='{ "setGallerySize": false }'>
        <?php
        $timber_related_images = null;
        $related_images = array();
        if (Timber_Related_Image::findByTimberId($timber->id) != null) {
          $timber_related_images = Timber_Related_Image::findByTimberId($timber->id);
          foreach ($timber_related_images as $timber_related_image) {
            $id = $timber_related_image->related_image_id;
            $related_images[] = Related_Image::findById($id)->filename;
          }
        }
        if ($related_images != null) {
          foreach ($related_images as $related_image) {
        ?>
            <div class="carousel-cell singleProduct__carousel">
              <img class="carousel-cell-image related" src="<?= APP_URL . "/actions/" . $related_image ?>">
            </div>
          <?php
          }
        } else {
          ?>
          <!-- Show these placeholders if no related images found (shouldn't be the case as you have to upload them) -->
          <div class="carousel-cell singleProduct__carousel"><img class="carousel-cell-image related" src="<?= APP_URL ?>../assets/img/timber6.jpg"></div>
          <div class="carousel-cell singleProduct__carousel"><img class="carousel-cell-image related" src="<?= APP_URL ?>../assets/img/timber7.jpg"></div>
          <div class="carousel-cell singleProduct__carousel"><img class="carousel-cell-image related" src="<?= APP_URL ?>../assets/img/timber-panels.jpg"></div>
          <div class="carousel-cell singleProduct__carousel"><img class="carousel-cell-image related" src="<?= APP_URL ?>../assets/img/timber6.jpg"></div>
          <div class="carousel-cell singleProduct__carousel"><img class="carousel-cell-image related" src="<?= APP_URL ?>../assets/img/timber-panels.jpg"></div>
          <div class="carousel-cell singleProduct__carousel"><img class="carousel-cell-image related" src="<?= APP_URL ?>../assets/img/timber6.jpg"></div>
        <?php
        }

        ?>
      </div>

      <div class="related__info">
        <ul>
          <li>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Soluta numquam voluptates dolorum enim neque cumque fugit reiciendis maxime pariatur optio aut minima, corrupti deserunt architecto adipisci. Non molestiae laborum qui.</li>
        </ul>
      </div>
      <br>
      <h2 class="d-flex justify-content-center related__products__header">You may also like</h2>
      <hr class="w-100 related__products__hr">
      <!------------------------------------------------------------------------------------------------------------------------->
      <div class="related__products">
        <div class="related__products__contain">
          <?php
          if ($related_products_final != null) {
            foreach ($related_products_final as $related_product) {
              /* This should not be the case, but just doing a final check to make sure none of these are the same as the main product */
              if ($related_product->id !== $timber_id) {
          ?>
                <div class="container__inner__shop__product container__inner__shop__related__product related__product">
                  <div class="container__inner__shop__link related__container__link">
                    <?php
                    $timber_image = Image::findById($related_product->image_id);
                    if ($timber_image !== null) {
                    ?>
                      <img src="<?= APP_URL . "/actions/" . $timber_image->filename ?>" alt="Timber image">
                    <?php
                    }
                    ?>
                  </div>
                  <div class="container__product__banner related__banner d-flex align-items-center flex-column p-1em">
                    <h3 class="container__inner__shop__product__title"><?= $related_product->title ?></h3>
                    <h3 class="container__inner__shop__product__title step--0">&euro;<?= $related_product->price ?> per unit</h3>
                    <h3 class="container__inner__shop__product__title step--0">Minimum order: <?= $related_product->minimum_order ?></h3>
                    <a class="related__product__view__button w-50" href="timber-view.php?id=<?php echo $related_product->id; ?>" target="_new" class="w-50 mt-05"><button class="btn w-100">VIEW</button></a>
                  </div>
                </div>
          <?php
              }
            }
          }
          ?>
        </div>
        <!-------------------------------------------------------------------------------------------------------------------------------------->
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