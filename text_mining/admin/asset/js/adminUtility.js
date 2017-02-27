function select_currentday_result() {
    var result_id = $('#market_id').val();
    var session_token = $('#session_token').val();
    var api_data = {"action": "get_current_day_result", "result_id": result_id, "session_token": session_token};

    $.ajax({
        type: 'POST',
        url: 'API/admin_api.php',
        data: api_data,
        dataType: 'json',
        success: function (data) {
            if (data["status"] == 2) {
                alert(data["message"]);
                return false;
            }
            else if (data["status"] == 1 && data["count"] == 1) {
                set_result_data(data["data"]);
                $('#add').css("display", "none");
                $('#update').css("display", "inline");
            } else if (data["count"] == 0) {
                $('#add').css("display", "inline");
                $('#update').css("display", "none");
            }
        },
        error: function (jqXHR, exception) {
        },
    });
}

function set_result_data(data) {
    $('#market_result').val(data[0]["market_result"]);
    $('#result_desc').val(data[0]["result_desc"]);
    $('#temp_result_id').val(data[0]["m_r_id"]);
    $('#active_status').val(data[0]["active_status"]);
    //$('#update').css("display", "none");
    // $('#update').css("display", "block");
}

function update_market_result() {

    var temp_result_id = $('#temp_result_id').val();
    var market_id = $('#market_id').val();
    var result_date = $('#result_date').val();
    var market_result = $('#market_result').val();
    var result_desc = $('#result_desc').val();
    var active_status = $('#active_status').val();
    var session_token = $('#session_token').val();

    var api_data = {
        "action": "update_market_result",
        "temp_result_id": temp_result_id,
        "market_id": market_id,
        "result_date": result_date,
        "market_result": market_result,
        "active_status": active_status,
        "result_desc": result_desc,
        "session_token": session_token
    };
    $.ajax({
        type: 'POST',
        url: 'API/admin_api.php',
        data: api_data,
        dataType: 'json',
        success: function (data) {
            if(data["status"] == 2)
            {
                alert(data["message"]);
                return false;
            }
            else if (data["status"] == 1) {
                set_market_result_data(data["data"]);
                $('#add').css("display", "none");

            }
            else if (data["status"] == 0) {
                return false;
            }
        },
        error: function (jqXHR, exception) {

        },

    });
}

function set_market_result_data(data) {
    var UI = '';
    $.each(data["data"], function (index, value) {
        var active = 'Inactive';
        if (value["active_status"] == '1') {
            active = 'Active';
        }
        UI += '<tr>' +
            '<td class="center">' + value["market_name"] + '</td>' +
            '<td class="center">' + value["result_date"] + '</td>' +
            '<td class="center">' + value["market_result"] + '</td>' +
            '<td class="center">' + active + '</td>' +
            '<td>' +
            '<a href="market_result.php?id=' + value["m_r_id"] + '&action=edit" class="on-default remove-row"><i class="glyphicon glyphicon-pencil"></i></a>' +
            '<a onclick="confirm_delete(\'' + value["m_r_id"] + '\');"  class="on-default remove-row" style="cursor: pointer;"><i class="glyphicon glyphicon-trash"></i></a>';
        UI += '</td>' +
            '</tr>';
    });

    $('#display_market_result_data').html(UI);

}

function confirm_delete(id) {
    var con = confirm('Are you sure Want To Delete This Data?');
    if (con) {
        window.location.href = "market_result.php?id=" + id + "&action=delete";
    } else {
        return false;
    }
}

function update_forum_quote_status(quote_id) {
    var active_status = $('#is_active_update_' + quote_id).val();
    var quote = quote_id;
    var session_token = $('#session_token').val();

    var api_data = {
        "action": "update_quote_update_status",
        "active_status": active_status,
        "quote": quote,
        "session_token":session_token
    };
    $.ajax({
        type: 'POST',
        url: 'API/admin_api.php',
        data: api_data,
        dataType: 'json',
        success: function (data) {
            if (data["status"] == 1) {
                alert('Successfully Updated')

            }
            else if (data["status"] == 2) {
                return false;
            }
        },
        error: function (jqXHR, exception) {

        },

    });
}

function update_forum_status(id_forum) {
    var active_status = $('#is_active_update_' + id_forum).val();
    var session_token = $('#session_token').val();

    var api_data = {
        "action": "update_forum_update_status",
        "active_status": active_status,
        "id_forum": id_forum,
        "session_token":session_token
    };
    $.ajax({
        type: 'POST',
        url: 'API/admin_api.php',
        data: api_data,
        dataType: 'json',
        success: function (data) {
            if(data["status"] == 2)
            {
                alert(data["message"]);
                return false;
            }
            else if (data["status"] == 1) {
                alert('Successfully Updated')

            }
            else if (data["status"] == 0) {
                return false;
            }
        },
        error: function (jqXHR, exception) {

        },

    });
}

function add_quotes_by_admin() {
    var id_forum = $('#forum_id_temp').val();
    var admin_quote_text = $('#admin_quote_text').val();
    var text_color = $('#hue-demo').val();
    var session_token = $('#session_token').val();
    $.ajax({
        type: 'POST',
        url: 'API/admin_api.php',
        data: {
            "id_forum": id_forum,
            "admin_quote_text": admin_quote_text,
            "text_color": text_color,
            "action": "add_quotes_by_admin",
            "session_token":session_token
        },
        dataType: 'json',
        success: function (data) {
            if(data["status"] == 2)
            {
                alert(data["message"]);
                return false;
            }
            else if (data['status'] == 1) {
                $('#mymodel_admin_quotes').modal('hide');
                location.reload();

            } else {
            }
        },
        error: function (jqXHR, exception) {
            showError(jqXHR, exception);
        }
    });
}

function set_admin_quote(forum_id) {
    // mymodel_admin_quotes
    $('#forum_id_temp').val(forum_id);
    $('#mymodel_admin_quotes').modal('show');
}

