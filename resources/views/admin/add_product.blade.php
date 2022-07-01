@extends('admin_layout')
@section('content')
<!-- them san pham  -->
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm sản phẩm mới
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" method="POST" action="{{url('/save-product')}}" enctype="multipart/form-data">
                            @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên sản phẩm</label>
                            <input required type="text" data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự" class="form-control" name="product_name" id="exampleInputEmail1" placeholder="Nhập tên danh mục sản phẩm">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Giá sản phẩm</label>
                            <input required type="text" data-validation="number" data-validation-error-msg="Làm ơn điền số tiền" class="form-control" name="product_price" id="exampleInputEmail1" placeholder="Nhập tên giá tiền sản phẩm">
                        </div>
                         <div class="form-group">
                            <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                            <input required type="text" data-validation="number" data-validation-error-msg="Làm ơn điền số lượng" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Điền số lượng">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input required type="file" class="form-control" name="product_image" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Chi tiết sản phẩm</label>
                            <textarea required id="editor1" style="resize :none" rows="8" type="text" class="form-control" name="product_detail"  placeholder="Chi tiết sản phẩm">
                            </textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Danh mục sản phẩm</label>
                            <select required name="category_id" class="form-control input-lg m-bot15">
                                @foreach ($cate as $cate)
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tùy chọn hiển thị</label>
                            <select required name="product_status" class="form-control input-lg m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        <button type="submit" name="submit" class="btn btn-info">Thêm sản phẩm</button>
                    </form>
                    </div>
                </div>
            </section>
    </div>
</div>
@endsection