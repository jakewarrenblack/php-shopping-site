<?php require_once '../../../config.php'; ?>
<?php

use BookWorms\Model\Customer;
use BookWorms\Model\User;
use BookWorms\Model\Image;

try {
    $rules = [
        'customer_id' => 'present|integer|min:1'
    ];
    $request->validate($rules);
    if (!$request->is_valid()) {
        throw new Exception("Illegal request! Please select a record first!");
    }
    $customer_id = $request->input('customer_id');
    $customer = Customer::findById($customer_id);
    if ($customer === null) {
        throw new Exception("Illegal request parameter!");
    }

    $user = User::findById($customer->user_id);
    if ($user === null) {
        throw new Exception("Illegal request parameter!!");
    }
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
    <title>Edit Customer</title>
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
                <h1>Edit Customer</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <?php require "include/flash.php"; ?>
                </div>
            </div>
            <div class="row justify-content-center pt-4">
                <div class="form__contain form__alt">
                    <div class="container">
                        <form class="form" name='timber-create' action="<?= APP_URL . '/actions/customer-update.php' ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="customer_id" value="<?= $customer->id ?>" />
                            <div class="form-group">
                                <label class="main__label" for="email">Email:</label>
                                <input placeholder="Email" class="form__input" type="text" name="email" id="email" value="<?= $user->email ?>" />
                                <span class="error"><?= error("email") ?></span>
                            </div>
                            <div class="form-group">
                                <label class="main__label" for="name">Name:</label>
                                <input placeholder="Name" class="form__input" type="text" name="name" id="name" value="<?= $user->name ?>" />
                                <span class="error"><?= error("name") ?></span>
                            </div>
                            <div class="form-group">
                                <label class="main__label" for="address">Address:</label>
                                <textarea placeholder="Address" class="form__input" type="text" name="address" id="address" value=""><?= $customer->address ?></textarea>
                                <span class="error"><?= error("address") ?></span>
                            </div>
                            <div class="form-group">
                                <label class="main__label" for="phone">Phone:</label>
                                <input placeholder="Phone" class="form__input" type="text" name="phone" id="phone" value="<?= $customer->phone ?>" />
                                <span class="error"><?= error("phone") ?></span>
                            </div>
                            <div class="form-group">
                                <!--An uploaded file is moved into a temporary directory-->
                                <label for="profile">Profile image:</label>
                                <?php
                                    $image = Image::findById($customer->image_id);
                                    if ($image !== null){
                                    ?>
                                    <img src="<?= APP_URL . "/actions/". $image->filename ?>" height="150px" width="150px" />
                                    <?php
                                    }
                                ?>
                                <input type="file" name="profile" id="profile" value="<?= $image->filename ?>">
                                <span class="error"><?= error("profile") ?></span>
                            </div>
                            <div class="d-flex form-group">
                                <a class="btn mb-1 w-100 d-flex justify-content-center align-items-center btn-default" href="<?= APP_URL ?>/views/admin/home.php">Cancel</a>
                                <button type="submit" class="btn w-100 d-flex justify-content-center align-items-center  btn-primary">Store</button>
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