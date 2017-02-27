<?php

class categoryUtility
{
    public function getCategoryList()
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM category_tbl WHERE status = '1'");
            $sql->execute();
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function addCategoryName()
    {
        try {
            $sql = " INSERT INTO category_tbl
                                ( cat_name )
                                 VALUES
                                 (:cat_name  );
                                 ";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':cat_name'           => $_POST["cat_name"]
                )
            );
            $last_id = $conn->lastInsertId();
            $result = array("status" => '1' ,'last_id' => $last_id );
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    public function getCategoryNameById($id)
    {
        $result = array();
        try {

            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare("SELECT * FROM category_tbl WHERE id_cat = :cat_id ");
            $stmt->execute(array
                (':cat_id' => $id)
            );
            $result["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function editCategoryName()
    {
        try {
            $sql = " UPDATE category_tbl
                           set
                             cat_name = :cat_name
                           WHERE
                              id_cat = :id_cat";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':cat_name'    => $_POST['cat_name'],
                    ':id_cat'             => $_POST["cat_id"]
                )
            );

            $result = array("status" => '1' ,'new_id' => $_POST["cat_id"] );
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    public function removeCategoryNameById($id)
    {
        try {
            $sql = " UPDATE category_tbl
                           set
                             status = :status
                           WHERE
                              id_cat = :id_cat";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':status'    => '0',
                    ':id_cat'    => $id
                )
            );

            $result = array("status" => '1' ,'rm_id' => $id );
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

}