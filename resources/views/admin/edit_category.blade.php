@extends('admin_layout')
@section('content')
<!-- chinh danh muc spham -->
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật danh mục sản phẩm
                </header>
                <div class="panel-body">
                    <div class="position-center">
                        @foreach($data as $category)
                        <form role="form" method="POST" action="{{url('/update-category/'.$category->category_id)}}">
                            @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input required type="text" class="form-control" name="category" id="exampleInputEmail1" value={{$category->category_name}}>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tùy chọn hiển thị</label>
                            <select required name="category_status" class="form-control input-lg m-bot15">
                                <option value="1">Hiển thị</option>
                                <option value="0">Ẩn</option>
                            </select>
                        </div>
                        @endforeach
                        <button type="submit" name="submit" class="btn btn-info">Cập nhật danh mục</button>
                    </form>
                    </div>
                </div>
            </section>
    </div>
</div>
@endsection