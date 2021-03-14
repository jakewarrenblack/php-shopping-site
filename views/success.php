<?php require_once '../config.php'; ?>
<?php

if(!empty($_GET['tid'] && !empty($_GET['product']))){
    $GET = filter_var_array($_GET, FILTER_SANITIZE_STRING);

    $tid = $_GET['tid'];
    $product = $_GET['product'];
}else{
    $request->redirect("/index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/style.css">
    <script src="https://kit.fontawesome.com/fca6ae4c3f.js" crossorigin="anonymous"></script>
    <title>Success</title>
</head>
<body class="body">
    <div class="container">
        <h2>Thank you for your purchase of:  <?php echo $product; ?></h2>
        <hr>
        <p>Your transaction ID is <?php echo $tid; ?></p>
        <p>Check your email for further information.</p>
        <p><a href="/index.php">Go home</a></p>
    </div>    
</body>
</html>