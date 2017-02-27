<?php
$obj_keyword_utility = new keywordUtility();
$obj_category_utility = new categoryUtility();

/*Get All admin Detasils for display table*/
$a_keyword_list = $obj_keyword_utility->getKeywordList();
$a_category_list = $obj_category_utility->getCategoryList();

if (isset($_POST['submit'])) {

    if (isset($_POST['submit']) && $_POST['submit'] == 'ADD') {

        $result = $obj_keyword_utility->addKeywordName();
        if ($result["status"] == 1) {
            echo "<script>location.href='keyword.php'</script>";
        }

    } else if (isset($_POST['submit']) && $_POST['submit'] == 'UPDATE') {
        $result = $obj_keyword_utility->editKeywordName();
        if ($result["status"] == 1) {
            echo "<script>location.href='keyword.php'</script>";
        }
    }
}

if (isset($_REQUEST)) {
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete') {
        $result = $obj_keyword_utility->removeKeywordNameById($_REQUEST['id']);
        if ($result["status"] == 1) {
            echo "<script>location.href='keyword.php'</script>";

        }
    }
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') {
        $data = $obj_keyword_utility->getKeywordNameById($_REQUEST['id']);
        $data = $data["data"][0];

    }
}


?>

<div class="row">
    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
    <!--Main Title Div Start -->
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <h5 class="form_title">Add New Admin</h5>
    </div>
    <!--Main Title Div End-->
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="form_border">
            <div class="row">
                <form role="form" method="post" action="" >
                    <input type="hidden" id="key_id" name="key_id" value="<?php if (isset($data['id_key'])) {
                        echo $data['id_key'];
                    } ?>">
                    <div class="col-lg-4 col-md-3 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label for="email">Select Category</label>
                            <select class="form-control" id="cat_id" name="cat_id">
                                <?php
                                foreach($a_category_list["data"] AS $key => $value)
                                {
                                    if(isset($data["cat_id"]))
                                    {
                                        if($data["cat_id"] == $value["id_cat"]) {
                                            echo '<option selected value="' . $value["id_cat"] . '">' . $value["cat_name"] . '</option>';
                                        }else{
                                            echo '<option value="' . $value["id_cat"] . '">' . $value["cat_name"] . '</option>';
                                        }
                                    }else {
                                        echo '<option value="' . $value["id_cat"] . '">' . $value["cat_name"] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-3 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label for="email">Keyword Name</label>

                            <input type="text" class="form-control" name="keyword" id="keyword"
                                   placeholder="Enter Keyword Name"
                                   value="<?php if (isset($data['keyword'])) {
                                       echo $data['keyword'];
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
                    <th>Keyword Name</th>
                    <th>Category</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php

                foreach ($a_keyword_list["data"] as $key => $value) {
                    echo '<tr>
                                <td>' . $value['id_key'] . ' </td>
                                <td>' . $value['keyword'] . '</td>
                                <td>' . $value['category_name'] . ' </td>
                                <td>
                                    <a href="keyword.php?id=' . $value["id_key"] . '&action=edit" class="on-default remove-row"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a onclick="confirm_delete(\'' . $value["id_key"] . '\');"  class="on-default remove-row"><i class="glyphicon glyphicon-trash"></i></a>
                                </td>
                            </tr>';

                }
                ?>

                </tbody>
            </table>
        </div>
    </div>
    </div>

    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

            <h5 class="form_title">Category List</h5>

        <select class="form-control" id="cat_id_new" name="cat_id_new" onchange="get_keyword_list_by_id();">
            <option value="0">Select Category</option>
            <?php
            foreach($a_category_list["data"] AS $key => $value)
            {
                    echo '<option value="' . $value["id_cat"] . '">' . $value["cat_name"] . '</option>';

            }
            ?>
        </select>

            <h5 class="form_title">Keyword List</h5>

        <table class="table" id="myTableKeyword">
            <thead>
            <th>id</th>
            <th>Keyword</th>
            </thead>
            <tbody id="display_keyword_data">

            </tbody>
        </table>
        </div>
        </div>

</div>

<script>
    function confirm_delete(id) {
        var con = confirm('Are you sure Want To Delete This Data?');
        if (con) {
            window.location.href = "keyword.php?id=" + id + "&action=delete";
        } else {
            return false;
        }
    }

    function get_keyword_list_by_id()
    {
        var cat_id = $('#cat_id_new').val();
        if(cat_id == '' || cat_id == 0)
        {
            return false;
        }
        var api_data = {"action": "get_keyword_list_by_id", "cat_id": cat_id};
        $.ajax({
            type: 'POST',
            url: 'api/keyword_api.php',
            data: api_data,
            dataType: 'json',
            success: function (data) {
                if (data["status"] == 1) {
                    set_keyword_data(data["data"]);
                }
                else if (data["status"] == 2) {
                    return false;
                }
            },
            error: function (jqXHR, exception) {

            },

        });
    }

    function set_keyword_data(data)
    {
        $('#myTableKeyword').DataTable().destroy();
        var UI = '';
        $.each(data, function (index, value) {
            UI += '<tr>' +
                    '<td>'+value["id_key"]+'</td>'+
                    '<td>'+value["keyword"]+'</td>'+
                '</tr>';
        });

        $('#display_keyword_data').html(UI);
        $('#myTableKeyword').DataTable();
    }

</script>