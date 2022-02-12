$(function () {
    $(document).on('click', '.ship_order', shipOrder)
})


function shipOrder(){
    event.preventDefault();
    let urlRequest = $(this).data('url');
    let deleted = $(this);
    Swal.fire({
        title: 'Xác nhận đã giao hàng?',
        text: "Bạn có chắc chắn hóa đơn đã giao!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xác nhận đã giao!',
        cancelButtonText:'Hủy'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type:'GET',
                url:urlRequest,
                success:function (data) {
                    if (data.code == 200)
                    {

                        Swal.fire(
                            'Xác nhận đã giao!',
                            'Bạn đã xác nhận đã giao.',
                            'success'
                        )
                        window.location.href="http://localhost:8000/admin/orders";
                    }
                },
                error: function () {
                    Swal.fire(
                        'Thất bại!',
                        'Không thể xác nhận đã giao đơn hàng chờ duyệt,đã giao hoặc đã hủy.',
                        'warning'
                    )
                }
            });

        }
    })
}
