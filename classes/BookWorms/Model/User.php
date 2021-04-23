<?php

namespace BookWorms\Model;

use Exception;
use PDO;

class User
{
    public $id;
    public $email;
    public $password;
    public $name;
    public $role_id;

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
                ":email" => $this->email,
                ":password" => $this->password,
                ":name" => $this->name,
                ":role_id" => $this->role_id
            ];
            if ($this->id === null) {
                $sql = "INSERT INTO users (email, password, name, role_id) VALUES (:email, :password, :name, :role_id)";
            } else {
                $params = [
                    ":email" => $this->email,
                    ":name" => $this->name,
                ];

                $sql = "UPDATE users SET email = :email, name = :name WHERE id = :id";
                $params[":id"] = $this->id;
            }
            $stmt = $conn->prepare($sql);
            $status = $stmt->execute($params);

            if (!$status) {
                $error_info = $stmt->errorInfo();
                $message = "SQLSTATE error code = " . $error_info[0] . "; error message = " . $error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            // this throws an error if the update was successful but nothing changed,
            // doesn't make sense in the context of updating customer and user info at the same time, may not necessarily change at all
            // added first if statement to make sure we only do this check on NEW users
            if ($this->id === null) {
                if ($stmt->rowCount() !== 1) {
                    throw new Exception("Failed to save user.");
                }
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

                $sql = "DELETE FROM users WHERE id = :id";
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
        $users = array();

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM users";
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
                    $user = new User();
                    $user->id = $row['id'];
                    $user->email = $row['email'];
                    $user->password = $row['password'];
                    $user->name = $row['name'];
                    $user->role_id = $row['role_id'];
                    $users[] = $user;

                    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $users;
    }

    public static function findById($id)
    {
        $user = null;

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM users WHERE id = :id";
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
                $user = new User();
                $user->id = $row['id'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                $user->name = $row['name'];
                $user->role_id = $row['role_id'];
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $user;
    }

    public static function findByEmail($email)
    {
        $user = null;

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM users WHERE email = :email";
            $select_params = [
                ":email" => $email
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
                $user = new User();
                $user->id = $row['id'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                $user->name = $row['name'];
                $user->role_id = $row['role_id'];
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $user;
    }
}
