<?php

class diseaseSymptomsUtility
{
    function getDiseaseSymptomsList()
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT ds.*,
                                                    (SELECT diease_name FROM diease_master_list WHERE diease_id = ds.diease_id) AS diease_name
                                                    FROM diease_symptoms ds WHERE ds_status = :ds_status");
            $sql->execute(array("ds_status"=>'1'));
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage() , "data"=>array());
            return $result;
        }
    }

    function addDiseaseSymptoms()
    {
        try {
            $sql = "INSERT INTO diease_symptoms
                                ( diease_id , ds_text )
                                 VALUES
                                 (:diease_id , :ds_text );
                                 ";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':diease_id'           => $_POST["diease_id"],
                    ':ds_text'               => $_POST["ds_text"]
                )
            );
            $last_id = $conn->lastInsertId();
            $result = array("status" => '1' ,'last_id' => $last_id );
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    function getDiseaseSymptomsById($id)
    {
        $result = array();
        try {

            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare("SELECT * FROM diease_symptoms WHERE ds_id = :ds_id ");
            $stmt->execute(array
                (':ds_id' => $id)
            );
            $result["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    function editDiseaseSymptoms()
    {
        try {
            $sql = " UPDATE diease_symptoms
                           set
                             diease_id = :diease_id , ds_text = :ds_text
                           WHERE
                              ds_id = :ds_id";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':diease_id' => $_POST['diease_id'],
                    ':ds_text' => $_POST["ds_text"],
                    ':ds_id' => $_POST["ds_id"]
                )
            );

            $result = array("status" => '1', 'new_id' => $_POST);
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    function removeDiseaseSymptomsById($id)
    {
        try {
            $sql = " UPDATE diease_symptoms
                           set
                             ds_status = :ds_status
                           WHERE
                              ds_id = :ds_id";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':ds_status'    => '0',
                    ':ds_id'    => $id
                )
            );

            $result = array("status" => '1' ,'rm_id' => $id );
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }


}