@extends('admin_layout')
@section('content')
<!-- chinh sua blog -->
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật blog
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach ($data as $item)
                        <form role="form" method="POST" action="{{url('/update-blog/'.$item->id)}}" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tiêu đề Blog</label>
                            <input required type="text" value="{{$item->title}}" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" class="form-control" name="title" placeholder="Nhập tiêu đề Blog">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Ảnh minh họa</label>
                            <input type="file" class="form-control" name="images" id="exampleInputEmail1" >
                            <img src="{{URL::to('public/uploads/blog/'.$item->images)}}" height="100" width="100">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nguyên liệu</label>
                            <textarea required id="editor2"  style="resize :none" rows="4" type="text" class="form-control" name="summary"  >
                                {{$item->summary}}
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mô tả chi tiết</label>
                            <textarea required id="editor3" style="resize :none" rows="8" type="text" class="form-control" name="content">
                                {{$item->content}} 
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Danh mục blog</label>
                            <select required name="blogcategory_id" class="form-control input-lg m-bot15">
                                @foreach($cate as $cate)
                                            @if($cate->blogcategory_id==$item->blogcategory_id)
                                            <option selected value="{{$cate->blogcategory_id}}">{{$cate->blogcategory_name}}</option>
                                            @else
                                            <option value="{{$cate->blogcategory_id}}">{{$cate->blogcategory_name}}</option>
                                            @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tùy chọn hiển thị</label>
                            <select required name="status" class="form-control input-lg m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-info">Cập nhật Blog</button>
                    </form>
                    @endforeach
                    </div>
                </div>
            </section>
    </div>
</div>
@endsection