<!-- jQuery -->
<!-- Bootstrap Core JavaScript -->
<!--<script src="asset/js/jquery.js"></script>-->
<script src="asset/js/bootstrap.min.js"></script>
<script src="asset/js/jquery.dataTables.min.js"></script>
<script src="asset/js/jquery.timepicker.js"></script>

<script>

    $( document ).ready(function() {
       // console.log( "ready!" );
        $("#result_date").datepicker().datepicker("setDate", new Date());
        $("#market_result").mask("999-99-999");
    });
    /*$(function ()
     {
     $("#result_date").datepicker({"dateFormat": "dd/mm/yy"});
     });*/

</script>
<!-- Menu Toggle Script -->
<script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

<script>
    $("#menu-toggle_side_br").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
</script>

<script>
    $(document).ready(function(){
        $('#myTable').DataTable();
        $('#myTableKeyword').DataTable();
    });
</script>

<?php
if(basename($_SERVER['PHP_SELF']) == "disease_risk_factor.php")
{
    echo '<script>

        $("#wrapper").addClass("toggled");

</script>';
}
?>

<script>
    $(document).ready(function () {
        // Listen for resize changes
        window.addEventListener("resize", function() {
            setHeader();
        }, false);
        // Listen for orientation changes
        setHeader();

    });

    function setHeader()
    {
        if($(window).width() > 1000)
        {
           // console.log($(window).width());
            $('#togle').hide();

        }else{
            $('#togle').show();
        }
       // console.log($(window).width());
    }
</script>



<!--TimePicker Start time-->
<script>
    $('#start_time').timepicker();
</script>

<!--TimePicker End time-->
<script>
    $('#end_time').timepicker();
</script>
