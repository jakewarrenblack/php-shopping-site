<?php

namespace BookWorms\Model;

use Exception;
use PDO;

class Customer
{
    public $id;
    public $address;
    public $phone;
    public $user_id;
    public $image_id;

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
                ":address" => $this->address,
                ":phone" => $this->phone,
                ":user_id" => $this->user_id,
                ":image_id" => $this->image_id
            ];
            if ($this->id === null) {
                $sql = "INSERT INTO customers (address, phone, user_id, image_id) VALUES (:address, :phone, :user_id, :image_id)";
            } else {
                $sql = "UPDATE customers SET address = :address, phone = :phone, user_id = :user_id, image_id = :image_id WHERE id = :id";
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
                throw new Exception("Failed to save user.");
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

                $sql = "DELETE FROM customers WHERE id = :id";
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
                    throw new Exception("Failed to delete user.");
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
        $customers = array();

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM customers";
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
                    $customer = new Customer();
                    $customer->id = $row['id'];
                    $customer->address = $row['address'];
                    $customer->phone = $row['phone'];
                    $customer->user_id = $row['user_id'];
                    $customer->image_id = $row['image_id'];
                    $customers[] = $customer;

                    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $customers;
    }

    public static function findById($id)
    {
        $customer = null;

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM customers WHERE id = :id";
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
                $customer = new Customer();
                $customer->id = $row['id'];
                $customer->address = $row['address'];
                $customer->phone = $row['phone'];
                $customer->user_id = $row['user_id'];
                $customer->image_id = $row['image_id'];
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $customer;
    }

    public static function findByPhone($phone)
    {
        $customer = null;

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM customers WHERE phone = :phone";
            $select_params = [
                ":phone" => $phone
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
                $customer = new Customer();
                $customer->id = $row['id'];
                $customer->address = $row['address'];
                $customer->phone = $row['phone'];
                $customer->user_id = $row['user_id'];
                $customer->image_id = $row['image_id'];
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $customer;
    }

    //function necessary to find customers on home.php
    public static function findByUserID($user_id)
    {
        $customer = null;

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM customers WHERE user_id = :user_id";
            $select_params = [
                ":user_id" => $user_id
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
                $customer = new Customer();
                $customer->id = $row['id'];
                $customer->address = $row['address'];
                $customer->phone = $row['phone'];
                $customer->user_id = $row['user_id'];
                $customer->image_id = $row['image_id'];
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $customer;
    }
}
