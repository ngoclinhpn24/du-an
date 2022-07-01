@include('header')
@include('nav_user')

<!-- trang ca nhan nguoi dung -->
        <div class="col-lg-8 pb-5">
            <h3 style="text-align: center; margin-bottom: 15px;">Thông tin cá nhân</h3>
            <form class="row" action="{{url('change-profile')}}" method="POST">
            @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-fn">Tên</label>
                        <input required class="form-control" type="text" name="name" id="account-fn" value="{{$user->name}}" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-ln">Email</label>
                        <input required class="form-control" type="email" name="email" id="account-ln" value="{{$user->email}}" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-email">Số điện thoại</label>
                        <input required class="form-control" type="text" name="user_phone" id="account-email" value="{{$user->user_phone}}"
                        >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-email">Địa chỉ</label>
                        <input required class="form-control" type="text" name="user_address" id="account-email" value="{{$user->user_address}}"
                            >
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-success" type="submit" style="float: right">Cập nhật thông tin cá nhân</button>
                </div>
                </form>
                @if (!empty($shipping))
                    
                

            <h3 class="col-md-12" style="text-align: center; margin-top: 30px; margin-bottom:15px">Thông tin vận chuyển</h3>
            <form class="row" action="{{url('change-shipping')}}" method="POST">
            @csrf
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-fn">Họ</label>
                        <input required class="form-control" type="text" name="shipping_surname" id="account-fn" value="{{$shipping->shipping_surname ? $shipping->shipping_surname : ""}}" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-ln">Tên</label>
                        <input required class="form-control" name="shipping_name" type="text" id="account-ln" value="{{$shipping->shipping_name}}" required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-email">Email</label>
                        <input required class="form-control" name="shipping_email" type="email" id="account-email" value="{{$shipping->shipping_email}}"
                            >
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-phone">Số điện thoại</label>
                        <input required class="form-control" name="shipping_phone" type="text" id="account-phone" value="{{$shipping->shipping_phone}}"
                            required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-city">Tỉnh/Thành phố</label>
                        <input required class="form-control" name="shipping_city" type="text" id="account-city" value="{{$shipping->shipping_city}}"
                            required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-district">Quận/Huyện</label>
                        <input required class="form-control" name="shipping_town" type="text" id="account-district" value="{{$shipping->shipping_town}}"
                            required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-vlg">Xã/Phường</label>
                        <input required class="form-control" name="shipping_village" type="text" id="account-vlg" value="{{$shipping->shipping_village}}"
                            required="">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="account-address">Địa chỉ</label>
                        <input required class="form-control" name="shipping_address" type="text" id="account-address" value="{{$shipping->shipping_address}}"
                            required="">
                    </div>
                </div>
                <div class="col-md-12">
                    <button class="btn btn-success" type="submit" style="float: right">Cập nhật thông tin vận chuyển</button>
                </div>

                <div class="col-12">
                    <hr class="mt-2 mb-3">
                    <div class="d-flex flex-wrap justify-content-between align-items-center">
                    </div>
                </div>
                <input type="hidden" name="shipping_id" value="{{$shipping->shipping_id}}">
            </form>
        </div>
    </div>
    @endif
</div>
@include('footer')