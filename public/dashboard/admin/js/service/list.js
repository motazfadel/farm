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
            {"data": "title","name": 'title', "searchable": false},
            // {"data": "description","name": 'description', "searchable": false},
            // {"data": "price","name": 'price', "searchable": false},
            {"data": "image","name": 'image', "orderable": false, "searchable": false},
            {"data": "action",'name':'action', "orderable": false}
        ]
    });
    $('.form-select').change(function(){
        table.draw();
    });
})(jQuery)

