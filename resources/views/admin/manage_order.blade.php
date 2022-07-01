@extends('admin_layout')
@section('content')
<!-- quan ly don hang -->
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê đơn hàng
    </div>
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                      ?>
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>Mã đơn hàng</th>
            <th>Tên người dùng</th>
            <th>Ngày tháng đặt hàng</th>
            <th>Tổng thanh toán</th>
            <th>Tình trạng đơn hàng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($all_order as $order)
          <tr>
            <td>{{ $order->order_id }}</td>
            <td>{{ $order->name }}</td>
            <td>{{ $order->created_at }}</td>
            <td>{{ number_format($order->order_total) }}</td>
            <td>    @if($order->order_status==1)
                     Đơn hàng mới
                    @elseif($order->order_status==0)
                      Đơn hàng đã hủy
                    @elseif($order->order_status==2)
                      Đang giao hàng 
                    @elseif($order->order_status==3)
                      Giao hàng thành công 
                @endif
            </td>
            <td>
              <a href="{{URL::to('/view-order/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i></a>
              <a onclick="return confirm('Bạn có muốn xóa đơn hàng này không?')" href="{{URL::to('/delete-order/'.$order->order_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection