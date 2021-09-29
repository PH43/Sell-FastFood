<div class="col-md-12  m-1" >
    <form action="{{ route('categories.search') }}" autocomplete="off" method="post">
        @csrf
        <input type="text" style="width: 300px" name="search" id="keywords" placeholder="Nhập tên danh mục cần tìm">

        <input type="submit" class="btn btn-info" value="Tìm kiếm">
        <div id="search_ajax"></div>
    </form>
</div>
