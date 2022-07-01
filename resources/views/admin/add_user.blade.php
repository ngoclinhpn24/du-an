@extends('admin_layout')
@section('content')
<!-- them nguoi dung -->
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm người dùng mới
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
                                <form role="form" action="{{URL::to('insert-user')}}" method="POST">
                                   @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên người dùng</label>
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
                                    <label for="exampleInputEmail1">Địa chỉ người dùng</label>
                                    <input required type="text" name="address" class="form-control">
                                </div>
                                    <div class="form-group">
                                    <label for="exampleInputEmail1">Mật khẩu</label>
                                    <input required type="password" name="password" class="form-control">
                                </div>
                                <button type="submit"  class="btn btn-info">Thêm người dùng mới</button>
                                </form>
                            </div>
                        </div>
                    </section>
            </div>
@endsection