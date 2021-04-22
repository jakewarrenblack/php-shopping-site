<?php

namespace BookWorms\Model;

use Exception;
use PDO;

class Timber
{
    public $id;
    public $title;
    public $description;
    public $price;
    public $category_id;
    public $minimum_order;
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
                ":title" => $this->title,
                ":description" => $this->description,
                ":price" => $this->price,
                ":category_id" => $this->category_id,
                ":minimum_order" => $this->minimum_order,
                ":image_id" => $this->image_id
            ];
            if ($this->id === null) {
                $sql = "INSERT INTO timbers (title, description, price, category_id, minimum_order, image_id) VALUES (:title, :description, :price, :category_id, :minimum_order, :image_id)";
            } else {
                $sql = "UPDATE timbers SET title = :title, description = :description, price = :price, category_id = :category_id, minimum_order = :minimum_order, image_id = :image_id WHERE id = :id";
                $params[":id"] = $this->id;
            }
            $stmt = $conn->prepare($sql);
            $status = $stmt->execute($params);

            if (!$status) {
                $error_info = $stmt->errorInfo();
                $message = "SQLSTATE error code = " . $error_info[0] . "; error message = " . $error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            // Removed because this doesn't necessarily mean an update didn't work...
            // A user might go to the timber-edit form and only change a related_image or attribute
            // neither of which are directly linked to the timber object itself

            // if ($stmt->rowCount() !== 1) {
            //     throw new Exception("Failed to save timber.");
            // }

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

                $sql = "DELETE FROM timbers WHERE id = :id";
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
                    throw new Exception("Failed to delete timber product.");
                }
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }
    }

    public static function findAll($start = null, $limit = null, $order = null)
    {
        $timbers = array();

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = null;
            $params = null;

            if ($start === null || $limit === null) {
                $select_sql = "SELECT * FROM timbers";
            } else {
                if ($order === null) {
                    $select_sql = "SELECT * FROM timbers limit $start, $limit";
                } else {
                    $select_sql = "SELECT * FROM timbers ORDER BY $order limit $start, $limit";
                }
            }

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
                    $timber = new Timber();
                    $timber->id = $row['id'];
                    $timber->title = $row['title'];
                    $timber->description = $row['description'];
                    $timber->price = $row['price'];
                    $timber->category_id = $row['category_id'];
                    $timber->minimum_order = $row['minimum_order'];
                    $timber->image_id = $row['image_id'];
                    $timbers[] = $timber;

                    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $timbers;
    }

    public static function findById($id)
    {
        $timber = null;

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM timbers WHERE id = :id";
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
                $timber = new Timber();
                $timber->id = $row['id'];
                $timber->title = $row['title'];
                $timber->description = $row['description'];
                $timber->price = $row['price'];
                $timber->category_id = $row['category_id'];
                $timber->minimum_order = $row['minimum_order'];
                $timber->image_id = $row['image_id'];
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $timber;
    }

    public static function findByTitle($title)
    {
        $timber = null;

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM timbers WHERE title = :title";
            $select_params = [
                ":title" => $title
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
                $timber = new Timber();
                $timber->id = $row['id'];
                $timber->title = $row['title'];
                $timber->description = $row['description'];
                $timber->price = $row['price'];
                $timber->category_id = $row['category_id'];
                $timber->minimum_order = $row['minimum_order'];
                $timber->image_id = $row['image_id'];
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $timber;
    }

    public static function findByCategoryId($category_id, $limit = null)
    {
        $timbers = array();

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM timbers WHERE category_id = :category_id LIMIT $limit";
            $select_params = [
                ":category_id" => $category_id
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
                    $timber = new Timber();
                    $timber->id = $row['id'];
                    $timber->title = $row['title'];
                    $timber->description = $row['description'];
                    $timber->price = $row['price'];
                    $timber->category_id = $row['category_id'];
                    $timber->minimum_order = $row['minimum_order'];
                    $timber->image_id = $row['image_id'];
                    $timbers[] = $timber;
                    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $timbers;
    }

    public static function findByCategoryIdExcluding($category_id, $id, $limit = null)
    {
        $timbers = array();

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();
            $select_sql = "SELECT * FROM timbers WHERE category_id = :category_id AND id NOT IN(SELECT id FROM timbers WHERE id = :id) LIMIT $limit";
            $select_params = [
                ":category_id" => $category_id,
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
                while ($row != FALSE) {
                    $timber = new Timber();
                    $timber->id = $row['id'];
                    $timber->title = $row['title'];
                    $timber->description = $row['description'];
                    $timber->price = $row['price'];
                    $timber->category_id = $row['category_id'];
                    $timber->minimum_order = $row['minimum_order'];
                    $timber->image_id = $row['image_id'];
                    $timbers[] = $timber;
                    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $timbers;
    }


    public static function findWhereIdIn($ids, $params)
    {
        $timbers = array();

        try {
            $db = new DB();
            $db->open();
            $conn = $db->get_connection();

            $select_sql = "SELECT * FROM timbers WHERE id IN ($ids)";

            $select_stmt = $conn->prepare($select_sql);
            // change our '?'s to the actual id values
            $select_status = $select_stmt->execute(array_keys($params));

            if (!$select_status) {
                $error_info = $select_stmt->errorInfo();
                $message = "SQLSTATE error code = " . $error_info[0] . "; error message = " . $error_info[2];
                throw new Exception("Database error executing database query: " . $message);
            }

            if ($select_stmt->rowCount() !== 0) {
                $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                while ($row !== FALSE) {
                    $timber = new Timber();
                    $timber->id = $row['id'];
                    $timber->title = $row['title'];
                    $timber->description = $row['description'];
                    $timber->price = $row['price'];
                    $timber->category_id = $row['category_id'];
                    $timber->minimum_order = $row['minimum_order'];
                    $timber->image_id = $row['image_id'];
                    $timbers[] = $timber;

                    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
                }
            }
        } finally {
            if ($db !== null && $db->is_open()) {
                $db->close();
            }
        }

        return $timbers;
    }
}
