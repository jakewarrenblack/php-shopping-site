<?php require_once '../config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="/charge" method="post" id="payment-form">
              <div class="form-row">
                <label for="card-element">
                  Credit or debit card
                </label>
                <div id="card-element">
                  <!-- A Stripe Element will be inserted here. -->
                </div>

                <!-- Used to display Element errors. -->
                <div id="card-errors" role="alert"></div>
              </div>

              <button>Submit Payment</button>
            </form>
            <script src="https://js.stripe.com/v3/"></script>
            <script src="<?= APP_URL ?>/assets/js/charge.js"></script>
</body>
</html>