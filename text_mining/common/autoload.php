<?php

error_reporting(0);

$root_directory = __DIR__."/../";

define("ROOT_DIRECTORY", $root_directory);
define("DEVELOPMENT_ENVIRONMENT" , true);
define("EMAIL" , "");

/*function autoload_library($class_name){
    //require_once ROOT_DIRECTORY."library/".$class_name.".php";
    $file = ROOT_DIRECTORY."library/".$class_name.".php";
  if ( ! file_exists($file))
    {
        return FALSE;
    }
    require_once $file;
}
spl_autoload_register('autoload_library');*/


require_once ROOT_DIRECTORY."library/commonUtility.php";
require_once ROOT_DIRECTORY."library/DB_CONN.php";
require_once ROOT_DIRECTORY."library/desicionUtility.php";
require_once ROOT_DIRECTORY."library/Node.php";
require_once ROOT_DIRECTORY."library/Tree.php";
require_once ROOT_DIRECTORY."library/DecisionTree.php";

function setReporting() {

    if (DEVELOPMENT_ENVIRONMENT == true) {
        error_reporting(E_ALL);
        ini_set('display_errors','On');
    } else {
        error_reporting(E_ALL);
        ini_set('display_errors','Off');
        ini_set('log_errors', 'On');
        ini_set('error_log', ROOT.DS.'lm/tmp'.DS.'logs'.DS.'error.log');
    }
}
setReporting();
?>
