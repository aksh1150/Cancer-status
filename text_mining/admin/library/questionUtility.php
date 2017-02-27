<?php

class questionUtility
{

    public function addQuestionData()
    {
        try {
            $answer = json_encode($_POST["ans"]);
            $sql = " INSERT INTO question_master_tbl
                                ( question  , answer )
                                 VALUES
                                 (:question  , :answer );
                                 ";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':question'           => $_POST["question"] ,
                    ':answer'             => $answer
                )
            );
            $last_id = $conn->lastInsertId();
            $result = array("status" => '1' ,'last_id' => $last_id );
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    public function getQuestionData()
    {
        $result = array();
        try {
            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM question_master_tbl WHERE status = :status");
            $sql->execute( array(":status"=>'1'));
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function removeQuestionDataById($id)
    {
        try {
            $sql = " UPDATE question_master_tbl
                           set
                             status = :status
                           WHERE
                              question_id = :question_id";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':status'    => '0',
                    ':question_id'    => $id
                )
            );

            $result = array("status" => '1' ,'rm_id' => $id );
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    public function editQuestionData()
    {
        try {
            $answer = json_encode($_POST["ans"]);
            $sql = " UPDATE question_master_tbl
                           set
                             question = :question,
                             answer = :answer
                           WHERE
                              question_id = :question_id";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':question'    => $_POST['question'],
                    ':answer'      => $answer,
                    ':question_id' => $_POST["question_id"]
                )
            );

            $result = array("status" => '1' ,'new_id' => $_POST["question_id"] );
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    function getQuestionDataById($id)
    {
        $result = array();
        try {

            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare("SELECT * FROM question_master_tbl WHERE question_id = :question_id ");
            $stmt->execute(array
                (':question_id' => $id)
            );
            $result["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }


} // End class