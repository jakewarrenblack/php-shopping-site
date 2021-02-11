<?php
namespace BookWorms\Model;

use Exception;
use PDO;

class Role {
    public $id;
    public $title;

    function __construct() {
        $this->id = null;
    }

    public function save() {
        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $params = [
                ":title" => $this->title
            ];
            if ($this->id === null) {
                $sql = "INSERT INTO roles (title) VALUES (:title)";
            }
            else {
                $sql = "UPDATE roles SET title = :title WHERE id = :id" ;
                $params[":id"] = $this->id;
            }
            $stmt = $conn->prepare($sql);
            $status = $stmt->execute($params);

            if (!$status) {
                $error_info = $stmt->errorInfo();
                $message = "SQLSTATE error code = ".$error_info[0]."; error message = ".$error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            if ($stmt->rowCount() !== 1) {
                throw new Exception("Failed to save role.");
            }

            if ($this->id === null) {
                $this->id = $conn->lastInsertId();
            }
        }
        finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }
    }

    public function delete() {
        $db = null;
        try {
            if ($this->id !== null) {
                $db = new DB();
                $db->open();
                $conn = $db->get_connection();

                $sql = "DELETE FROM roles WHERE id = :id" ;
                $params = [
                    ":id" => $this->id
                ];
                $stmt = $conn->prepare($sql);
                $status = $stmt->execute($params);

                if (!$status) {
                    $error_info = $stmt->errorInfo();
                    $message = "SQLSTATE error code = ".$error_info[0]."; error message = ".$error_info[2];
                    throw new Exception("Database error executing database query: " . $message);
                }

                if ($stmt->rowCount() !== 1) {
                    throw new Exception("Failed to delete role.");
                }
            }
        }
        finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }
    }

    public static function findAll() {
        $roles = array();

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM roles";
            $select_stmt = $conn->prepare($select_sql);
            $select_status = $select_stmt->execute();

            if (!$select_status) {
                $error_info = $select_stmt->errorInfo();
                $message = "SQLSTATE error code = ".$error_info[0]."; error message = ".$error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            if ($select_stmt->rowCount() !== 0) {
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                while ($row !== FALSE) {
                    $role = new Role();
                    $role->id = $row['id'];
                    $role->title = $row['title'];
                    $roles[] = $role;

                    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        }
        finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $roles;
    }

    public static function findById($id) {
        $role = null;

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM roles WHERE id = :id";
            $select_params = [
                ":id" => $id
            ];
            $select_stmt = $conn->prepare($select_sql);
            $select_status = $select_stmt->execute($select_params);

            if (!$select_status) {
                $error_info = $select_stmt->errorInfo();
                $message = "SQLSTATE error code = ".$error_info[0]."; error message = ".$error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            if ($select_stmt->rowCount() !== 0) {
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                $role = new Role();
                $role->id = $row['id'];
                $role->title = $row['title'];
            }
        }
        finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $role;
    }

    public static function findByTitle($title) {
        $role = null;

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM roles WHERE title = :title";
            $select_params = [
                ":title" => $title
            ];
            $select_stmt = $conn->prepare($select_sql);
            $select_status = $select_stmt->execute($select_params);

            if (!$select_status) {
                $error_info = $select_stmt->errorInfo();
                $message = "SQLSTATE error code = ".$error_info[0]."; error message = ".$error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            if ($select_stmt->rowCount() !== 0) {
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                $role = new Role();
                $role->id = $row['id'];
                $role->title = $row['title'];
            }
        }
        finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $role;
    }
}
