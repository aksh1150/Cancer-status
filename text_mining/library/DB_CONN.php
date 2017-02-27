<?php

class DB_CONN
{
   /*LOCALHOST*/
    private static $dsn         = 'mysql:host=localhost;dbname=aii_textmining';
    private static $user        = 'root';
    private static $password    = '';

    /*** Declare instance ***/
    private static $instance = NULL;
    public static function getInstance() {

        if (!self::$instance)
        {
            try {
                self::$instance = new PDO(self::$dsn, self::$user, self::$password);
                //self::$instance = new PDO("mysql:host=localhost;dbname=school_management_new", 'root', '');
                self::$instance->exec("SET NAME  'utf8'");
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch (PDOException $e) {
                print "Error!: " . $e->getMessage() . "<br/>";
                die();
            }

        }
        self::$instance->exec("SET CHARACTER SET utf8");

        return self::$instance;
    }
}

?>