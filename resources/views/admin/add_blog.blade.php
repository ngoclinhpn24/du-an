@extends('admin_layout')
@section('content')
<!-- them blog -->
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm Blog nấu ăn mới
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="POST" action="{{url('/add-blog')}}" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tiêu đề Blog</label>
                            <input required type="text" data-validation="length" data-validation-length="min2" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" class="form-control" name="title" placeholder="Nhập tiêu đề Blog">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ảnh minh họa</label>
                            <input required type="file" class="form-control" name="images" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tóm tắt</label>
                            <textarea required id="editor2" style="resize :none" rows="4" type="text" class="form-control" name="summary"  placeholder="Mô tả ngắn">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả chi tiết</label>
                            <textarea required id="editor3" style="resize :none" rows="8" type="text" class="form-control" name="content"  placeholder="Mô tả Blog">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Danh mục blog</label>
                            <select required name="blogcategory_id" class="form-control input-lg m-bot15">
                                @foreach ($blogcate as $cate)
                                
                                <option value="{{$cate->blogcategory_id}}">{{$cate->blogcategory_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tùy chọn hiển thị</label>
                            <select name="status" class="form-control input-lg m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Sản phẩm giới thiệu</label>
                            <select required name="product[]" class="form-control" size="8" multiple="multiple" required>
                                @foreach ($products as $pro)
                                <option value="{{$pro->product_id}}">{{$pro->product_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-info">Thêm Blog</button>
                    </form>
                    </div>
                </div>
            </section>
    </div>
</div>
@endsection