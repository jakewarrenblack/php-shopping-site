<?php require_once 'config.php'; ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Welcome to ITC</title>

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
  <div class="hero__contain landing__hero">
    <div class="hero__img landing__hero__img">
      <div class="text-cont">
        <h1 class="hero__img__title">
          Softwood & Hardwood
        </h1>
        <h3 class="hero__img__subtitle">
          Machined to <span class="underline">your</span> needs
        </h3>
        <a class="testing-animate" href="<?= APP_URL ?>/views/shop.php">SHOP NOW</a>
      </div>
    </div>
  </div>
  <div class="container landing__container">
    <div class="landing__title__contain">
      <h1>Our partners</h1>
    </div>
    <div id="landing__carousel" class="carousel js-flickity landing__carousel" data-flickity='{ "setGallerySize": false }'>
      <div class="carousel-cell landing__carousel__cell"><img id="landing__flickity_img" class="carousel-cell-image related" src="assets/img/partners/1x/Asset 1.png"></div>
      <div class="carousel-cell landing__carousel__cell"><img id="landing__flickity_img" class="carousel-cell-image related" src="assets/img/partners/1x/Asset 3.png"></div>
      <div class="carousel-cell landing__carousel__cell"><img id="landing__flickity_img" class="carousel-cell-image related" src="assets/img/partners/1x/Asset 4.png"></div>
      <div class="carousel-cell landing__carousel__cell"><img id="landing__flickity_img" class="carousel-cell-image related" src="assets/img/partners/1x/Asset 5.png"></div>
      <div class="carousel-cell landing__carousel__cell"><img id="landing__flickity_img" class="carousel-cell-image related" src="assets/img/partners/1x/Asset 6.png"></div>
      <div class="carousel-cell landing__carousel__cell"><img id="landing__flickity_img" class="carousel-cell-image related" src="assets/img/partners/1x/Asset 1.png"></div>
    </div>


    <div class="landing__cards">
      <div class="landing__card">
        <div class="hero__contain landing__image">
          <div class="hero__img landing__card__hero__img landing__card-img1">
            <h1 class="landing__img__title">
              Wide Range of Softwoods
            </h1>
          </div>
          <div class="hero__img landing__hero__img__top landing__card-img2">
            <h1 class="landing__img__title">
              Wide Range of Softwoods
            </h1>
          </div>
        </div>
        <div class="card__r__contain">
          <h2 class="landing__card__title">Unrivaled Quality</h2>
          <p class="landing__card__text">We have a substantial stock of
            American popler, cherry, elm, ash, maple, and walnut.
            As well as a wide range of African and Caribbean species
            including sapele, iroko, framier, and utile.</p>
        </div>

      </div>
      <div class="landing__card hardwoods__card">
        <div class="hero__contain landing__image">
          <div class="hero__img landing__card__hero__img landing__card-img3 hardwoods">
            <h1 class="landing__img__title">
              High Quality Hardwoods
            </h1>
          </div>
          <div class="hero__img landing__hero__img__top landing__card-img4">
            <h1 class="landing__img__title">
              Wide Range of Softwoods
            </h1>
          </div>
        </div>
        <div class="card__r__contain">
          <h2 class="landing__card__title">Sustainability Promised</h2>
          <p class="landing__card__text">We have a substantial stock of
            American popler, cherry, elm, ash, maple, and walnut.
            As well as a wide range of African and Caribbean species
            including sapele, iroko, framier, and utile.</p>
        </div>
      </div>

      <div class="landing__card">
        <div class="hero__contain landing__image">
          <div class="hero__img landing__card__hero__img landing__card-img5 sustainability">
            <h1 class="landing__img__title">
              Our sustainability promise
            </h1>
          </div>
          <div class="hero__img landing__hero__img__top landing__card-img6">
            <h1 class="landing__img__title">
              Wide Range of Softwoods
            </h1>
          </div>
        </div>
        <div class="card__r__contain">
          <h2 class="landing__card__title">Beautiful softwoods</h2>
          <p class="landing__card__text">We have a substantial stock of
            American popler, cherry, elm, ash, maple, and walnut.
            As well as a wide range of African and Caribbean species
            including sapele, iroko, framier, and utile.</p>
        </div>
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