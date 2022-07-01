@include('header')
@include('nav_user')
<!-- nguoi dung - quan ly don hang -->
        <div class="col-lg-8 pb-5">
            <div class="d-flex justify-content-end pb-3">
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="myTable1">
                    <thead>
                        <tr>
                            <th>Mã đơn hàng</th>
                            <th>Ngày đặt hàng</th>
                            <th>Trạng thái</th>
                            <th>Tổng tiền</th>
                            <th>Hành động</th> 
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $item)
                        <tr>
                            <td><a class="navi-link" href="{{url('view-order-user/'.$item->order_id)}}">{{$item->order_id}} </a></td>
                            <td>{{$item->created_at}}</td>
                            
                            @if ($item->order_status == 1)
                            <td><span class="badge badge-primary m-0"> Đang xử lý </span></td>
                            @elseif ($item->order_status == 0)
                            <td><span class="badge badge-danger m-0"> Đơn hàng đã hủy </span></td>
                            @elseif ($item->order_status == 2)
                            <td><span class="badge badge-info m-0"> Đang giao hàng </span></td>
                            @elseif  ($item->order_status == 3)
                            <td><span class="badge badge-success m-0"> Giao hàng thành công </span></td>
                            @endif
                            
                            <td>{{number_format($item->order_total)}} VNĐ</td> 
                            <td>
                            @if ($item->order_status == 1)
                            <a onclick="return confirm('Bạn có muốn hủy đơn hàng này không?')"  href="{{url('cancel-order/'.$item->order_id)}}"><button class="btn btn-danger">Hủy đơn hàng</button></a>
                            @elseif ($item->order_status == 2)
                            <a onclick="return confirm('Bạn xác nhận đã nhận được hàng?')" href="{{url('confirm-order/'.$item->order_id)}}"><button class="btn btn-primary">Đã nhận được hàng</button></a>
                            @endif 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@include('footer')