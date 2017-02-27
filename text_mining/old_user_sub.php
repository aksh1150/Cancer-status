<?php
$obj_common_utility = new commonUtility();
$user_id = $_SESSION["text_mining_current_login_user"];
$user_data = $obj_common_utility->getUserDataBYId($user_id);
?>

<div class="container" style="background-color: rgb(212, 234, 254);">
    <hr style="border: 1px solid grey">


    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-12">
                <p class="cancer-page">Your Disease Form</p>
            </div>
        </div>
        <hr style="border: 1px solid grey">

       <table class="table">
           <thead>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>View</th>
           </thead>
           <?php
           foreach($user_data["data"] AS $key => $value)
           {
               echo '<tr><td>'.$value["name"].'</td><td>'.$value["age"].'</td><td>'.$value["gender"].'</td><td><a href="user-report.php?id='.$value["user_id"].'">View Details</a></td></tr>';
           }
           ?>
       </table>
    </div>


</div>

<script>
    function display_cancer_patient_div() {
        var temp = $('#family_history_cancer').val();
        if (temp == 'Yes') {
            $('#cancer_patient_div').css("display", "inline");
        } else {
            $('#cancer_patient_div').css("display", "none");
        }
    }

    function display_syptomas() {
        var diease_id = $('#user_diease').val();
        if (diease_id != 0) {
            var data = disease_symptomas_data[diease_id];
            console.log(JSON.stringify(data));
            var UI = '';
            $.each(data["symptomas"], function (index, value) {
                UI += '<input type="checkbox" name="diease_symptomas[]" value="' + value["ds_id"] + '">' + value["ds_text"] + '<br>';
            });
        } else {
            var UI = '';
        }
        $('#symptomas_div').html(UI);
    }

    function dsiplay_disease_and_syptomas_div() {
        $('#diease_and_symptomas_div').css("display", "block");
    }

</script>