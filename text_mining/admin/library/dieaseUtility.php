<?php

class dieaseUtility
{
    public function getDiseaseList()
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM diease_master_list WHERE diease_status = '1'");
            $sql->execute();
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage() , "data"=>array());
            return $result;
        }
    }

    public function addDiseaseName()
    {
        try {
            $sql = "INSERT INTO diease_master_list
                                ( diease_name )
                                 VALUES
                                 (:diease_name  );
                                 ";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':diease_name'           => $_POST["diease_name"]
                )
            );
            $last_id = $conn->lastInsertId();
            $result = array("status" => '1' ,'last_id' => $last_id );
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    function getDiseaseNameById($id)
    {
        $result = array();
        try {
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare("SELECT * FROM diease_master_list WHERE diease_id = :diease_id ");
            $stmt->execute(array
                (':diease_id' => $id)
            );
            $result["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function editDiseaseName()
    {
        try {
            $sql = " UPDATE diease_master_list
                           set
                             diease_name = :diease_name
                           WHERE
                              diease_id = :diease_id";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':diease_name'    => $_POST['diease_name'],
                    ':diease_id'             => $_POST["diease_id"]
                )
            );

            $result = array("status" => '1' ,'new_id' => $_POST["diease_id"] );
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    public function removeDiseaseNameById($id)
    {
        try {
            $sql = " UPDATE diease_master_list
                           set
                             diease_status = :diease_status
                           WHERE
                              diease_id = :diease_id";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':diease_status'    => '0',
                    ':diease_id'    => $id
                )
            );

            $result = array("status" => '1' ,'rm_id' => $id );
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

}