@extends('admin_layout')
@section('content')
<!-- them danh muc blog -->
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm danh mục Blog nấu ăn
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="POST" action="{{url('/save-blog-category')}}">
                            @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tiêu đề danh mục Blog</label>
                            <input required data-validation="length" data-validation-length="min2" data-validation-error-msg="Làm ơn điền tên danh mục Blog" type="text" class="form-control" name="blogcategory_name" id="exampleInputEmail1" placeholder="Nhập tên danh mục blog">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tùy chọn hiển thị</label>
                            <select required name="blogcategory_status" class="form-control input-lg m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-info">Thêm danh mục blog</button>
                    </form>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection