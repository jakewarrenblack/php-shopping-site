<?php

namespace BookWorms\Model;

use Exception;
use PDO;

class Transaction_Timber
{
    public $id;
    public $quantity;
    public $profiling;
    public $sqfootage;
    public $fire_rated;
    public $transaction_id;
    public $timber_id;

    function __construct()
    {
        $this->id = null;
    }

    public function save()
    {
        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $params = [
                ":quantity" => $this->quantity,
                ":profiling" => $this->profiling,
                ":sqfootage" => $this->sqfootage,
                ":fire_rated" => $this->fire_rated,
                ":transaction_id" => $this->transaction_id,
                ":timber_id" => $this->timber_id
            ];
            if ($this->id === null) {
                $sql = "INSERT INTO transaction_timber (quantity, profiling, sqfootage, fire_rated, transaction_id, timber_id) VALUES (:quantity, :profiling, :sqfootage, :fire_rated, :transaction_id, :timber_id)";
            } else {
                $sql = "UPDATE transaction_timber SET quantity = :quantity, profiling = :profiling, sqfootage = :sqfootage, fire_rated = :fire_rated, transaction_id = :transaction_id, timber_id = :timber_id WHERE id = :id";
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
                throw new Exception("Failed to save transaction_timber record.");
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

    public function delete()
    {
        $db = null;
        try {
            if ($this->id !== null) {
                $db = new DB();
                $db->open();
                $conn = $db->get_connection();

                $sql = "DELETE FROM transaction_timber WHERE id = :id";
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
                    throw new Exception("Failed to delete transaction_timber.");
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
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $transaction;
    }

    public static function findByTransactionId($transaction_id)
    {
        $transaction_timbers = array();;

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM transaction_timber WHERE transaction_id = :transaction_id";
            $select_params = [
                ":transaction_id" => $transaction_id
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
                while ($row != FALSE) {
                    $transaction_timber = new Transaction_Timber();
                    $transaction_timber->id = $row['id'];
                    $transaction_timber->quantity = $row['quantity'];
                    $transaction_timber->profiling = $row['profiling'];
                    $transaction_timber->sqfootage = $row['sqfootage'];
                    $transaction_timber->fire_rated = $row['fire_rated'];
                    $transaction_timber->transaction_id = $row['transaction_id'];
                    $transaction_timber->timber_id = $row['timber_id'];
                    $transaction_timbers[] = $transaction_timber;

                    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $transaction_timbers;
    }

    public static function findByCustomerId($customer_id)
    {
        $transaction_timbers = array();

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM transaction_timber WHERE customer_id = :customer_id";
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
                while ($row != FALSE) {
                    $transaction_timber = new Transaction_Timber();
                    $transaction_timber->id = $row['id'];
                    $transaction_timber->quantity = $row['quantity'];
                    $transaction_timber->profiling = $row['profiling'];
                    $transaction_timber->sqfootage = $row['sqfootage'];
                    $transaction_timber->fire_rated = $row['fire_rated'];
                    $transaction_timber->transaction_id = $row['transaction_id'];
                    $transaction_timber->timber_id = $row['timber_id'];
                    $transaction_timbers[] = $transaction_timber;

                    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $transaction_timbers;
    }
}
