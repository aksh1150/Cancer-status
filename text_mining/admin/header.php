<?php
session_start();
if(empty($_SESSION["login_admin_id"]) ||  empty($_SESSION["satta_matka_admin_type"]) )
{
    header("location:login.php");
    die();
}
include 'common/autoload.php';
?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<?php
function curPageName_1()
{
    return substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
}

$cur_page = curPageName_1();
?>

<title>Data Mining</title>
<!-- Bootstrap Core CSS -->
<script src="//code.jquery.com/jquery-1.10.2.js"></script>

<link href="asset/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom CSS -->
<link href="asset/css/simple-sidebar.css" rel="stylesheet">

<!--datatable https://datatables.net/-->
<link href="asset/css/jquery.dataTables.min.css" rel="stylesheet">

<!--http://jonthornton.github.io/jquery-timepicker/-->
<link href="asset/css/jquery.timepicker.css" rel="stylesheet">

<!--aii style shreet-->
<link href="asset/css/aii_style.css" rel="stylesheet">

<!--Date picker js and css start-->
<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script src="asset/js/adminUtility.js"></script>
<!--Date picker js and css End-->

<!--MASKED INPUT START-->
<script src="asset/js/jquery.inputmask.js"></script>
<script src="asset/js/jquery.maskedinput.min.js"></script>

<link rel="stylesheet" href="../bootstrap/css/jquery.minicolors.css">

<script src="../bootstrap/js/jquery.colorPicker.min.js"></script>
<script src="../bootstrap/js/jquery.minicolors.min.js"></script>

<script>
    $(document).ready( function() {
        $('.demo').each( function() {
            //
            // Dear reader, it's actually very easy to initialize MiniColors. For example:
            //
            //  $(selector).minicolors();
            //
            // The way I've done it below is just for the demo, so don't get confused
            // by it. Also, data- attributes aren't supported at this time...they're
            // only used for this demo.
            //
            $(this).minicolors({
                control: $(this).attr('data-control') || 'hue',
                defaultValue: $(this).attr('data-defaultValue') || '',
                format: $(this).attr('data-format') || 'hex',
                keywords: $(this).attr('data-keywords') || '',
                inline: $(this).attr('data-inline') === 'true',
                letterCase: $(this).attr('data-letterCase') || 'lowercase',
                opacity: $(this).attr('data-opacity'),
                position: $(this).attr('data-position') || 'bottom left',
                swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
                change: function(value, opacity) {
                    if( !value ) return;
                    if( opacity ) value += ', ' + opacity;
                    if( typeof console === 'object' ) {
                        //console.log(value);
                    }
                },
                theme: 'bootstrap'
            });

        });

    });
</script>
<!--MASKED INPUT END-->


