<?php

use BookWorms\Model\Customer;
use BookWorms\Model\User;
use BookWorms\Model\Image;

$customers = Customer::findAll();
$numCustomers = count($customers);
$pageSize = 10;
$numPages = ceil($numCustomers / $pageSize);
?>
    <table class="table" id="table-customers">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Phone</th>
                <th>User ID</th>
                <th>Image</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer) { ?>
                <tr class="d-none">
                    <td>
                        <?php
                        try {
                            $user = User::findById($customer->user_id);
                        } catch (Exception $e) {
                        }
                        if ($user !== null) {
                        ?>
                            <?= $user->name ?>
                        <?php
                        }
                        ?>
                    </td>
                    <td><?= $customer->address ?></td>
                    <td><?= $customer->phone ?></td>
                    <td><?= $customer->user_id ?></td>
                    <td>
                        <?php
                        try {
                            $image = Image::findById($customer->image_id);
                        } catch (Exception $e) {
                        }
                        if ($image !== null) {
                        ?>
                            <img src="<?= APP_URL . "/actions/" . $image->filename ?>" width="40px" alt="image" class="mt-2 mb-2" />
                        <?php
                        }
                        ?>
                    </td>
                    <td><a href="<?= APP_URL ?>/views/admin/customers/customer-edit.php?customer_id=<?= $customer->id ?>"><i class="fas fa-pen"></i></a></td>
                    <td class="btn-customer-delete"><a class="btn-customer-delete" href="<?= APP_URL ?>/actions/delete/customer-delete.php?customer_id=<?= $customer->id ?>"><i class="fas fa-trash"></i></a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <script src="<?= APP_URL ?>/assets/js/script.js"></script>
<nav id="nav-customers">
    <ul class="pagination justify-content-center">
        <li class="page-item">
            <a class="page-link" href="#" data-page="previous">
                &laquo;
            </a>
        </li>
        <?php for ($i = 0; $i < $numPages; $i++) { ?>
            <li class="page-item">
                <a class="page-link" href="#" data-page="<?= $i + 1 ?>">
                    <?= $i + 1 ?>
                </a>
            </li>
        <?php } ?>
        <li class="page-item">
            <a class="page-link" href="#" data-page="next">
                &raquo;
            </a>
        </li>
    </ul>
</nav>