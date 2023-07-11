(function ($) {
    "use strict";
    let table = $('#datatable').DataTable({
        serverSide: true,
        // scrollY: 500,
        // scrollX: true,
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
            // {"data": 'checkbox', "name": 'checkbox', "searchable": false},
            {"data": "name","name": 'name', "searchable": false},
            {"data": "image","name": 'image', "searchable": false},
            {"data": "is_active","name": 'is_active', "searchable": false},
            {"data": "action",'name':'action'}
        ]
    });
    $('.filter-select').change(function(){
        table.draw();
    });
})(jQuery)

