<?php
require_once '../config.php';

use BookWorms\Model\Transaction;
use BookWorms\Model\Customer;

try {
    $status = [
        "succeeded", "failed"
    ];

    $rules = [
        "transaction_id" => "present",
        "customer_id" => "present|integer|minlength:1",
        "status" => "present|in:" . implode(',', $status),
        "date" => "present",
        "total" => "present|integer|minlength:1"
    ];

    $request->validate($rules);
    if ($request->is_valid()) {
        $transaction = Transaction::findById($request->input("transaction_id"));
        $transaction->customer_id = $request->input("customer_id");
        $transaction->status = $request->input("status");
        $transaction->date = $request->input("date");
        $transaction->total = $request->input("total");

        $transaction->save();
        $request->session()->set("flash_message", "The transaction was successfully updated in the database");
        $request->session()->set("flash_message_class", "alert-info");
        /*Forget any data that's already been stored in the session.*/
        $request->session()->forget("flash_data");
        $request->session()->forget("flash_errors");
        $request->redirect("/views/admin/home.php");
    } else {
        $transaction_id = $request->input("transaction_id");
        $request->session()->set("flash_data", $request->all());
        $request->session()->set("flash_errors", $request->errors());
        $request->redirect("/views/admin/transactions/transaction-edit.php?transaction_id=$transaction_id");
    }
} catch (Exception $ex) {
    $request->session()->set("flash_message", $ex->getMessage());
    $request->session()->set("flash_message_class", "alert-warning");
    $request->session()->set("flash_data", $request->all());
    $request->session()->set("flash_errors", $request->errors());

    $request->redirect("/index.php");
}
