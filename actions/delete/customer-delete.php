<?php require_once '../../config.php'; ?>
<?php

use BookWorms\Model\Customer;
use BookWorms\Model\User;
use BookWorms\Model\Transaction_Timber;
use BookWorms\Model\Transaction;

try {
    $rules = [
        'customer_id' => 'present'
    ];
    $request->validate($rules);
    if (!$request->is_valid()) {
        throw new Exception("Illegal request");
    }
    $customer_id = $request->input('customer_id');
    $customer = Customer::findById($customer_id);
    if ($customer === null) {
        throw new Exception("Illegal request parameter");
    }

    // We also delete existing transaction records for this customer
    if (Transaction::findByCustomerId($customer_id) != null) {
        $customer_transactions = Transaction::findByCustomerId($customer_id);
        $transaction_timbers = null;
        foreach ($customer_transactions as $customer_transaction) {
            $transaction_timbers = Transaction_Timber::findByTransactionId($customer_transaction->id);
        }
        foreach ($transaction_timbers as $transaction_timber) {
            $transaction_timber->delete();
        }
        foreach ($customer_transactions as $customer_transaction) {
            $customer_transaction->delete();
        }
    }



    $customer->delete();

    $user = User::findById($customer->user_id);
    $user->delete();

    $request->session()->set("flash_message", "The customer was successfully deleted from the database");
    $request->session()->set("flash_message_class", "alert-info");
    $request->redirect("/index.php");
} catch (Exception $ex) {
    $request->session()->set("flash_message", $ex->getMessage());
    $request->session()->set("flash_message_class", "alert-warning");
    $request->redirect("/index.php");
}
?>