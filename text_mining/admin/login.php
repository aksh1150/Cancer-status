<?php
//include_once('header.php');
session_start();
include_once('common/autoload.php');
$obj_loginUtility = new AdminUtility();

if (isset($_POST["submit"]) && $_POST["submit"] == "Login") {
    $result_login = $obj_loginUtility->admin_login();
    if ($result_login["status"] == 1) {
        echo "<script>location.href='disease_risk_factor.php'</script>";
    } else if ($result_login["status"] == 2) {
        //echo "Multiple User Found.";
        echo '<div  onclick="close_notification()" style="display: block;" class="uk-notify uk-notify-top-center notification_close"><div style="opacity: 1; margin-top: 0px; margin-bottom: 10px;" class="uk-notify-message"><a class="uk-close"></a><div>Multiple User Found</div></div></div>';
    } else if ($result_login["status"] == 0) {
        echo '<div  onclick="close_notification()" style="display: block;" class="uk-notify uk-notify-top-center notification_close"><div style="opacity: 1; margin-top: 0px; margin-bottom: 10px;" class="uk-notify-message uk-notify-message-danger"><a class="uk-close"></a><div><a href="#" class="notify-action"></a> Invalid email or password</div></div></div>';
    } else {
        echo '<div  onclick="close_notification()" style="display: block;" class="uk-notify uk-notify-top-center notification_close"><div style="opacity: 1; margin-top: 0px; margin-bottom: 10px;" class="uk-notify-message uk-notify-message-danger"><a class="uk-close"></a><div><a href="#" class="notify-action"></a> Invalid email or password</div></div></div>';
    }
}
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Main Title</title>
<!-- Bootstrap Core CSS -->
<link href="asset/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="asset/css/simple-sidebar.css" rel="stylesheet">

<!--datatable https://datatables.net/-->
<link href="asset/css/jquery.dataTables.min.css" rel="stylesheet">

<!--aii style shreet-->
<link href="asset/css/aii_style.css" rel="stylesheet">
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 col-md-offset-4">
            <div style="border: 1px solid; padding: 8px; border-radius: 15px; margin-top: 50%;">
                <h1 class="text-center login-title">Data Mining</h1>

                <div class="account-wall">
                    <form method="post">
                        <label>User Name</label>
                        <input type="text" class="form-control" placeholder="Email" id="a_email" name="a_email" required
                               autofocus>
                        <label>Password</label>
                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Password" required style="margin-bottom: 10px">
                        <input type="submit" class="btn btn-lg btn-primary btn-block" value="Login" name="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


