<?php
$obj_category_utility = new categoryUtility();

/*Get All admin Detasils for display table*/
$a_category_list = $obj_category_utility->getCategoryList();
?>
<div class="row">


    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">

            <h5 class="form_title">Category List</h5>

            <div class="col-md-12">
                <div class="col-md-8">
                    <select class="form-control" id="cat_id_new" name="cat_id_new">
                        <option value="0">Select Category</option>
                        <?php
                        foreach ($a_category_list["data"] AS $key => $value) {
                            echo '<option value="' . $value["id_cat"] . '">' . $value["cat_name"] . '</option>';

                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <input type="button" onclick="get_keyword_list_by_id();" class="btn btn-info" value="Assign Now">
                </div>
            </div>
            <br><br>


            <h5 class="form_title">Keyword List</h5>

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

    function get_keyword_list_by_id() {
        var cat_id = $('#cat_id_new').val();
        if (cat_id == '' || cat_id == 0) {
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
                    $('#myModal_new').modal('show');
                    set_keyword_data(data["data"], data["assign_data"]["data"]);
                    $('#assign_cat_id').val(cat_id);
                }
                else if (data["status"] == 2) {
                    return false;
                }
            },
            error: function (jqXHR, exception) {

            },

        });
    }

    function set_keyword_data(data, assign_data) {
        var UI = '';
        var assign_data_arr = [];
        $.each(assign_data, function (index, value) {
            assign_data_arr.push(value["key_id"]);
        });

        $.each(data, function (index, value) {
            UI += '<div class="col-md-4">';

            if ($.inArray(value["id_key"], assign_data_arr) != -1) {
                UI += '<input checked name="checkbox_data" class="checkbox_data" type="checkbox" value="' + value["id_key"] + '" >&nbsp;&nbsp;&nbsp;';
            } else {
                UI += '<input name="checkbox_data" class="checkbox_data" type="checkbox" value="' + value["id_key"] + '" >&nbsp;&nbsp;&nbsp;';
            }

            UI += '<span>' + value["keyword"] + '</span>' +
                '</div>';
        });
        $('#display_keyword_data').html(UI);
    }

    function update_assign_keyword() {

        var api_data = {};
        var checkboxes = document.getElementsByName('checkbox_data');
        var counter = 1;
        for (var i = 0, n = checkboxes.length; i < n; i++) {
            if (checkboxes[i].checked) {
                api_data['checkbox_' + counter] = checkboxes[i].value;
                counter++;
            }
        }
        api_data["assign_cat_id"] = $('#assign_cat_id').val();
        api_data['length'] = counter - 1;
        api_data['action'] = 'update_assign_keyword';
        $.ajax({
            type: 'POST',
            url: 'api/keyword_api.php',
            data: api_data,
            dataType: 'json',
            success: function (data) {
                if (data["remove_data"]["status"] == "1" && data["add_data"]["status"] == "1") {
                    alert("Assign Data Successfully");
                    location.reload(true);
                }
            },
            error: function (jqXHR, exception) {

            },

        });
    }

</script>
<!--Keyword Modal -->


<!--<div id="myModal_new" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <span id="display_keyword_data">

            </span>
        </div>
    </div>
</div>-->

<div class="modal fade" id="myModal_new" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Quote</h4>
            </div>
            <div class="modal-body" style="height:150px">
                <input type="hidden" id="assign_cat_id" name="assign_cat_id">
                <div id="display_keyword_data">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-default" onclick="update_assign_keyword();">Save</button>
            </div>
        </div>
    </div>
</div>