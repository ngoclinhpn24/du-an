<!-- thanh navbar trai trong Trang ca nhan nguoi dung -->
<div class="container mb-4 main-container">
    <div class="row">
        <div class="col-lg-3 pb-5" style="margin-right: 50px">
            <div class="author-card pb-3">
                <div class="author-card-cover"
                    style="background-image: url(images/bg-food.jpg);">
                </div>
                <div class="author-card-profile">
                    <div class="author-card-avatar"><img src="images/avt3.jpg" alt="">
                    </div>
                    <div class="author-card-details"> 
            
                        <h5 class="author-card-name text-lg" style="margin-top: 10px; font-size: 15px">Tên: {{$user->name}}</h5>
                    </div>
                    <div class="author-card-details"> 
            
                        <h5 class="author-card-name text-lg" style="margin-top: 10px; font-size: 15px">Số điện thoại: {{$user->user_phone}}</h5>
                    </div>
                    <div class="author-card-details"> 
            
                        <h5 class="author-card-name text-lg" style="margin-top: 10px; font-size: 15px">Email: {{$user->email}}</h5>
                    </div>
                    <div class="author-card-details"> 
            
                        <h5 class="author-card-name text-lg" style="margin-top: 10px; font-size: 15px">Địa chỉ: {{$user->user_address}}</h5>
                    </div>
                    <div class="author-card-details">
            
                        <h5 class="author-card-name text-lg point" style="margin-top: 10px; font-size: 15px">Điểm Eko Point: {{$user->point}}</h5>
                    </div>
                    <div class="author-card-details"> 
            
                        <h5 class="author-card-name text-lg" style="margin-top: 10px; font-size: 15px">Ngày tham gia: {{$user->created_at}}</h5>
                    </div>
                </div>
            </div>
            <div class="wizard">
                <nav class="list-group list-group-flush">
                    <a class="list-group-item" href="{{url('profile')}}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fa fa-user mr-1 text-muted" aria-hidden="true"></i>
                                <div class="light d-inline-block font-weight-medium text-uppercase">Thông tin</div>
                            </div>
                        </div>
                    </a>
                    
                    <a class="list-group-item" href="{{url('exchange-gift')}}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fa fa-gift mr-1 text-muted"></i>
                                <div class="light d-inline-block font-weight-medium text-uppercase">Đổi quà</div>
                            </div>
                            
                        </div>
                    </a>
                    <a class="list-group-item" href="{{url('show-gift')}}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fa fa-heart mr-1 text-muted"></i>
                                <div class="light d-inline-block font-weight-medium text-uppercase">Danh sách quà</div>
                            </div>
                            
                        </div>
                    </a>
                    <a class="list-group-item" href="{{url('manage-order-user')}}" >
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fa fa-tag mr-1 text-muted"></i>
                                <div class="light d-inline-block font-weight-medium text-uppercase">Đơn hàng</div>
                            </div>                  
                        </div>
                    </a>
                    <a class="list-group-item" href="{{url('change-password')}}" >
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fa fa-key mr-1 text-muted"></i>
                                <div class="light d-inline-block font-weight-medium text-uppercase">Đổi mật khẩu</div>
                            </div>
                        </div>
                    </a>
                    <a class="list-group-item" href="{{url('logout-user')}}">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <i class="fa fa-sign-out text-muted"></i>
                                <div class="light d-inline-block font-weight-medium text-uppercase">Đăng xuất</div>
                            </div>
                        </div>
                    </a>
                </nav>
            </div>
        </div>