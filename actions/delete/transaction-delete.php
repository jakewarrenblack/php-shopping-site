<?php require_once '../../config.php'; ?>
<?php

use BookWorms\Model\Transaction;
use BookWorms\Model\Transaction_Timber;

try {
    $rules = [
        'transaction_id' => 'present'
    ];
    $request->validate($rules);
    if (!$request->is_valid()) {
        throw new Exception("Illegal request! Please select a record first!");
    }
    $transaction_id = $request->input('transaction_id');
    $transaction = Transaction::findById($transaction_id);
    if ($transaction === null) {
        throw new Exception("Illegal request parameter!");
    }

    // Have to delete the transaction_timber record first, or a foreign key constraint would fail!
    $transaction_timber = Transaction_Timber::findByTransactionId($transaction->id);
    foreach ($transaction_timber as $transaction_timbers) {
        $transaction_timbers->delete();
    }

    $transaction->delete();

    $request->session()->set("flash_message", "The transaction was successfully deleted from the database");
    $request->session()->set("flash_message_class", "alert-info");
    $request->redirect("/views/admin/home.php");
} catch (Exception $ex) {
    $request->session()->set("flash_message", $ex->getMessage());
    $request->session()->set("flash_message_class", "alert-warning");
    $request->redirect("/views/admin/home.php");
}
?>