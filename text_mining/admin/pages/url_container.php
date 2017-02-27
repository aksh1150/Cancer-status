<?php
$ob_url_utility = new urlUtility();

/*Get All admin Detasils for display table*/
$a_url_list = $ob_url_utility->getUrlList();


if (isset($_POST['submit'])) {

    if (isset($_POST['submit']) && $_POST['submit'] == 'ADD') {

        $result = $ob_url_utility->addLinkName();
        if ($result["status"] == 1) {
            echo "<script>location.href='url.php'</script>";
        }

    } else if (isset($_POST['submit']) && $_POST['submit'] == 'UPDATE') {
        $result = $ob_url_utility->editUrlName();

        if ($result["status"] == 1) {
            echo "<script>location.href='url.php'</script>";
        }
    }
}

if (isset($_REQUEST)) {
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'delete') {
        $result = $ob_url_utility->removeUrlNameById($_REQUEST['id']);
        if ($result["status"] == 1) {
            echo "<script>location.href='url.php'</script>";

        }
    }
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') {
        $data = $ob_url_utility->getUrlById($_REQUEST['id']);
        $data = $data["data"][0];

    }
}


?>

<div class="row">
    <!--Main Title Div Start -->
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <h5 class="form_title">Add URL</h5>
    </div>
    <!--Main Title Div End-->
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="form_border">
            <div class="row">
                <form role="form" method="post" action="" >

                    <div class="col-lg-4 col-md-3 col-xs-12 col-sm-12">
                        <div class="form-group">
                            <label for="email">URL</label>
                            <input type="hidden" id="link_id" name="link_id" value="<?php if (isset($data['id_link'])) {
                                echo $data['id_link'];
                            } ?>">
                            <input type="text" class="form-control" name="url" id="url"
                                   placeholder="Enter URL"
                                   value="<?php if (isset($data['url'])) {
                                       echo $data['url'];
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
                    <th>URL</th>
                    <th>Update At</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                <?php

                foreach ($a_url_list["data"] as $key => $value) {
                    if($value["update_at"] == '0000-00-00 00:00:00')
                    {
                        $value["update_at"] = '';
                    }else{
                        $value["update_at"] =  date("j/n/Y g:i A", strtotime($value["update_at"]));
                    }
                    echo '<tr>
                                <td>' . $value['id_link'] . ' </td>
                                <td>' . $value['url'] . '</td>
                                <td>' . $value['update_at'] . '</td>
                                <td>
                                    <a href="url.php?id=' . $value["id_link"] . '&action=edit" class="on-default remove-row"><i class="glyphicon glyphicon-pencil"></i></a>
                                    <a onclick="confirm_delete(\'' . $value["id_link"] . '\');"  class="on-default remove-row"><i class="glyphicon glyphicon-trash"></i></a>
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
            window.location.href = "url.php?id=" + id + "&action=delete";
        } else {
            return false;
        }
    }

</script>