@extends('admin_layout')
@section('content')
<!-- them qua tang -->
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thêm quà tặng mới
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
                                <form role="form" action="{{URL::to('insert-gift')}}" method="POST">
                                   @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Điểm Eko Point</label>
                                    <input required type="text" name="point" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Quà đổi</label>
                                    <input required type="text" name="gift" class="form-control">
                                </div>
                                <button type="submit"  class="btn btn-info">Thêm quà tặng quy đổi mới</button>
                                </form>
                            </div>
                        </div>
                    </section>
            </div>
@endsection