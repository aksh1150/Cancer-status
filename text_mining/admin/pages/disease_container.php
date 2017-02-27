<?php
$ob_category_utility = new dieaseUtility();

/*Get All admin Detasils for display table*/
$a_disease_list = $ob_category_utility->getDiseaseList();

if (isset($_POST['submit'])) {

    if (isset($_POST['submit']) && $_POST['submit'] == 'ADD') {
        $result = $ob_category_utility->addDiseaseName();
        if ($result["status"] == 1) {
            echo "<script>location.href='disease.php'</script>";
        }
    } else if (isset($_POST['submit']) && $_POST['submit'] == 'UPDATE') {
        $result = $ob_category_utility->editDiseaseName();
        if ($result["status"] == 1) {
            echo "<script>location.href='disease.php'</script>";
        }
    }
}

if (isset($_REQUEST)) {
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete') {
        $result = $ob_category_utility->removeDiseaseNameById($_REQUEST['id']);
        if ($result["status"] == 1) {
            echo "<script>location.href='disease.php'</script>";

        }
    }
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') {
        $data = $ob_category_utility->getDiseaseNameById($_REQUEST['id']);
        $data = $data["data"][0];

    }
}


?>

<div class="row">
    <!--Main Title Div Start -->
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <h5 class="form_title">Add Disease Data</h5>
    </div>
    <!--Main Title Div End-->
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="form_border">
            <div class="row">
                <form role="form" method="post" action="" >

                    <div class="col-lg-4 col-md-3 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label for="email">Disease Name</label>
                            <input type="hidden" id="diease_id" name="diease_id" value="<?php if (isset($data['diease_id'])) {
                                echo $data['diease_id'];
                            } ?>">
                            <input type="text" class="form-control" name="diease_name" id="diease_name"
                                   placeholder="Enter Disease Name"
                                   value="<?php if (isset($data['diease_name'])) {
                                       echo $data['diease_name'];
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
        <h5 class="form_title">Disease Data</h5>
    </div>
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="table-responsive">
            <table class="table" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Disease Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php

                foreach ($a_disease_list["data"] as $key => $value) {
                    echo '<tr>

                                <td>' . $value['diease_id'] . ' </td>
                                <td>' . $value['diease_name'] . '</td>
                                <td>
                                    <a href="disease.php?id=' . $value["diease_id"] . '&action=edit" class="on-default remove-row"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a onclick="confirm_delete(\'' . $value["diease_id"] . '\');"  class="on-default remove-row"><i class="glyphicon glyphicon-trash"></i></a>
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
            window.location.href = "disease.php?id=" + id + "&action=delete";
        } else {
            return false;
        }
    }

</script>