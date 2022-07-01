@include('header')
<!-- thong tin lien he - khieu nai -->
<section class="breadcrumb-section set-bg container" data-setbg="img/bread.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Liên hệ</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Trang chủ</a>
                        <span>Liên hệ</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="contact-form spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>Gửi khiếu nại</h2>
                </div>
            </div>
        </div>
        <form action="{{url('/send-feedback')}}" method="POST">
            @csrf
            <div class="row">
                <div class="form-group col-lg-6 col-md-6">
                    <label for="exampleInputEmail1">Chọn đơn hàng cần hỗ trợ:</label>
                    <select name="order_id" class="form-control input-lg m-bot15" required>
                        @foreach ($order as $item)
                        <option value="{{$item->order_id}}">{{$item->order_id}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-lg-6 col-md-6">
                    <label for="exampleInputEmail1">Chọn vấn đề cần hỗ trợ:</label>
                    <select name="issue" class="form-control input-lg m-bot15" required>
                        @foreach ($issues as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-lg-6 col-md-6">
                    <input type="text" name="name" placeholder="Nhập tên của bạn" required>
                </div>
                <div class="col-lg-6 col-md-6">
                    <input type="email" name="email" placeholder="Nhập địa chỉ email" required>
                </div>
                <div class="col-lg-6 col-md-6">
                    <input type="text" name="phone" placeholder="Nhập số điện thoại" required>
                </div>
                
                <div class="col-lg-12 text-center">
                    <textarea rows="7" name="feedback" placeholder="Nhập ý kiến của bạn" required></textarea>
                    <button type="submit" class="site-btn" onclick="alert('Bạn đã gửi yêu cầu thành công!')">Gửi yêu cầu</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- thong tin lien he -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_phone"></span>
                    <h4>Số điện thoại</h4>
                    <p>+84 29 399 99</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_pin_alt"></span>
                    <h4>Địa chỉ</h4>
                    <p>144 Xuân Thủy, Mai Dịch, Cầu Giấy</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_clock_alt"></span>
                    <h4>Thời gian mở cửa</h4>
                    <p>10:00 am - 23:00 pm</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="icon_mail_alt"></span>
                    <h4>Email</h4>
                    <p>hotro@ekomarket.com</p>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="map">
    <iframe
        src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d59602.19157607468!2d105.79381835!3d20.9871458!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1svi!2s!4v1649767186611!5m2!1svi!2s"
        height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
    <div class="map-inside">
        <i class="icon_pin"></i>
        <div class="inside-widget">
            <h4>Hà Nội</h4>
            <ul>
                <li>Điện thoại: 029 399 999</li>
                <li>Siêu thị xanh Eko Market</li>
            </ul>
        </div>
    </div>
</div>

@include('footer')