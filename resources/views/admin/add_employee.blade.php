@extends('admin_layout')
@section('content')
<!-- them nhan vien -->
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm nhân viên mới
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
                                <form role="form" action="{{URL::to('insert-employee')}}" method="POST">
                                   @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên Nhân viên</label>
                                    <input required type="text" name="name" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ email</label>
                                    <input required type="email" name="email" class="form-control">
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Số điện thoại</label>
                                    <input required type="text" name="phone" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ</label>
                                    <input required type="text" name="address" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Chức vụ</label>
                                    <select required type="text" name="job" class="form-control">
                                        <option value="Shipper"> Shipper</option>
                                        <option value="Nhân viên bán hàng"> Nhân viên bán hàng</option>
                                        <option value="Nhân viên tạp vụ"> Nhân viên tạp vụ</option>
                                    </select>
                                </div>
                                <button type="submit"  class="btn btn-info">Thêm nhân viên mới</button>
                                </form>
                            </div>
                        </div>
                    </section>
            </div>
@endsection