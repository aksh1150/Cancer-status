<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'common/autoload.php';
//require_once 'vendor/autoload.php';
use Neoxygen\NeoClient\ClientBuilder;

/*Localhost*/
$connUrl = parse_url('http://localhost:7474/db/data/');
//$connUrl = parse_url('http://192.168.2.7:7474/db/data/');
$user = 'neo4j';
$pwd = 'admin@123';


/*$client = ClientBuilder::create()
    ->addConnection('default', $connUrl['scheme'], $connUrl['host'], $connUrl['port'], true, $user, $pwd)
    ->setAutoFormatResponse(true)
    ->build();*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Data Mining</title>

    <!-- Bootstrap -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">

    <!--<script src="//code.jquery.com/jquery-1.10.2.js"></script>-->
    <script src="//code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>




    <![endif]-->

    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment-with-locales.min.js"></script>
    <script type="text/javascript"
            src=" https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.4.1/moment-timezone-with-data-2010-2020.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load("current", {packages: ['corechart']});
        //google.charts.setOnLoadCallback(drawChart);
    </script>


    <!--Country Chart JS and css-->

    <link href="assets/map/jqvmap-master/dist/jqvmap.min.css" rel="stylesheet">
    <script src="assets/map/jqvmap-master/dist/jquery.vmap.js"></script>
    <script src="assets/map/jqvmap-master/dist/maps/jquery.vmap.world.js" charset="utf-8"></script>
    <script src="assets/map/jqvmap-master/dist/maps/jquery.vmap.canada.js" charset="utf-8"></script>
    <script src="assets/map/jqvmap-master/dist/maps/jquery.vmap.usa.js" charset="utf-8"></script>
    <script src="assets/map/jqvmap-master/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="http://d3js.org/d3.v3.min.js"></script>
    <script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
</head>
<style>

    #vmap {
        width: 100%;
        height: 100%;
        background-color: #333;
        -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    .jqvmap-region {
        cursor: default !important;
    }
    .cancer-page
    {
        font-size: 20px;
        font-family: cambria;
        font-weight: 900;
        text-align: center;
    }
    .lbl-color
    {
        color: #4d6fff;
    }
    .btnn-width
    {
        width: 100%;
    }
    .colowhite
    {
        color: white;
        font-family: cambria;
    }
    .colowhite:hover
    {
        color: #f58025;
    }
    .colowhitetitile
    {
        color: #f58025;
        font-family: cambria;
        font-size: 20px;
        font-weight: 800;
    }
    .search_panel
    {
        text-align: center;
        padding: 13px;
        background-color: rgba(20, 39, 72, 0.57);
    }

</style>
<body style="background-color: #0f3f62">
<div class="container">
<div class="row">
    <nav class="navbar navbar-inverse" style="margin-bottom: 2px;background-color: rgba(69, 22, 22, 0.54);">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <img src="assets/earth.gif" style="width: 25px;margin-top: 13px">
                <a class="navbar-brand" href="#" style="color: orange; font-family: cambria; font-weight: 700;">Data Mining</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="login.php">Home</a></li>
                    <li><a href="cancer-status.php">Check Cancer Status</a></li>
                   <!-- 
                    <li><a target="_blank" href="library/naive_bayes_algorithm/example.php">Navis Bayes</a></li>
                    <li><a target="_blank" href="library/ID3-PHP-master/desc_tree.php">Decision Tree</a></li>-->
                    <?php
                    if(isset($_SESSION["text_mining_current_login_user"]))
                    {
                        echo '<li><a  href="logout.php">Logout</a></li>';
                    }
                    ?>
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>


</div>
</div>