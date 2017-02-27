<?php
$obj_category_utility = new categoryUtility();
$obj_url_utility = new urlUtility();

$a_category_list = $obj_category_utility->getCategoryList();
$a_url_list = $obj_url_utility->getUrlList();
?>

<div class="row">
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <!--Main Title Div Start -->
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <h5 class="form_title">Add New Admin</h5>
        </div>
        <!--Main Title Div End-->
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <div class="form_border">
                <div class="row">
                    <form role="form" method="post" action="">
                        <input type="hidden" id="key_id" name="key_id" value="<?php if (isset($data['id_key'])) {
                            echo $data['id_key'];
                        } ?>">

                        <div class="col-lg-4 col-md-3 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label for="email">Select Category</label>
                                <select onchange="getPreviousCrawlData();" class="form-control" id="cat_id" name="cat_id">
                                    <option value="0">Select Category </option>
                                    <?php
                                    foreach ($a_category_list["data"] AS $key => $value) {

                                        echo '<option value="' . $value["id_cat"] . '">' . $value["cat_name"] . '</option>';

                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-3 col-xs-12 col-sm-12">
                            <div class="form-group">
                                <label for="email">URL</label>
                                <select onchange="getPreviousCrawlData();" class="form-control" id="url_id" name="url_id">
                                    <option value="0">Select Link </option>
                                    <?php
                                    foreach ($a_url_list["data"] AS $key => $value) {

                                        echo '<option value="' . $value["id_link"] . '">' . $value["url"] . '</option>';

                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <div class="col-lg-4 col-md-3 col-xs-12 col-sm-12" style="text-align: center">
                            <label for="email">Action</label>

                            <div class="uk-width-medium-1-1" style="text-align: center">
                                <input onclick="crawl_now();" class="btn btn-info" type="button" name="submit" value="Crawl Now">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
            <h5 class="form_title">List Of Previous Crawl Data</h5>
        <table class="table" id="myTableKeyword">
            <thead>
            <th>Key Id</th>
            <th>Keyword</th>
            <th>Count</th>
            </thead>
            <tbody id="display_keyword_data">

            </tbody>
        </table>
</div>
        </div>
</div>

<script>
    function crawl_now()
    {
        var cat_id  = $('#cat_id').val();
        var url_id  = $('#url_id').val();
        var url = $("#url_id option:selected").text();
        url = encodeURIComponent(url);
        if(cat_id == 0 || url_id == 0)
        {
            $('#display_keyword_data').html('');
            return false;
        }
        window.open("crawling.php?url="+url+"&cat_id="+cat_id+"&url_id="+url_id);

    }

    function getPreviousCrawlData()
    {
        var cat_id  = $('#cat_id').val();
        var url_id  = $('#url_id').val();

        if(cat_id == 0 || url_id == 0)
        {
            $('#display_keyword_data').html('');
            return false;
        }
        var api_data = {"action": "getPreviousCrawlData", "cat_id": cat_id ,url_id:url_id };
        $.ajax({
            type: 'POST',
            url: 'api/keyword_api.php',
            data: api_data,
            dataType: 'json',
            success: function (data) {
                if (data["status"] == 1 && data["data"][0]["link_used"] == 1) {
                    setCreawlData(data["result"]["data"]);
                }
                else if (data["status"] == 2) {
                    console.log("No Data Found")
                }
            },
            error: function (jqXHR, exception) {

            },

        });
    }

    function setCreawlData(data)
    {
        $('#myTableKeyword').DataTable().destroy();
        var UI = '';
        $.each(data, function (index, value) {
            UI += '<tr>' +
                '<td>'+value["key_id"]+'</td>'+
                '<td>'+value["keyword_name"]+'</td>'+
                '<td>'+value["count"]+'</td>'+
                '</tr>';
        });
        $('#display_keyword_data').html(UI);
        $('#myTableKeyword').DataTable();
    }
</script>