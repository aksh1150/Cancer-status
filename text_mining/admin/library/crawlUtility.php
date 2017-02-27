<?php

/**
 * Created by PhpStorm.
 * User: HP
 * Date: 02-Jun-16
 * Time: 5:10 PM
 */
class crawlUtility
{
    public function insertCrawlData($info)
    {
        $result = array();
        foreach ($info["crawl_arr"] AS $key => $value) {
            try {
                $sql = " INSERT INTO crawl_data
                                ( link_id, cat_id, key_id, `count` )
                                 VALUES
                                 ( :link_id, :cat_id, :key_id, :count );
                                 ";
                $conn = DB_CONN::getInstance();
                $stmt = $conn->prepare($sql);
                $stmt->execute(array
                    (
                        ':link_id' => $info["link_id"],
                        ':cat_id' => $info["cat_id"],
                        ':key_id' => $key,
                        ':count' => $value["count"]
                    )
                );
                $last_id = $conn->lastInsertId();
                $result[] = array("status" => '1', 'last_id' => $last_id);
            } catch (PDOException $e) {
                $result[] = array("status" => '0', "error" => $e->getMessage());
            }
        }
        return $result;
    }

    public function updateCrawlData($info)
    {
        foreach ($info["crawl_arr"] AS $key => $value) {
            try {
                $sql = " UPDATE crawl_data
                           set
                              count = :count
                           WHERE
                              link_id = :link_id AND cat_id = :cat_id AND key_id =:key_id";
                $conn = DB_CONN::getInstance();
                $stmt = $conn->prepare($sql);
                $stmt->execute(array
                    (
                        ':link_id' => $info["link_id"],
                        ':cat_id' => $info["cat_id"],
                        ':key_id' => $key,
                        ':count' => $value["count"]
                    )
                );
                $last_id = $conn->lastInsertId();
                $result = array("status" => '1', 'last_id' => $last_id);
            } catch (PDOException $e) {
                $result = array("status" => '0', "error" => $e->getMessage());
            }
        }
    }

    public function updateLinkUseStatus($link_id)
    {
        try {
            $sql = " UPDATE link_tbl
                           set
                              link_used = :link_used
                           WHERE
                              id_link = :id_link ";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':id_link' => $link_id,
                    ':link_used' => 1
                )
            );
            $last_id = $conn->lastInsertId();
            $result = array("status" => '1', 'last_id' => $last_id);
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    function getPreviousCrawlData()
    {
        $result = array();
        try {

            $sql = DB_CONN::getInstance()->prepare("SELECT cd.* ,
                       (SELECT keyword FROM keyword_tbl WHERE id_key = cd.key_id) AS keyword_name
                        FROM crawl_data cd
                        WHERE cd.link_id = :link_id
                        AND cd.cat_id = :cat_id");
            $sql->execute(array(':link_id' => $_POST["url_id"] , ':cat_id' => $_POST["cat_id"]));
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

}