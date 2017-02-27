<?php
$ob_category_utility = new categoryUtility();

/*Get All admin Detasils for display table*/
$a_category_list = $ob_category_utility->getCategoryList();

if (isset($_POST['submit'])) {

    if (isset($_POST['submit']) && $_POST['submit'] == 'ADD') {
            $result = $ob_category_utility->addCategoryName();
            if ($result["status"] == 1) {
                 echo "<script>location.href='category.php'</script>";
            }
    } else if (isset($_POST['submit']) && $_POST['submit'] == 'UPDATE') {
        $result = $ob_category_utility->editCategoryName();

        if ($result["status"] == 1) {
            echo "<script>location.href='category.php'</script>";
        }
    }
}

if (isset($_REQUEST)) {
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete') {
        $result = $ob_category_utility->removeCategoryNameById($_REQUEST['id']);
        if ($result["status"] == 1) {
            echo "<script>location.href='category.php'</script>";

        }
    }
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') {
        $data = $ob_category_utility->getCategoryNameById($_REQUEST['id']);
        $data = $data["data"][0];

    }
}


?>

<div class="row">
    <!--Main Title Div Start -->
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <h5 class="form_title">Add New Admin</h5>
    </div>
    <!--Main Title Div End-->
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="form_border">
            <div class="row">
                <form role="form" method="post" action="" >

                    <div class="col-lg-4 col-md-3 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label for="email">Category Name</label>
                            <input type="hidden" id="cat_id" name="cat_id" value="<?php if (isset($data['id_cat'])) {
                                echo $data['id_cat'];
                            } ?>">
                            <input type="text" class="form-control" name="cat_name" id="cat_name"
                                   placeholder="Enter Category Name"
                                   value="<?php if (isset($data['cat_name'])) {
                                       echo $data['cat_name'];
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
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php

                foreach ($a_category_list["data"] as $key => $value) {
                    echo '<tr>

                                <td>' . $value['id_cat'] . ' </td>
                                <td>' . $value['cat_name'] . '</td>
                                <td>
                                    <a href="category.php?id=' . $value["id_cat"] . '&action=edit" class="on-default remove-row"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a onclick="confirm_delete(\'' . $value["id_cat"] . '\');"  class="on-default remove-row"><i class="glyphicon glyphicon-trash"></i></a>
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
            window.location.href = "category.php?id=" + id + "&action=delete";
        } else {
            return false;
        }
    }

</script>