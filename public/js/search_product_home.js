$(document).ready(function () {
    $('#keywords').on('keyup',function () {
        var query = $(this).val();
        if (query != ''){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:'/api/home/product/auto_complete_search_product_home',
                type:'GET',
                data:{query:query, _token:_token},
                success : function (response) {
                    var html = '<ul id="search_ajax" class="dropdown-menu" style="display: block; position: absolute; margin-left: 15px;">';
                    console.table(response);
                    $.each(response, function (index, value) {
                        html += '<li class="search_ajax_product_home_li" style="display: flex;width: 450px;" >' +
                            // '<img style="width:50px;height:50px" src="http://localhost:8000'+value.feature_image_path+'" alt="">' +
                            '<a href="http://localhost:8000/product_detail/'+value.id+'" style="color: black;width: 450px; padding: 5">'+
                            '<img style="width:50px;height:50px;float: left;margin-right: 5px" src="http://localhost:8000'+value.feature_image_path+'" alt="">' +
                            '<p>'+value.name+'</p>'
                            +'<p style="margin-bottom: -10px; color: red">'+value.price+' VNĐ</p>'+
                            '</a></li>';
                    })
                    html += '</ul>';
                    $('#search_ajax').fadeIn();
                    $('#search_ajax').html(html);
                }
            })
        }else {
            $('#search_ajax').fadeOut();
        }
        $(document).on('click', '.search_ajax_product_home_li', function () {
            $('#keywords').val($(this).text());
            $('#search_ajax').fadeOut();
        });
    })
})
