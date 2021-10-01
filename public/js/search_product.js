$(document).ready(function () {
$('#keywords').on('keyup',function () {
var query = $(this).val();
if (query != ''){
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url:'/api/admin/product/auto_complete_search',
        type:'GET',
        data:{query:query, _token:_token},
        success : function (response) {
            var html = '<ul id="search_ajax" class="dropdown-menu" style="display: block; position: absolute; margin-left: 15px;">';
            console.table(response);
            $.each(response, function (index, value) {
                html += '<li class="search_ajax_product_li" ><a href="#" style="color: black">'+value.name+'</a></li>';
            })
                html += '</ul>';
            $('#search_ajax').fadeIn();
            $('#search_ajax').html(html);
        }
    })
}else {
    $('#search_ajax').fadeOut();
}
    $(document).on('click', '.search_ajax_product_li', function () {
        $('#keywords').val($(this).text());
        $('#search_ajax').fadeOut();
    });
})
})
