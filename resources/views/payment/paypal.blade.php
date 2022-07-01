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
<!-- thanh toan paypal -->
<div class="container">
    <div class="row">
        <div class="col-lg-12 text-center" style="margin-top: 20px; margin-bottom: 20px">
            <h3 class="text-center" style="font-size: 30px">Bạn đang chọn hình thức thanh toán PAYPAL</h3>
        </div>
        <div class="row center-form" style="margin-bottom: 30px;">
            <form action="{{url('paypal')}}" method="post" class="pynt-form">
                @csrf
                <button class="btn btn-color" type="submit" name="redirect">Tiếp tục thanh toán</button>
            </form>
        </div>
    </div>
</div>
@include('footer')