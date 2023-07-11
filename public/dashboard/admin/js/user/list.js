(function ($) {
    "use strict";
    let table = $('#datatable').DataTable({
        serverSide: true,
        scrollY: 500,
        scrollX: true,
        scrollCollapse: true,
        processing: true,
        "ordering": true,
        pageLength: 10,
        ajax:{
            url:$('#table-url').data("url"),
            data: function(d) {
                // d.is_active = $('#is_active').val();
                },
        },
        order:[0,'asc'],
        autoWidth: false,
        language: {
            paginate: {
                next: 'Next &#8250;',
                previous: '&#8249; Previous'
            }
        },
        columns: [
            {"data": "name","name": 'name', "searchable": false},
            {"data": "user_role","name": 'user_role', "searchable": false},
            {"data": "email","name": 'email', "searchable": false},
            {"data": "date_birth","name": 'date_birth', "searchable": false},
            {"data": "date_employment","name": 'date_employment', "searchable": false},
            {"data": "action",'name':'action', "orderable": false}
        ]
    });
    $('.form-select').change(function(){
        table.draw();
    });
})(jQuery)

