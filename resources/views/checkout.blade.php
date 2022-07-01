@include('header')
<!-- thanh toan -->
<section class="breadcrumb-section set-bg container" data-setbg="img/bread.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Thanh toán</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Trang chủ</a>
                        <span>Tiến hành thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- thong tin nguoi nhan hang -->
<section class="checkout spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h6><span class="icon_tag_alt"></span> Bạn có mã giảm giá? <a href="#coupon">Click </a> để nhập mã
                </h6>
            </div>
        </div>
        <div class="checkout__form">
            <h4>Hóa đơn</h4>
            <form action="{{url('save-checkout-user')}}" method="POST">
                @csrf
                 @if (!empty($shipping))
                 <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Họ<span>*</span></p>
                                    <input type="text" name="shipping_surname" value="{{$shipping->shipping_surname}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Tên<span>*</span></p>
                                    <input required type="text" name="shipping_name" value="{{$shipping->shipping_name}}">
                                </div>
                            </div>
                        </div>
                    <div class="checkout__input">
                        <p>Địa chỉ chi tiết<span>*</span></p>
                        <input required type="text" name="shipping_address" placeholder="Địa chỉ chi tiết" value="{{$shipping->shipping_address}}">
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="checkout__input">
                                <p>Số điện thoại<span>*</span></p>
                                <input required type="text" name="shipping_phone" value="{{$shipping->shipping_phone}}">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input required type="text" name="shipping_email" value="{{$shipping->shipping_email}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="checkout__input col-lg-4">
                            <p>Thành phố/ Tỉnh<span>*</span></p>
                            <input required type="text" name="shipping_city" value="Hà Nội">
                        </div>
                        <div class="checkout__input col-lg-4">
                            <p>Thành quận, huyện<span>*</span></p>
                            <input required type="text"  name="shipping_town" value="{{$shipping->shipping_town}}">
                        </div>
                        <div class="checkout__input col-lg-4">
                            <p>Đường<span>*</span></p>
                            <input required type="text" name="shipping_village" value="{{$shipping->shipping_village}}">
                        </div>
                    </div>
                 @else
                 <div class="row">
                    <div class="col-lg-8 col-md-6">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Họ<span>*</span></p>
                                    <input type="text" name="shipping_surname" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="checkout__input">
                                    <p>Tên<span>*</span></p>
                                    <input type="text" name="shipping_name" required>
                                </div>
                            </div>
                        </div>
                    <div class="checkout__input">
                        <p>Địa chỉ chi tiết<span>*</span></p>
                        <input type="text" name="shipping_address" placeholder="Địa chỉ chi tiết" required>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="checkout__input">
                                <p>Số điện thoại<span>*</span></p>
                                <input type="text" name="shipping_phone" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="text" name="shipping_email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="checkout__input col-lg-4">
                            <p>Thành phố/ Tỉnh<span>*</span></p>
                            <input  type="text" name="shipping_city" value="Hà Nội" required>
                        </div>
                        <div class="checkout__input col-lg-4">
                            <p>Thành quận, huyện<span>*</span></p>
                            <input type="text"  name="shipping_town" required>
                        </div>
                        <div class="checkout__input col-lg-4">
                            <p>Đường<span>*</span></p>
                            <input type="text" name="shipping_village" required>
                        </div>
                    </div>
                 @endif   
                    
                    <div class="checkout__input">
                        <p>Ghi chú<span>*</span></p>
                        <textarea type="text" name="shipping_note" cols="73" rows="7" >
                        </textarea>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                        <div class="checkout__order">
                            <h4>Đơn hàng của bạn</h4>
                            <div class="checkout__order__subtotal">Tổng số lượng <span>{{number_format(Session::get('cart')->totalQuantity)}} sản phẩm</span></div>
                            <div class="checkout__order__subtotal">Tổng tiền <span>{{number_format($total_price)}} VNĐ</span></div>
                            <div class="checkout__order__subtotal">Phí vận chuyển<span> {{number_format($shipping_fee)}} VNĐ</span></div>
                            <div class="coupon">
                             
                            </div>
                            <div class="checkout__order__subtotal">Tổng giảm<span id="discount"> {{number_format($discount)}} VNĐ</span> <i class="fa fa-times text-danger text" id="unset-coupon" ></i> </div>
                            <div class="checkout__order__total">Tổng thanh toán <span class="total">{{number_format($total)}} VNĐ</span></div>
                            <div class="checkout__input__checkbox">
                                <label for="cash">
                                    Thanh toán khi nhận hàng
                                    <input type="radio" id="cash" name="payment_option" value="1">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="vnpay">
                                    VNPAY
                                    <input type="radio" id="vnpay" name="payment_option" value="5">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="momo">
                                    Ví MOMO
                                    <input type="radio" id="momo" name="payment_option" value="2" >
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="paypal">
                                    Paypal(Đang bảo trì)
                                    <input type="radio" id="paypal" name="payment_option" value="3">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="checkout__input__checkbox">
                                <label for="onepay">
                                    Onepay
                                    <input type="radio" id="onepay" name="payment_option" value="4">
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            
                            <button type="submit" name="send_order" class="site-btn">Đặt hàng</button>
                        </div>
                    </div>
                </div>
            
            </form>
        </div>
    </div>
    <div class="container">
                <div class="col-lg-6">
                    <div class="shoping__continue">
                        <div class="shoping__discount ml-8" id="coupon">
                            <h5>Mã giảm giá</h5>
                            <form >
                                @csrf
                                <input type="text" class="coupon_code" name="coupon" placeholder="Nhập mã giảm giá">
                                <button type="button" class="site-btn apply-coupon">Áp dụng</button>
                                {{-- <button type="button" class="btn btn-primary mb-3" id="unset-coupon">Xóa mã</button> --}}
                                {{-- <button type="button" class="btn btn-danger unset-coupon mt-2">Xóa mã</button> --}}
                            </form>
                        </div>
                    </div>
                </div>
    </div>
</section>
@include('footer')
<script>
    function reload_total() {  
        $.ajax({
            type: "GET",
            url: '{{url('/load_total')}}',
            success: function (response) {
                $('.total').html(response);
            }
        });
    };
$('#unset-coupon').click(function () { 
    $.ajax({
        method: "GET",
        url: '{{url('/unset-coupon')}}',
        success: function (response) {
            $('.coupon').empty();
            $('#discount').empty();
            $('#discount').html("0 VNĐ");
            reload_total();
            // $('.total').html(total);
            alertify.success("Xóa mã giảm giá thành công");
        }
    });

    });
$('.apply-coupon').click(function () { 
var coupon = $('.coupon_code').val();
$.ajax({
    method: "POST",
    url: '{{url('/check-coupon')}}',
    data: {
        coupon: coupon, 
        "_token": "{{ csrf_token() }}"
    },
    success: function (response) {
        reload_total();
        // $('#total').html(total);
        $('.coupon').empty();
        $('.coupon').html(response['output']);
        $('#discount').empty();
        $('#discount').html(response['discount']);
        // $('#unset-coupon').addClass("");
        if(response['discount'] == '0 VNĐ'){
         alertify.error("Mã giảm giá không hợp lệ");
        }
        else{
            alertify.success("Áp dụng mã giảm giá thành công");
        }
    }
});
});
</script>
