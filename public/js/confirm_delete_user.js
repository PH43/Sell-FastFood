$(function () {
    $(document).on('click', '.confirm_delete_user', confirmDelete)
})


function confirmDelete(){
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let deleted = $(this);
    Swal.fire({
        title: 'Xóa tài khoản?',
        text: "Xóa tài khoản này sẽ xóa các hóa đơn liên quan!",
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
                            'Bạn đã xóa tài khoản.',
                            'success'
                        )
                    }
                },
                error: function () {
                    Swal.fire(
                        'Thất bại!',
                        'Không thể xóa tài khoản bản thân.',
                        'warning'
                    )
                }
            });

        }
    })
}
