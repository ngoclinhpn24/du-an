@include('header')
<!-- phan dau muc -->
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
<!-- thanh toan onepay -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center" style="margin-top: 20px; margin-bottom: 10px">
            <h3 class="text-center" style="font-size: 30px">Bạn đang chọn hình thức thanh toán ONEPAY</h3>
            <form action="{{url('onepay')}}" method="post" style="margin-top: 30px;">
                @csrf
                <button class="btn btn-color" type="submit" name="redirect">Tiếp tục thanh toán</button>
            </form>
        </div>

        <div class="row center-form" style="margin-bottom: 30px;">
            
            <!-- <a href="{{url('manage-order-user')}}"><button class="btn pynt-form btn-color">Xem lại đơn hàng </button></a>
            <a href="{{url('/')}}"><button class="btn btn-color">Quay lại trang chủ </button></a> -->
        </div>
    </div>
</div>
@include('footer')