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
            data:function (d){
                d.user_bookings = $('#user_bookings').val();
                console.log(user_bookings);
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
            // {"data": 'checkbox', "name": 'checkbox', "searchable": false},
            {"data": "time","name": 'time', "searchable": false},
            {"data": "date","name": 'date', "searchable": false},
            {"data": "noumber_professionals","name": 'noumber_professionals', "searchable": false},
            {"data": "number_hours","name": 'number_hours', "searchable": false},
            {"data": "payment_method","name": 'payment_method', "searchable": false},
            {"data": "price","name": 'price', "searchable": false},
            {"data": "user_bookings","name": 'user_bookings.full_name', "searchable": false},
            {"data": "action",'name':'action'}
        ]
    });
    $('.form-select').change(function(){
        table.draw();
    });
})(jQuery)

