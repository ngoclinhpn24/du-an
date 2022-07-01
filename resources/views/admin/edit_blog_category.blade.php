@extends('admin_layout')
@section('content')
<!-- chinh sua danh muc blog -->
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục blog
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach($data as $blogcate)
                        <form role="form" method="POST" action="{{url('/update-blog-category/'.$blogcate->blogcategory_id)}}">
                            @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" class="form-control" name="blogcategory" id="exampleInputEmail1" value={{$blogcate->blogcategory_name}}>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tùy chọn hiển thị</label>
                            <select required name="blogcategory_status" class="form-control input-lg m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        @endforeach
                        <button type="submit" name="submit" class="btn btn-info">Cập nhật danh mục blog</button>
                    </form>
                    </div>
                </div>
            </section>
    </div>
</div>
@endsection