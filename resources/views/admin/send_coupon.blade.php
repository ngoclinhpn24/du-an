@extends('admin_layout')
@section('content')
<!-- them nguoi dung -->
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Gửi tặng mã giảm giá cho khách hàng
                        </header>
                         <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert position-center">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('send-mail')}}" method="POST">
                                   @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mã giảm giá</label>
                                    <select required type="text" name="coupon" class="form-control">
                                        @foreach ($coupon as $item)
                                        <option value="{{$item->coupon_id}}">{{$item->coupon_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Gửi đến khách hàng</label>
                                    <select required name="user[]" class="form-control" size="8" multiple="multiple" >
                                        @foreach ($user as $us)
                                        <option value="{{$us->id}}">{{$us->name}} ( {{$us->email}} )</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit"  class="btn btn-info">Gửi</button>
                                </form>
                            </div>
                        </div>
                    </section>
            </div>
@endsection