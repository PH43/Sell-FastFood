$(function () {
    $(document).on('click', '.confirm_delete', confirmDelete)
})


function confirmDelete(){
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let deleted = $(this);
    Swal.fire({
        title: 'Xóa danh mục?',
        text: "Xóa danh mục này sẽ xóa các sản phẩm và hóa đơn liên quan!",
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
                            'Bạn đã xóa danh mục.',
                            'success'
                        )
                    }
                },
                error: function () {
                    Swal.fire(
                        'Thất bại!',
                        'Bạn không thể xóa danh mục chứa sản phẩm.',
                        'warning'
                    )
                }
            });

        }
    })
}



