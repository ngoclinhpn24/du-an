@extends('admin_layout')
@section('content')
<!-- xem thong tin don hang  -->
<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     Thông tin đăng nhập
    </div>
    
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người dùng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->user_phone}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->user_address}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<br>
<div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
     Thông tin vận chuyển
    </div>
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên người nhận</th>
            <th>Địa chỉ</th>
            <th>Quận, huyện</th>
            <th>Đường</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Ghi chú</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>{{$shipping->shipping_name}} {{$shipping->shipping_surname}}</td>
            <td>{{$shipping->shipping_address}}</td>
            <td>{{$shipping->shipping_town}}</td>
            <td>{{$shipping->shipping_village}}</td>
             <td>{{$shipping->shipping_phone}}</td>
             <td>{{$shipping->shipping_email}}</td>
             <td>{{$shipping->shipping_note}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<br><br>
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Chi tiết đơn hàng
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Số thứ tự</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá tiền</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php 
          $i = 1;
          $total = 0;
          @endphp
        @foreach($order_details as $key => $details)
          <tr>
            <td><i>{{$i}}</i></td>
            @php
             $i++ ;
             $total+= $details->product_price;
            @endphp
            <td>{{$details->product_name}}</td>
            <td>{{$details->product_quantity}}</td>
            <td>{{number_format($details->product_price)}} VNĐ</td>
          </tr>
        @endforeach
          </tr>
          @foreach($order as $key => $or)
          <tr>
            <td colspan="2"></td>
            <td>Tổng tiền:</td>
            <td>{{number_format($total)}} VNĐ</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td>Phí ship:</td>
            <td>+ {{number_format($or->feeship)}} VNĐ</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td>Mã giảm giá:</td>
            <td>- {{number_format($or->coupon)}} VNĐ</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td>Tổng thanh toán:</td>
            <td>{{number_format($or->order_total)}} VNĐ</td>
          </tr>
          <tr>
            <td colspan="2"></td>
            <td>Hình thức thanh toán:</td>
            @if ($payment->payment_method == 1)
                <td>Thanh toán khi nhận hàng </td>
            @elseif($payment->payment_method == 2)
            <td>Ví MOMO </td>
            @elseif($payment->payment_method == 3)
            <td>Paypal </td>
            @elseif($payment->payment_method == 4)
            <td>Onepay </td>
            @elseif($payment->payment_method == 5)
            <td> VNPAY</td>
            @endif
          </tr>
        </tbody>
      </table>
        
    </div>

    @if ($or->order_status == 1)
    
    <form action="{{url('shipping-order')}}" method="POST">
      @csrf
      <input type="hidden" name="order_id" value="{{$or->order_id}}">
      <div class="form-group">
        <label for="exampleInputEmail1">Chọn nhân viên giao hàng</label>
        <select type="text" name="shipper_id" class="form-control">
          @foreach ($shippers as $shipper)
            <option value="{{$shipper->id}}"> {{$shipper->employee_name}}</option>
            @endforeach
        </select>
      </div>
      <button type="submit"  class="btn btn-success" style="margin-bottom: 7px">Giao đơn hàng</button>
    </form>

    @elseif($or->order_status == 2 || $or->order_status == 3)
    <div class="card" style="width: 18rem;">
      <ul class="list-group list-group-flush">
        <li class="list-group-item">Mã vận đơn: {{$or->order_code}}</li>
        <li class="list-group-item">Tên Shipper: {{$or->shipper_name}}</li>
        <li class="list-group-item">Số điện thoại: {{$or->shipper_phone}}</li>
      </ul>
    </div>  

    @endif
    <button class="btn btn-warning"><a target="_blank" href="{{url('/print-order/'.$or->order_id)}}" style="color: white">In đơn hàng</a></button>
    @if ($or->order_status == 1)
    <button class="btn btn-danger"><a href="{{url('/cancel-order-admin/'.$or->order_id)}}" style="color: white">Hủy đơn hàng</a></button>
    @endif
    @endforeach
  </div>
</div>
@endsection