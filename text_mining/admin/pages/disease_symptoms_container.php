<?php
$ob_disease_symptoms_utility = new diseaseSymptomsUtility();
$ob_disease_utility = new dieaseUtility();

/*Get All admin Detasils for display table*/
$a_disease_list = $ob_disease_utility->getDiseaseList();
$a_disease_symptoms_list = $ob_disease_symptoms_utility->getDiseaseSymptomsList();

if (isset($_POST['submit'])) {

    if (isset($_POST['submit']) && $_POST['submit'] == 'ADD') {
        $result = $ob_disease_symptoms_utility->addDiseaseSymptoms();
        if ($result["status"] == 1) {
            echo "<script>location.href='disease_symptoms.php'</script>";
        }
    } else if (isset($_POST['submit']) && $_POST['submit'] == 'UPDATE') {
        $result = $ob_disease_symptoms_utility->editDiseaseSymptoms();
        if ($result["status"] == 1) {
            echo "<script>location.href='disease_symptoms.php'</script>";
        }
    }
}

if (isset($_REQUEST)) {
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete') {
        $result = $ob_disease_symptoms_utility->removeDiseaseSymptomsById($_REQUEST['id']);
        if ($result["status"] == 1) {
            echo "<script>location.href='disease_symptoms.php'</script>";

        }
    }
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') {
        $data = $ob_disease_symptoms_utility->getDiseaseSymptomsById($_REQUEST['id']);
        $data = $data["data"][0];

    }
}


?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <h5 class="form_title">Add New Admin</h5>
    </div>
    <!--Main Title Div End-->
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="form_border">
            <div class="row">
                <form role="form" method="post" action="">
                    <input type="hidden" id="ds_id" name="ds_id" value="<?php if (isset($data['ds_id'])) {
                        echo $data['ds_id'];
                    } ?>">
                    <div class="col-lg-4 col-md-3 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label for="email">Select Disease</label>
                            <select class="form-control" id="diease_id" name="diease_id">
                                <?php
                                foreach ($a_disease_list["data"] AS $key => $value) {
                                    if (isset($data["diease_id"])) {
                                        if ($data["diease_id"] == $value["diease_id"]) {
                                            echo '<option selected value="' . $value["diease_id"] . '">' . $value["diease_name"] . '</option>';
                                        } else {
                                            echo '<option value="' . $value["diease_id"] . '">' . $value["diease_name"] . '</option>';
                                        }
                                    } else {
                                        echo '<option value="' . $value["diease_id"] . '">' . $value["diease_name"] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-3 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label for="email">Symptoms</label>

                            <input type="text" class="form-control" name="ds_text" id="ds_text"
                                   placeholder="Enter Symptoms"
                                   value="<?php if (isset($data['ds_text'])) {
                                       echo $data['ds_text'];
                                   } ?>">
                        </div>
                    </div>


                    <div class="col-lg-4 col-md-3 col-xs-12 col-sm-12" style="text-align: center">
                        <label for="email">Action</label>
                        <?php
                        if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') {
                            ?>
                            <div class="uk-width-medium-1-1" style="text-align: center">
                                <input class="btn btn-info" type="submit" name="submit" value="UPDATE">
                            </div>

                            <?php
                        } else {
                            ?>
                            <div class="uk-width-medium-1-1" style="text-align: center">
                                <input class="btn btn-info" type="submit" name="submit" value="ADD">
                            </div>

                            <?php
                        }
                        ?>

                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <h5 class="form_title">Add New Admin</h5>
    </div>
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="table-responsive">
            <table class="table" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Disease</th>
                    <th>Symptoms</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php

                foreach ($a_disease_symptoms_list["data"] as $key => $value) {
                    echo '<tr>
                                <td>' . $value['ds_id'] . ' </td>
                                <td>' . $value['diease_name'] . '</td>
                                <td>' . $value['ds_text'] . ' </td>
                                <td>
                                    <a href="disease_symptoms.php?id=' . $value["ds_id"] . '&action=edit" class="on-default remove-row"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a onclick="confirm_delete(\'' . $value["ds_id"] . '\');"  class="on-default remove-row"><i class="glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>';

                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirm_delete(id) {
        var con = confirm('Are you sure Want To Delete This Data?');
        if (con) {
            window.location.href = "disease_symptoms.php?id=" + id + "&action=delete";
        } else {
            return false;
        }
    }

</script>