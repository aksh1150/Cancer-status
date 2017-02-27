<?php
$obj_common_utility = new commonUtility();
if (isset($_REQUEST["id"])) {
    $id = $_REQUEST["id"];
    $a_user_details = $obj_common_utility->getUserDieaseData($id);
    $data = $a_user_details["data"];
}
?>

<?php
if (isset($data) && sizeof($data) > 0) {
    ?>
    <div class="container" style="background-color: rgb(212, 234, 254);">
        <hr style="border: 1px solid grey">
        <div class="row">
            <div class="col-md-12">
                <p class="cancer-page">Your Details</p>
            </div>
        </div>
        <hr style="border: 1px solid grey">
        <!--Basic Question Start-->
        <div class="row">
            <div class="form-group">
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="col-md-3 control-label lbl-color" for="textinput">Name</label>
                            <label class="col-md-1 control-label" for="textinput">::</label>
                            <label class="col-md-8 control-label" for="textinput"><?php echo $data["name"]; ?></label>
                        </div>

                        <div class="col-md-12">
                            <label class="col-md-3 control-label lbl-color" for="textinput">Age</label>
                            <label class="col-md-1 control-label" for="textinput">::</label>
                            <label class="col-md-8 control-label" for="textinput"><?php echo $data["age"]; ?></label>
                        </div>

                        <div class="col-md-12">
                            <label class="col-md-3 control-label lbl-color" for="textinput">Gender</label>
                            <label class="col-md-1 control-label" for="textinput">::</label>
                            <label class="col-md-8 control-label" for="textinput"><?php echo $data["gender"]; ?></label>
                        </div>

                        <div class="col-md-12">
                            <label class="col-md-3 control-label lbl-color" for="textinput">Living Area</label>
                            <label class="col-md-1 control-label" for="textinput">::</label>
                            <label class="col-md-8 control-label"
                                   for="textinput"><?php echo $data["living_area"]; ?></label>
                        </div>

                        <div class="col-md-12">
                            <label class="col-md-3 control-label lbl-color" for="textinput">Marital Status</label>
                            <label class="col-md-1 control-label" for="textinput">::</label>
                            <label class="col-md-8 control-label"
                                   for="textinput"><?php echo $data["marital_status"]; ?></label>
                        </div>

                        <div class="col-md-12">
                            <label class="col-md-3 control-label lbl-color" for="textinput">Education</label>
                            <label class="col-md-1 control-label" for="textinput">::</label>
                            <label class="col-md-8 control-label"
                                   for="textinput"><?php echo $data["education"]; ?></label>
                        </div>

                        <div class="col-md-12">
                            <label class="col-md-3 control-label lbl-color" for="textinput">No Of Child</label>
                            <label class="col-md-1 control-label" for="textinput">::</label>
                            <label class="col-md-8 control-label"
                                   for="textinput"><?php echo $data["no_of_child"]; ?></label>
                        </div>

                        <div class="col-md-12">
                            <label class="col-md-3 control-label lbl-color" for="textinput">Date</label>
                            <label class="col-md-1 control-label" for="textinput">::</label>
                            <label class="col-md-8 control-label"
                                   for="textinput"><?php $data["created_at"] = date("g:i a F j, Y ", strtotime($data["created_at"]));
                                echo $data["created_at"]; ?>
                            </label>
                        </div>

                    </div>

                    <hr style="border: 1px solid lightblue">

                    <?php
                    foreach ($data["question_list"] AS $key => $value) {
                        echo '<div class="col-md-12">
                            <label class="col-md-8 control-label lbl-color" for="textinput">' . $value["que"] . '</label>
                            <label class="col-md-1 control-label" for="textinput">::</label>
                            <label class="col-md-3 control-label" for="textinput">' . $value["ans"] . '</label>
                        </div>';
                    }
                    ?>


                </div>
                <div class="col-md-3">
                </div>
            </div>
        </div>
        <!--Basic Question End-->
        <hr style="border: 1px solid grey">

    </div>
    <?php
} else {
    ?>
    <div class="container" style="background-color: rgb(212, 234, 254);">
        <hr style="border: 1px solid grey">
        <div class="row">
            <div class="col-md-12">
                <p class="cancer-page">Ooppps !! No Data Found</p>
            </div>
        </div>

    </div>
    <?php
}
?>