<?php

/**
 * Created by PhpStorm.
 * User: HP
 * Date: 5/13/2016
 * Time: 1:53 PM
 */
class AdminUtility
{
    /*Add new admin details*/
    public function InsertAdminDetails()
    {
        $f_name         =   $_POST['f_name'];
        $l_name         =   $_POST['l_name'];
        $a_email        =   $_POST['a_email'];
        $pwd            =   $_POST['pwd'];
        $active_status  =   $_POST['active_status'];

        $result = array();
        try {
            $sql = " INSERT INTO admin
                                ( f_name , l_name , a_email , pwd , active_status ,user_type )
                                 VALUES
                                 (:f_name, :l_name , :a_email , :pwd , :active_status ,:user_type );
                                 ";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':f_name'           => $f_name,
                    ':l_name'           => $l_name,
                    ':a_email'          => $a_email,
                    ':pwd'              => $pwd,
                    ':active_status'    => $active_status,
                    ':user_type'    =>  'SUPER_ADMIN'


                )
            );
            $last_id = $conn->lastInsertId();
            $result = array("status" => '1' ,'last_id' => $last_id );
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    /*get admin all list*/
    function get_admin_detasil()
    {
        $result = array();
        try {

            $sql = DB_CONN::getInstance()->prepare("SELECT * FROM admin WHERE user_type = 'SUPER_ADMIN'");
            $sql->execute();
            $result["data"] = $sql->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }
    /*get admin details by id for edit*/
    function get_admin_details_by_id($id)
    {
        $result = array();
        try {

            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare("SELECT * FROM admin WHERE a_id = :a_id ");
            $stmt->execute(array
                (':a_id' => $id)
            );
            $result["data"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result["status"] = 1;
            return $result;
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }

    public function InsertUserForumQuoteDetails()
    {

        $id_forum           = $_POST['id_forum'];
        $id_user            = $_SESSION['login_user_id'];
        $quote_text         = $_POST['quote_text'];
        $text_color         = $_POST['text_color'];

        $result = array();
        try {
            $sql = " INSERT INTO forum_quote
                                ( id_forum ,id_user,  quote_text , text_color )
                                 VALUES
                                 ( :id_forum , :id_user , :quote_text, :text_color );
                                 ";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':id_forum'          => $id_forum,
                    ':id_user'           => $id_user,
                    ':quote_text'        => $quote_text,
                    ':text_color'        => $text_color
                )
            );
            $last_id = $conn->lastInsertId();
            $result = array("status" => '1' ,'last_id' => $last_id );
            //$result = $this->update_count_forum($_POST['quote_count'],$id_forum);
            $result = $this->get_forum_quote_details_by_forum($id_forum);

        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    /*Update adminDetails*/
    function update_admin_details($id)
    {
        try {
            $sql = " UPDATE admin
                           set
                              f_name = :f_name,
                              l_name = :l_name,
                              a_email = :a_email,
                              pwd     = :pwd,
                              active_status =:active_status
                           WHERE
                              a_id = :a_id";
            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare($sql);
            $stmt->execute(array
                (
                    ':f_name'           => $_POST['f_name'],
                    ':l_name'           => $_POST['l_name'],
                    ':a_email'          => $_POST['a_email'],
                    ':pwd'              => $_POST['pwd'],
                    ':active_status'    => $_POST['active_status'],
                    ':a_id'             => $id
                )
            );
            $a_id = $id;
            $result = array("status" => '1' ,'new_id' => $a_id );
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }

    public function delete_admin_details($id)
    {
        $result = array();
        try {
            $result = array();
            $sql = " DELETE FROM admin WHERE
                            a_id =  :a_id
                     ";
            $q = DB_CONN::getInstance()->prepare($sql);
            $q->execute(array
                (':a_id' => $id)
            );

            $result = array("status" => '1');
        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
        }
        return $result;
    }
    function admin_login()
    {
        $username = $_POST['a_email'];
        $password = $_POST['pwd'];
        $result = array();
        try {

            $conn = DB_CONN::getInstance();
            $stmt = $conn->prepare("SELECT * FROM admin WHERE a_email = :a_email AND pwd = :pwd  ");
            $stmt->execute(array
                (
                    ':a_email' => $username,
                    ':pwd'     => $password,
                )
            );
            $rows = $stmt->rowCount();
            if ($rows > 0)
            {
                $results_login = $stmt->fetch(PDO::FETCH_ASSOC);

                $_SESSION['login_admin_name'] = $results_login['f_name'];
                $_SESSION['login_admin_id'] = $results_login['a_id'];
                $_SESSION['satta_matka_admin_type'] = $results_login['user_type'];
                $result["status"] = 1;

                return $result;
            }
            else
            {
                return false;
            }

        } catch (PDOException $e) {
            $result = array("status" => '0', "error" => $e->getMessage());
            return $result;
        }
    }


}