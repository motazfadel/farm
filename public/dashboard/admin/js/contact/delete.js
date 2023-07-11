$(document).ready(function (){
    $(document).on('click','#delete',function (){
        var url =  $(this).data("url");
        var id = $(this).data("user");
        var _token = $('meta[name="csrf-token"]').attr('content');
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Yes, delete it!"
        }) .then((willDelete) => {
            if (willDelete.value===true) {
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {id: id,_token:_token},
                    success: function (data) {
                        location.reload();
                    }
                });
            }
        });
    });
});
