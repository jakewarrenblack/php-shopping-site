<?php

use BookWorms\Model\Transaction;
use BookWorms\Model\Transaction_Timber;
use BookWorms\Model\Timber;

$customer_id = $request->session()->get("customer_id");

try {
    $transactions = Transaction::findByCustomerId($customer_id);
    $numProducts = count($transactions);
    $pageSize = 10;
    $numPages = ceil($numProducts / $pageSize);
} catch (Exception $e) {
    $request->session()->set("flash_message", "No previous transactions.");
}
?>
<table class="table" id="table-transactions">
    <thead>
        <tr>
            <th>Transaction ID</th>
            <th>Species</th>
            <th>Status</th>
            <th>Date</th>
            <th>Total Paid</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($transactions as $transaction) { ?>
            <tr class="d-none">
                <td><?= $transaction->id ?></td>
                <td>
                    <?php
                    $transaction_timbers = Transaction_Timber::findByTransactionId($transaction->id);
                    $timbers = array();

                    foreach ($transaction_timbers as $transaction_timber) {
                        $timber_obj = Timber::findById($transaction_timber->timber_id);
                        $timbers[] = $timber_obj->title;
                    }

                    if (count($timbers) > 1) {
                        echo implode(", ", $timbers);
                    } else {
                        echo $timbers[0];
                    }
                    ?>
                </td>
                <td><?= $transaction->status ?></td>
                <td><?= $transaction->date ?></td>
                <td>&euro;<?= $transaction->total ?></td>
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