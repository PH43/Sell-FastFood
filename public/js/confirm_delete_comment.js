$(function () {
    $(document).on('click', '.confirm_delete_comment', confirmDelete)
})


function confirmDelete(){
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let deleted = $(this);
    Swal.fire({
        title: 'Xóa nhận xét?',
        text: "Bạn có chắc chắn xóa nhận xét!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xác nhận xóa!',
        cancelButtonText:'Hủy'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type:'GET',
                url:urlRequest,
                success:function (data) {
                    if (data.code == 200)
                    {
                        deleted.parent().parent().remove();
                        Swal.fire(
                            'Đã xóa!',
                            'Bạn đã nhận xét.',
                            'success'
                        )
                    }
                },
                error: function () {

                }
            });

        }
    })
}
