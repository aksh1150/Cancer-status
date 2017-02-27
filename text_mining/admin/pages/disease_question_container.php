<?php
$ob_question_utility = new questionUtility();
$ob_category_utility = new dieaseUtility();

/*Get All admin Detasils for display table*/
$a_question_list = $ob_question_utility->getQuestionData();

/*Get All admin Detasils for display table*/
$a_disease_list = $ob_category_utility->getDiseaseList();

if (isset($_POST['submit'])) {

    if (isset($_POST['submit']) && $_POST['submit'] == 'ADD') {
        $result = $ob_question_utility->addQuestionData();
        if ($result["status"] == 1) {
            echo "<script>location.href='disease_question.php'</script>";
        }
    } else if (isset($_POST['submit']) && $_POST['submit'] == 'UPDATE') {
        $result = $ob_question_utility->editQuestionData();
        if ($result["status"] == 1) {
            echo "<script>location.href='disease_question.php'</script>";
        }
    }
}

if (isset($_REQUEST)) {
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete') {
        $result = $ob_question_utility->removeQuestionDataById($_REQUEST['id']);
        if ($result["status"] == 1) {
            echo "<script>location.href='disease_question.php'</script>";

        }
    }
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') {
        $data = $ob_question_utility->getQuestionDataById($_REQUEST['id']);
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
                <form role="form" method="post" action="">

                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <div class="col-lg-3 col-md-3">
                            <label for="email">Question</label>
                            <input type="hidden" id="question_id" name="question_id"
                                   value="<?php if (isset($data['question_id'])) {
                                       echo $data['question_id'];
                                   } ?>">
                            <input type="text" class="form-control" name="question" id="question"
                                   value="<?php if (isset($data['question'])) {
                                       echo $data['question'];
                                   } ?>"
                                   placeholder="Enter Question">
                        </div>

                        <div class="col-lg-3 col-md-3">
                            <label for="email"> Answer</label>
                            <?php
                            if (isset($data['answer'])) {
                                $data = json_decode($data["answer"]);
                                foreach ($data AS $key => $value) {
                                    echo '<input type="text" class="form-control" name="ans[]"
                                       placeholder="Enter Answer" value="' . $value . '">';
                                }
                            } else {
                                ?>
                                <input type="text" class="form-control" name="ans[]"
                                       placeholder="Enter Answer">
                                <?php
                            }
                            ?>

                            <span id="display_ans_ui"></span>
                        </div>
                        <div class="col-lg-1 col-md-1">
                            <label for="email">AddAns</label>
                            <button type="button" class="form-control" onclick="add_ans_row();"><i
                                    class="glyphicon glyphicon-plus"></i></button>

                        </div>
                        <div class="col-lg-5 col-md-5">

                            <div class="col-lg-6 col-md-6">
                                <label for="email">Disease</label>
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
                            <div class="col-lg-3 col-md-3">
                                <label for="email">Weight</label>
                                <input id="weight" class="form-control" type="text" placeholder="weight">
                            </div>
                            <div class="col-lg-3 col-md-3">
                                <label for="email">Action</label>
                                <input onclick="add_temp_disease_weight();" class="btn btn-info" type="button"
                                       value="+ Weight">
                            </div>
                            <table class="table">
                                <tbody id="disease_weight_ui">

                                </tbody>
                            </table>
                        </div>

                    </div>


                    <div class="col-lg-1 col-md-1 col-xs-12 col-sm-12" style="text-align: center">
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
                    <th>Question</th>
                    <th>Answer</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($a_question_list["data"] as $key => $value) {
                    $value['answer'] = implode("|", json_decode($value['answer']));
                    echo '<tr>
                            <td>' . $value['question_id'] . ' </td>
                            <td>' . $value['question'] . ' </td>
                            <td>' . $value['answer'] . '</td>
                            <td>
                                <a href="disease_question.php?id=' . $value["question_id"] . '&action=edit" class="on-default remove-row"><i class="glyphicon glyphicon-pencil"></i></a>
                                <a onclick="confirm_delete(\'' . $value["question_id"] . '\');"  class="on-default remove-row"><i class="glyphicon glyphicon-trash"></i></a>
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

    var temp_array = [];

    function confirm_delete(id) {
        var con = confirm('Are you sure Want To Delete This Data?');
        if (con) {
            window.location.href = "disease_question.php?id=" + id + "&action=delete";
        } else {
            return false;
        }
    }

    function add_ans_row() {
        var UI = '<input type="text" class="form-control" name="ans[]" placeholder="Enter Answer">';
        $('#display_ans_ui').append(UI);
    }


    function add_temp_disease_weight() {
        var weight = $.trim($('#weight').val());
        var disease_id = $('#diease_id').val()
        var disease_name = $("#diease_id option:selected").text();
        var res = $.isNumeric(weight);
        if($.inArray(disease_id, temp_array) == -1) {
            temp_array.push(disease_id);
            if (!res) {
                alert("Weight Number Must Be Numeric");
                return false;
            }
            var UI = '<tr style="align: center">' +
                '<td style="text-align: center">' + disease_id + '</td>' +
                '<td style="text-align: center">' + disease_name + '</td>' +
                '<td style="text-align: center">' + weight + '</td>' +
                '<td style="text-align: center"><button class="btn btn-danger btn-xs" onclick="remove_temp_diease_weight(' + disease_id + ',this)" type="button"><i class="glyphicon glyphicon-trash"></i></button></td>' +
                '</tr>';
            $('#disease_weight_ui').append(UI);
            $('#weight').val("");
        }else{
            alert("Disease already eixst");
            return false;
        }
    }

    function remove_temp_diease_weight(disease_id, this_1) {
        var arr = [];
        $.each(temp_array, function (index, value) {
            if (disease_id != value) {
                arr.push(value);
            }
        });
        temp_array = arr;
        console.log(JSON.stringify(temp_array));
        $(this_1).closest('tr').remove();
    }


</script>