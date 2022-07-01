
@extends('admin_layout')

@section('content')
<!-- them ma giam gia -->
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Tạo mã giảm giá mới
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
                                <form role="form" action="{{URL::to('/add-coupon')}}" method="post">
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input required type="text" name="coupon_name" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã giảm giá</label>
                                    <input required type="text" name="coupon_code" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số lượng mã</label>
                                      <input required type="text" name="coupon_quantity" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Đơn hàng tối thiểu</label>
                                      <input required type="text" name="coupon_min" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ngày bắt đầu</label>
                                      <input required type="text" name="coupon_start" class="form-control" id="datepicker1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Ngày hết hạn</label>
                                      <input required type="text" name="coupon_end" class="form-control" id="datepicker2" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Loại giảm giá(mức giảm)</label>
                                     <select required name="coupon_condition" class="form-control input-sm m-bot15">
                                             <option value="0">----Chọn-----</option>
                                            <option value="1">Giảm theo phần trăm</option>
                                            <option value="2">Giảm theo tiền</option>
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nhập số % hoặc tiền giảm</label>
                                     <input required type="text" name="coupon_discount" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã giảm giá</button>
                                </form>
                            </div>
                        </div>
                    </section>

            </div>
@endsection
