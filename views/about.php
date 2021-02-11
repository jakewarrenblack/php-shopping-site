<?php require_once '../config.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Book Worms - About us</title>

    <link href="<?= APP_URL ?>/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?= APP_URL ?>/assets/css/template.css" rel="stylesheet">
  </head>
  <body>
    <div class="container">
      <?php require 'include/header.php'; ?>
      <?php require 'include/navbar.php'; ?>
      <?php require 'include/flash.php'; ?>
      <main role="main">
        <div>
          <h1>About us</h1>
          
          <div class="row">
            <div class="col">
              <p class="lead">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                Vivamus rutrum condimentum porttitor. Cras interdum lectus 
                nisl. Cras ac purus dui. Donec facilisis tortor metus, vel 
                fermentum nunc aliquet et. Cras auctor non metus eget 
                volutpat. Class aptent taciti sociosqu ad litora torquent 
                per conubia nostra, per inceptos himenaeos. Ut ac turpis in 
                sem pulvinar blandit. Maecenas hendrerit ac dui ut pulvinar. 
                Nam a eros sit amet lectus commodo tempus. Sed quis purus 
                metus. Sed metus mi, bibendum ut dui quis, mattis eleifend 
                ipsum. Sed dui turpis, cursus at commodo ac, consectetur et 
                augue. Donec non dolor eros. Aenean consequat facilisis est, 
                ac ornare turpis.
              </p>
              <p>
                Pellentesque risus orci, laoreet vel lorem ac, consequat 
                sagittis nulla. Morbi cursus vel ligula pretium consectetur. 
                Donec ac erat ac augue convallis sollicitudin vitae consequat 
                libero. Nunc porta justo a fermentum aliquet. Praesent 
                placerat velit eget magna euismod porttitor. Sed at dapibus 
                risus, et pellentesque nisl. Sed laoreet lacus dignissim 
                velit aliquet facilisis. Donec leo arcu, posuere ut 
                fermentum eu, fringilla non nisi. Curabitur elementum nisi 
                ac commodo porttitor. In hendrerit lacinia quam ut facilisis. 
                Sed lectus felis, sollicitudin sed leo non, lacinia 
                pellentesque nunc. Suspendisse accumsan vitae orci quis 
                volutpat. In ac nisi ac dui pharetra suscipit.
              </p>
              <p>
                Sed tincidunt augue eleifend, laoreet diam a, convallis 
                nulla. Proin in orci consequat, venenatis enim et, imperdiet 
                urna. Sed a convallis quam, eget interdum sapien. Maecenas 
                eleifend est eget nunc tristique, eget convallis purus 
                congue. Lorem ipsum dolor sit amet, consectetur adipiscing 
                elit. Praesent a elit rhoncus, condimentum ipsum eu, varius 
                erat. Nullam arcu nulla, viverra ac blandit ut, vestibulum 
                quis enim. Vestibulum ante ipsum primis in faucibus orci 
                luctus et ultrices posuere cubilia curae; Quisque a augue 
                vel lorem convallis consequat. Nunc quis tincidunt justo, 
                sit amet consequat sem.
              </p>
            </div>
            <div class="col">
              <img src="<?= APP_URL ?>/assets/img/cart.png" />
            </div>
          </div>
        </div>
      </main>
      <?php require 'include/footer.php'; ?>
    </div>
    <script src="<?= APP_URL ?>/assets/js/jquery-3.5.1.min.js"></script>
    <script src="<?= APP_URL ?>/assets/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
