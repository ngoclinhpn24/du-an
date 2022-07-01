@include('header')
@include('nav_user')
<!-- xem qua tang -->
        <div class="col-lg-8 pb-5">
            <div class="d-flex justify-content-end pb-3">
            </div>
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="myTable">
                    <thead>
                        <tr>
                            <th>Mã</th>
                            <th>Khuyến mãi</th>
                            <th>Số lượng</th>
                            <th>Hạn sử dụng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($gift_coupon as $coupon)
                        @if (strtotime($coupon->coupon_end) >= strtotime($today))
                        <tr>
                            <td>{{$coupon->coupon_code}}</td>
                            <td>{{$coupon->coupon_name}}</td>
                            <td>{{$coupon->coupon_quantity}}</td>
                            <td>{{$coupon->coupon_end}}</td>
                          </tr>
                          @endif
                          @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@include('footer')