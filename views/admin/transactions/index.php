<?php

use BookWorms\Model\Transaction;
use BookWorms\Model\Customer;
use BookWorms\Model\User;

$transactions = Transaction::findAll();
$numProducts = count($transactions);
$pageSize = 10;
$numPages = ceil($numProducts / $pageSize);
?>
<form class="d-contents" method="get">
    <table class="table" id="table-transactions">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Status</th>
                <th>Date</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction) { ?>
                <tr class="d-none">
                    <td><input type="radio" name="transaction_id" value="<?= $transaction->id ?>" /></td>
                    <td>
                        <?php
                        $customer = Customer::findById($transaction->customer_id);
                        $user = User::findById($customer->user_id);
                        $name = $user->name;
                        echo $name
                        ?>
                    </td>
                    <td><?= $transaction->status ?></td>
                    <td><?= $transaction->date ?></td>
                    <td><?= $transaction->total ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="row d-flex p-0 m-0 ml-2 mb-2">
        <button class="btn w-100 mb-1 home-btn btn-warning mr-2" formaction="<?= APP_URL ?>/views/admin/transactions/transaction-edit.php">Edit</button>
        <button class="btn w-100 mb-1 home-btn btn-danger mr-2" formaction="<?= APP_URL ?>/actions/delete/transaction-delete.php">Delete</button>
    </div>
</form>
<nav id="nav-transactions">
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