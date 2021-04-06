<?php
use BookWorms\Model\Transaction;

$transactions = Transaction::findAll();
$numProducts = count($transactions);
$pageSize = 10;
$numPages = ceil($numProducts / $pageSize);
?>
<table class="table" id="table-transactions">
    <thead>
        <tr>
            <th>Id</th>
            <th>Species</th>
            <th>description</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions as $transaction) { ?>
            <tr class="d-none">
                <td><?= $transaction->id ?></td>
                <td><?= $transaction->customer_id ?></td>
                <td><?= $transaction->status ?></td>
                <td><?= $transaction->date ?></td>
                <td><?= $transaction->total ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>
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