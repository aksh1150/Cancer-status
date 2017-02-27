<?php
include_once 'common/autoload.php';
$url = urldecode($_REQUEST["url"]);
$cat_id = urldecode($_REQUEST["cat_id"]);
$url_id = urldecode($_REQUEST["url_id"]);

if (isset($url) && isset($cat_id) && isset($url_id)) {
    ?>
    <head>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.0/jquery.min.js"></script>
        <div style="text-align: center;height: auto">
            <img id="loader"  src="asset/img/MnyxU.gif">
        </div>
        <script>
            $(window).load(function() {
                console.log("Called");
                $('#loader').show();
            });
        </script>
    </head>
    <?php

    $obj_link_utility = new urlUtility();
    $obj_xdom_utility = new xdomUtility();
    $obj_keyword_utility = new keywordUtility();
    $obj_crawl_utility = new crawlUtility();

    $link_data = $obj_link_utility->getUrlById($url_id);

    $keyword_list = $obj_keyword_utility->getAssignDataByCatId($cat_id);

    //print_r($link_data);

    $arr = array();
    foreach ($keyword_list["data"] AS $key => $val) {
        $arr[$val["key_id"]] = $val["keyword_name"];
    }

    //$arr = array("advance idea" , "mobile development" );

    $data = $obj_xdom_utility->getWordPharseArr($arr, 2, $url);

    $info["cat_id"] = $cat_id;
    $info["link_id"] = $url_id;
    $info["crawl_arr"] = $data["searching_data"];

    if ($link_data["data"][0]["link_used"] == 0) {
        $result["insert_data"] = $obj_crawl_utility->insertCrawlData($info);
        $result["update_link_status"] = $obj_crawl_utility->updateLinkUseStatus($url_id);
    } else {
        $result["update_data"] = $obj_crawl_utility->updateCrawlData($info);
    }

    echo "<pre>";
    //print_r($data);
    //print_r($result);

    echo "</pre>";
    //
    //
    echo "<script>alert('Crawl Data Successfully');</script>";
    echo "<script>window.close();</script>";


} else {
    echo "Oppppp ! No Data Found";
}