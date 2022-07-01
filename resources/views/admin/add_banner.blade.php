@extends('admin_layout')
@section('content')
<!-- them banner -->
<div class="row">
    <div class="col-lg-12">
        <section class="panel">
            <header class="panel-heading">
                Thêm Banner quảng cáo
            </header>
                <?php
                $message = Session::get('message');
                if($message){
                    echo '<span class="text-alert">'.$message.'</span>';
                        Session::put('message',null);
                }
                ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/insert-banner')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên banner</label>
                                    <input required type="text" data-validation="length" data-validation-length="min2" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự" name="banner_name" class="form-control" id="exampleInputEmail1" placeholder="Tên banner">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh Banner</label>
                                    <input required type="file" name="banner_image" class="form-control" id="exampleInputEmail1" placeholder="Banner">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả banner</label>
                                    <textarea required data-validation="length" data-validation-length="min5" data-validation-error-msg="Làm ơn điền ít nhất 5 ký tự" style="resize: none" rows="8" class="form-control" name="banner_desc" id="exampleInputPassword1" placeholder="Mô tả banner"></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Trạng thái</label>
                                      <select required name="banner_status" class="form-control input-sm m-bot15">
                                           <option value="1">Hiển thị</option>
                                            <option value="0">Ẩn</option>
                                    </select>
                                </div>
                            <button type="submit" name="add_banner" class="btn btn-primary">Thêm banner</button>
                        </form>
                    </div>
                </div>
            </section>
        </div>
@endsection