<?php

namespace BookWorms\Model;

use Exception;
use PDO;

class Transaction
{
    public $id;
    public $customer_id;
    public $status;
    public $date;
    public $total;

    function __construct()
    {
        $this->id = null;
    }

    //we set an ID on this. Transaction's id will be our Stripe transaction id, so not auto incremented.
    public function save()
    {
        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $params = [
                ":id" => $this->id,
                ":customer_id" => $this->customer_id,
                ":status" => $this->status,
                ":date" => $this->date,
                ":total" => $this->total
            ];

            $date2 = null;

            if(isset($_POST['date2'])){
                $date = explode("-",$this->date);
                $time = explode(":",$_POST['date2']);
                $mysqltime = ($date[0]).'-'.($date[1]).'-'.($date[2]).' '.($time[0]).':'.($time[1]).':'.($time[2]);
                $params[":date"] = $mysqltime;
            }

            // this function returns true if this id does not exist in the db
            if ($this->checkExists($this->id)) {
                $sql = "INSERT INTO transactions (id, customer_id, status, date, total) VALUES (:id, :customer_id, :status, :date, :total)";
            } else {
                $sql = "UPDATE transactions SET customer_id = :customer_id, status = :status, date = :date, total = :total WHERE id = :id";
                $params[":id"] = $this->id;
            }


            $stmt = $conn->prepare($sql);
            $status = $stmt->execute($params);

            if (!$status) {
                $error_info = $stmt->errorInfo();
                $message = "SQLSTATE error code = " . $error_info[0] . "; error message = " . $error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            if ($stmt->rowCount() !== 1) {
                throw new Exception("Failed to save transaction.");
            }

            if ($this->id === null) {
                $this->id = $conn->lastInsertId();
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }
    }

    public function checkExists($id)
    {

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $params = [
                ":id" => $this->id
            ];

            $sql = "SELECT * FROM transactions WHERE id = :id";

            $stmt = $conn->prepare($sql);
            $status = $stmt->execute($params);

            if (!$status) {
                $error_info = $stmt->errorInfo();
                $message = "SQLSTATE error code = " . $error_info[0] . "; error message = " . $error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            // if this id isn't in the db
            if ($stmt->rowCount() !== 1) {
                return true;
            } else {
                return false;
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }
    }

    public function delete()
    {
        $db = null;
        try {
            if ($this->id !== null) {
                $db = new DB();
                $db->open();
                $conn = $db->get_connection();

                $sql = "DELETE FROM transactions WHERE id = :id";
                $params = [
                    ":id" => $this->id
                ];
                $stmt = $conn->prepare($sql);
                $status = $stmt->execute($params);

                if (!$status) {
                    $error_info = $stmt->errorInfo();
                    $message = "SQLSTATE error code = " . $error_info[0] . "; error message = " . $error_info[2];
                    throw new Exception("Database error executing database query: " . $message);
                }

                if ($stmt->rowCount() !== 1) {
                    throw new Exception("Failed to delete transaction.");
                }
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }
    }

    public static function findAll()
    {
        $transactions = array();

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM transactions";
            $select_stmt = $conn->prepare($select_sql);
            $select_status = $select_stmt->execute();

            if (!$select_status) {
                $error_info = $select_stmt->errorInfo();
                $message = "SQLSTATE error code = " . $error_info[0] . "; error message = " . $error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            if ($select_stmt->rowCount() !== 0) {
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                while ($row !== FALSE) {
                    $transaction = new Transaction();
                    $transaction->id = $row['id'];
                    $transaction->customer_id = $row['customer_id'];
                    $transaction->status = $row['status'];
                    $transaction->date = $row['date'];
                    $transaction->total = $row['total'];
                    $transactions[] = $transaction;

                    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $transactions;
    }

    public static function findById($id)
    {
        $transaction = null;

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM transactions WHERE id = :id";
            $select_params = [
                ":id" => $id
            ];
            $select_stmt = $conn->prepare($select_sql);
            $select_status = $select_stmt->execute($select_params);

            if (!$select_status) {
                $error_info = $select_stmt->errorInfo();
                $message = "SQLSTATE error code = " . $error_info[0] . "; error message = " . $error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            if ($select_stmt->rowCount() !== 0) {
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                $transaction = new Transaction();
                $transaction->id = $row['id'];
                $transaction->customer_id = $row['customer_id'];
                $transaction->status = $row['status'];
                $transaction->date = $row['date'];
                $transaction->total = $row['total'];
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $transaction;
    }


    public static function findAllById($id)
    {
        $transactions = array();

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM transactions WHERE id = :id";
            $select_params = [
                ":id" => $id
            ];
            $select_stmt = $conn->prepare($select_sql);
            $select_status = $select_stmt->execute($select_params);

            if (!$select_status) {
                $error_info = $select_stmt->errorInfo();
                $message = "SQLSTATE error code = " . $error_info[0] . "; error message = " . $error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            if ($select_stmt->rowCount() !== 0) {
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                while ($row !== FALSE) {
                    $transaction = new Transaction();
                    $transaction->id = $row['id'];
                    $transaction->customer_id = $row['customer_id'];
                    $transaction->status = $row['status'];
                    $transaction->date = $row['date'];
                    $transaction->total = $row['total'];
                    $transactions[] = $transaction;

                    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $transactions;
    }

    public static function findByCustomerId($customer_id)
    {
        $transactions = array();

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM transactions WHERE customer_id = :customer_id";
            $select_params = [
                ":customer_id" => $customer_id
            ];
            $select_stmt = $conn->prepare($select_sql);
            $select_status = $select_stmt->execute($select_params);

            if (!$select_status) {
                $error_info = $select_stmt->errorInfo();
                $message = "SQLSTATE error code = " . $error_info[0] . "; error message = " . $error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            if ($select_stmt->rowCount() !== 0) {
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                while ($row !== FALSE) {
                    $transaction = new Transaction();
                    $transaction->id = $row['id'];
                    $transaction->customer_id = $row['customer_id'];
                    $transaction->status = $row['status'];
                    $transaction->date = $row['date'];
                    $transaction->total = $row['total'];
                    $transactions[] = $transaction;

                    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $transactions;
    }
}
