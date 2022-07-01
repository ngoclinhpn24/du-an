@include('header')
<!-- xem chi tiet don hang -->
<div class="container-fluid">
    <div class="container">
      <div class="padding-bottom-3x mb-1">
        <div class="card mb-3">
          <div class="p-4 text-center text-white bg-dark text-lg rounded-top">
            @foreach($order as $or)
            <span class="text-uppercase">Mã đơn hàng - </span><span class="text-medium">{{$or->order_id}}</span></div>
          <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between py-3 px-2 bg-secondary">
            <div class="w-100 text-center py-1 px-2"><span class="text-medium">Đơn vị vận chuyển:</span> Eco Express</div>
            <div class="w-100 text-center py-1 px-2"><span class="text-medium">Trạng thái:</span> 
            @if ($or->order_status == 0)
            Đơn hàng đã hủy
            @elseif($or->order_status == 1)
            Đang xử lý
            @elseif($or->order_status == 2)
            Đang giao hàng
            @elseif($or->order_status == 3)
            Giao hàng thành công 
            @endif
            </div>
            <div class="w-100 text-center py-1 px-2"><span class="text-medium">Ngày đặt hàng:</span> {{$or->created_at}}
            </div>
          </div>
         
          <div class="card-body">
            <div class="steps d-flex flex-wrap flex-sm-nowrap justify-content-between padding-top-2x padding-bottom-1x">
              <div class="step completed">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="fa fa-user"></i></div>
                </div>
                <h4 class="step-title">Chờ xác nhận</h4>
              </div>
              <div class="step completed">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="fa fa-cog"></i></div>
                </div>
                <h4 class="step-title">Chờ lấy hàng</h4>
              </div>
              <div class="step completed">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="fa fa-truck"></i></div>
                </div>
                <h4 class="step-title">Đang giao</h4>
              </div>
              <div class="step completed">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="fa fa-home"></i></div>
                </div>
                <h4 class="step-title">Đã giao</h4>
              </div>
              <div class="step completed">
                <div class="step-icon-wrap">
                  <div class="step-icon"><i class="fa fa-times"></i></div>
                </div>
                <h4 class="step-title">Hủy đơn</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      <div class="row">
        <div class="col-lg-8">
          <div class="card mb-3">
            <div class="table-responsive">
              <table class="table table-hover mb-0" id="myTable">
                <thead>
                      <tr>
                          <th>Tên sản phẩm</th>
                          <th>Số lượng</th>
                          <th>Thành tiền</th>
                      </tr>
                </thead>
                <tbody>
                  @foreach ($order_details as $item)
                  <tr>
                    <td>
                      <div class="d-flex">
                        <div class="flex-lg-grow-1 ms-3">
                          <h4 class="mb-0" style="font-size: 17px;"><a href="#" class="text-reset"><b>{{$item->product_name}}</b></a></h4>
                          <span class="small">{{number_format($item->product_price)}} VND x 1</span>
                        </div>
                      </div>
                    </td>
                    <td>x{{$item->product_quantity}}</td>
                    <td class="text-end">@php $total = $item->product_price * $item->product_quantity @endphp {{number_format($total)}} VND</td>
                  </tr>
                  @endforeach
                </tbody>
                
              @foreach($order as $ord)
                <tfoot>
                  
                  <tr>
                    <td colspan="2"><b>Phí ship</b></td>
                    <td class="text-end">{{number_format($ord->feeship)}} VND</td>
                  </tr>
                  <tr>
                    <td colspan="2"><b>Mã giảm giá </b></td>
                    <td class="text-danger text-end">-{{number_format($ord->coupon)}} VND</td>
                  </tr>
                  <tr class="fw-bold">
                    <td colspan="2"><b>Tổng tiền</b></td>
                    <td class="text-end">{{number_format($ord->order_total)}} VND</td>
                  </tr>
                </tfoot>
              
              </table>
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-body">
              <div class="row">
                <div class="col-lg-6">
                  <h3 class="h6"><b>Phương thức thanh toán</b></h3>
                  @if ($payment->payment_method == 1)
                  <p>Thanh toán khi nhận hàng <br>
                  @elseif($payment->payment_method == 2)
                  <p>Ví MOMO <br>
                  @elseif($payment->payment_method == 3)
                  <p>Paypal <br>
                  @elseif($payment->payment_method == 4)
                  <p>Onepay <br>
                  @elseif($payment->payment_method == 5)
                  <p>VNPAY <br>
                  @endif
                </div>
                <div class="col-lg-6">
                  <h3 class="h6"><b>Địa chỉ nhận hàng</b></h3>
                  <address>
                    <strong>{{$shipping->shipping_surname}} {{$shipping->shipping_name}}</strong><br>
                    {{$shipping->shipping_address}}<br>
                    {{$shipping->shipping_town}}<br>
                    Số điện thoại: {{$shipping->shipping_phone}}
                  </address>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <!-- Ghi chú -->
          <div class="card mb-3">
            <div class="card-body">
              <h3 class="h6"><b>Ghi chú</b></h3>
              <p>{{$shipping->shipping_note}}</p>
            </div>
          </div>
          <div class="card mb-3">
            <!-- Thông tin vận chuyển -->
            @if (!empty($ord->order_code))
            <div class="card-body">
              <h3 class="h6"><b>Thông tin vận chuyển</b></h3>
              <span>Eko Express</span> <br>
              <span>Mã vận đơn: {{$ord->order_code}} <a href="#" class="text-decoration-underline" target="_blank"></a> 
              <i class="bi bi-box-arrow-up-right"></i> </span>
              <hr>
              <h3 class="h6">Thông tin người giao hàng</h3>
              <address>
                <strong>{{$ord->shipper_name}}</strong><br>
                Liên hệ: {{$ord->shipper_phone}}
              </address>
            </div>
            @endif
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
  @include('footer');