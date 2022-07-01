@include('header')
<!-- tiep tuc thanh toan neu chon thanh toan online -->
<section class="breadcrumb-section set-bg container" data-setbg="img/bread.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Thanh toán</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Trang chủ</a>
                        <span>Thanh toán</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center mb-5 mt-5">
            <h3 class="text-center mb-4">Bạn đã đặt hàng thành công</h3>
            <a href="{{url('/')}}">
            <button class="btn btn-primary">Tiếp tục mua sắm</button>
            </a>
            <a href="{{url('manage-order-user')}}">
            <button class="btn btn-primary">Xem lại đơn hàng</button>
            </a>
        </div>
    </div>
</div>
@include('footer')