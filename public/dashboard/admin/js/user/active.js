function changeUserStatus(_this, id) {
    var status = $(_this).prop('checked') == true ? 1 : 0;
    let _token = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: $('#active-url').data("url"),
        type: 'post',
        data: {
            _token: _token,
            id: id,
            status: status 
        },
        success: function (result) {
        }
    });
}