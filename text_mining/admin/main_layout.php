<!DOCTYPE html>
<html lang="en">
<head>
    <?php include_once($header); ?>
</head>

<body>

<div class="row" style="margin: 0px">
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 " id ="top_header" >
        <div class="col-md-6">

        </div>
        <div class="col-md-5">

        </div>
        <div class="col-md-1" style="padding: 5px;">
            <a href="logout.php" style="color: #080808;font-family: cambria;font-size: 16px;">Logout</a>
        </div>


    </div>
</div>

<div id="wrapper">

    <!-- Sidebar -->
    <?php include_once($side_bar); ?>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
        <div class="container-fluid">

            <div class="row">
                <div class="col-lg-12">
                    <a href="#menu-toggle" class="btn btn-info" id="menu-toggle">Menu</a>
                </div>
            </div>
            <!--Main_container-->
            <?php include_once($container); ?>
            <!--Main_container-->
        </div>
    </div>
    <!-- /#page-content-wrapper -->
</div>
<!-- /#wrapper -->

<!--footer start-->
<?php include_once($footer); ?>
<!--footer end-->

</body>

</html>
