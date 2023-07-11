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
            // data:function (d){
                // d.user_name = $('#user_name').val()
                // d.search = $('input[type="search"]').val()

            // }
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
            {"data": "title","name": 'title', "searchable": false},
            {"data": "hours","name": 'hours', "searchable": false},
            {"data": "number_maids","name": 'number_maids', "searchable": false},
            {"data": "rate","name": 'rate', "searchable": false},
            {"data": "total","name": 'total', "searchable": false},
            {"data": "action",'name':'action'}
        ]
    });
    $('.filter-select').change(function(){
        table.draw();
    });
})(jQuery)

