<div class="col-md-12  m-1">
    <form action="{{ url('/admin/categories/search') }}" autocomplete="off" method="get">
        <input type="text" style="width: 300px" name="search" id="keywords" placeholder="Nhập tên danh mục cần tìm">
        <input type="submit" class="btn btn-info" value="Tìm kiếm">
        <div id="search_ajax"></div>
    </form>
</div>
