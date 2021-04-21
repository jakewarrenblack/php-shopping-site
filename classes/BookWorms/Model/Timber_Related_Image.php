<?php

namespace BookWorms\Model;

use Exception;
use PDO;

class Timber_Related_Image
{
    public $id;
    public $related_image_id;
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
                ":related_image_id" => $this->related_image_id,
                ":timber_id" => $this->timber_id
            ];
            if ($this->id === null) {
                $sql = "INSERT INTO timber_related_image (related_image_id, timber_id) VALUES (:related_image_id, :timber_id)";
            } else {
                $sql = "UPDATE timber_related_image SET related_image_id = :related_image_id, timber_id = :timber_id";
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

                $sql = "DELETE FROM timber_related_image WHERE id = :id";
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
        $timber_related_images = array();

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM timber_related_image";
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
                    $timber_related_image = new Timber_Related_Image();
                    $timber_related_image->id = $row['id'];
                    $timber_related_image->timber_id = $row['related_image_id'];
                    $timber_related_image->attribute_id = $row['timber_id'];
                    $timber_related_images[] = $timber_related_image;
                    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $timber_related_images;
    }

    public static function findById($id)
    {
        $timber_related_image = null;

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM timber_related_image WHERE id = :id";
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
                $timber_related_image = new Timber_Related_Image();
                $timber_related_image->id = $row['id'];
                $timber_related_image->timber_id = $row['related_image_id'];
                $timber_related_image->attribute_id = $row['timber_id'];
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $timber_related_image;
    }

    public static function findByTimberId($timber_id)
    {
        $timber_related_images = array();;

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM timber_related_image WHERE timber_id = :timber_id";
            $select_params = [
                ":timber_id" => $timber_id
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
                    $timber_related_image = new Timber_Related_Image();
                    $timber_related_image->id = $row['id'];
                    $timber_related_image->timber_id = $row['timber_id'];
                    $timber_related_image->related_image_id = $row['related_image_id'];
                    $timber_related_images[] = $timber_related_image;
                    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $timber_related_images;
    }
}
