<?php

class urlUtility
{
    public function getUrlList()
    {
        $result = array();
        try {

            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM link_tbl WHERE status = '1'");
            $sql->execute();
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function addLinkName()
    {
        try {
            $sql = " INSERT INTO link_tbl
                                ( url )
                                 VALUES
                                 (:url  );
                                 ";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':url'           => $_POST["url"]
                )
            );
            $last_id = $conn->lastInsertId();
            $result = array("status" => '1' ,'last_id' => $last_id );
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    public function getUrlById($id)
    {
        $result = array();
        try {

            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare("SELECT * FROM link_tbl WHERE id_link = :id_link ");
            $stmt->execute(array
                (':id_link' => $id)
            );
            $result["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function editUrlName()
    {
        try {
            $sql = " UPDATE link_tbl
                           set
                             url = :url
                           WHERE
                              id_link = :id_link";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':url'    => $_POST['url'],
                    ':id_link'             => $_POST["link_id"]
                )
            );

            $result = array("status" => '1' ,'new_id' => $_POST["link_id"] );
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    public function removeUrlNameById($id)
    {
        try {
            $sql = " UPDATE link_tbl
                           set
                             status = :status
                           WHERE
                              id_link = :id_link";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':status'    => '0',
                    ':id_link'    => $id
                )
            );

            $result = array("status" => '1' ,'rm_id' => $id );
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }



}