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
            {"data": "user_name","name": 'user_name', "searchable": false},
            {"data": "email","name": 'email', "searchable": false},
            {"data": "phone","name": 'phone', "searchable": false},
            {"data": "action",'name':'action', "orderable": false}
        ]
    });
    $('.form-select').change(function(){
        table.draw();
    });
})(jQuery)

