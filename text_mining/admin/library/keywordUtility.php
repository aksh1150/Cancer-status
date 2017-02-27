<?php

class keywordUtility
{

    public function getKeywordListById()
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT kt.*
                                                    FROM keyword_tbl kt WHERE kt.cat_id = :cat_id");
            $sql->execute(array("cat_id" => $_POST["cat_id"]));
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["assign_data"] = $this->getAssignDataById($_POST["cat_id"]);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function getAssignDataById($cat_id)
    {
        $result = array();
        try {

            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare("SELECT * FROM assign_data_tbl WHERE cat_id = :cat_id ");
            $stmt->execute(array
                (':cat_id' => $cat_id)
            );
            $result["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function getKeywordList()
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT kt.*,
                                                    (SELECT cat_name FROM category_tbl WHERE id_cat = kt.cat_id) AS category_name
                                                    FROM keyword_tbl kt WHERE kt.status = '1'");
            $sql->execute();
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function addKeywordName()
    {
        try {
            $sql = " INSERT INTO keyword_tbl
                                ( keyword  , cat_id)
                                 VALUES
                                 (:keyword  , :cat_id );
                                 ";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':keyword' => $_POST["keyword"],
                    ':cat_id' => $_POST["cat_id"]
                )
            );
            $last_id = $conn->lastInsertId();
            $result = array("status" => '1', 'last_id' => $last_id);
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    public function getKeywordNameById($id)
    {
        $result = array();
        try {

            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare("SELECT * FROM keyword_tbl WHERE id_key = :id_key ");
            $stmt->execute(array
                (':id_key' => $id)
            );
            $result["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function editKeywordName()
    {
        try {
            $sql = " UPDATE keyword_tbl
                           set
                             keyword = :keyword , cat_id = :cat_id
                           WHERE
                              id_key = :id_key";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':keyword' => $_POST['keyword'],
                    ':cat_id' => $_POST["cat_id"],
                    ':id_key' => $_POST["key_id"]
                )
            );

            $result = array("status" => '1', 'new_id' => $_POST);
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    /*Update Assign Keyword List*/

    public function getAssignDataByCatId($cat_id)
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT adt.key_id,
                                                  (SELECT keyword FROM keyword_tbl WHERE id_key = adt.key_id) AS keyword_name
                                                    FROM assign_data_tbl adt WHERE adt.cat_id = :cat_id");
            $sql->execute(array("cat_id" => $cat_id));
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }


    public function removeKeywordNameById($id)
    {
        try {
            $sql = " UPDATE keyword_tbl
                           set
                             status = :status
                           WHERE
                              id_key = :id_key";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':status' => '0',
                    ':id_key' => $id
                )
            );

            $result = array("status" => '1', 'rm_id' => $id);
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    public function updateAssignKeyword()
    {
        $temp_array = array();
        for ($i = 1; $i <= $_POST["length"]; $i++) {
            $temp_array[] = $_POST["checkbox_" . $i];
        }

        $result["remove_data"] = $this->removeAssignData($_POST["assign_cat_id"], $temp_array);
        for ($i = 1; $i <= $_POST["length"]; $i++) {
            $info["cat_id"] = $_POST["assign_cat_id"];
            $info["key_id"] = $_POST["checkbox_" . $i];
            $result["add_data"] = $this->addAssignData($info);
        }
        return $result;
    }

    public function removeAssignData($cat_id, $temp_array)
    {
        $result = array();
        try {
            $sub_query = '';
            foreach ($temp_array AS $key => $val) {
                $sub_query .= "AND key_id <> '" . $val . "'";
            }

            $result = array();
            $sql = " DELETE FROM assign_data_tbl WHERE
                            cat_id =  :cat_id  $sub_query
                     ";
            $q = DB_CONN::getInstance()->prepare($sql);
            $q->execute(array
                (':cat_id' => $cat_id)
            );

            $result = array("status" => '1');
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    public function addAssignData($info)
    {
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT *
                                                    FROM assign_data_tbl kt WHERE kt.cat_id = :cat_id AND key_id = :key_id");
            $sql->execute(array
            (
                ':cat_id' => $info["cat_id"],
                ':key_id' => $info["key_id"]
            ));
            $number_of_rows = $sql->fetchColumn();
            if($number_of_rows == 0)
            {
                try {
                    $sql = " INSERT INTO assign_data_tbl
                                ( cat_id  , key_id)
                                 VALUES
                                 (:cat_id  , :key_id );
                                 ";
                    $conn = DB_CONN::getInstance();
                    $stmt = $conn->prepare($sql);
                    $stmt->execute(array
                        (
                            ':cat_id' => $info["cat_id"],
                            ':key_id' => $info["key_id"]
                        )
                    );
                    $last_id = $conn->lastInsertId();
                    $result = array("status" => '1', 'last_id' => $last_id);
                } catch (PDOException $e) {
                    $result = array("status" => '0', "error" => $e->getMessage());
                }
            }
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

}

//assign_cat_id