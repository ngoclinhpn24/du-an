<!DOCTYPE html>
<html lang="vn">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Siêu thị xanh Online">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Siêu thị xanh</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/lightslider.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('css/login.css')}}" type="text/css">
    <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v14.0&appId=1056488114945351&autoLogAppEvents=1" nonce="ckMtmjV5"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('backend/DataTables/datatables.min.css')}}"/>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v13.0" nonce="0tCBQjfG"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
</head>
<body>
<!-- header -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> hotro@ekomarket.com</li>
                                <li>Miễn phí giao hàng cho đơn từ 300k</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="https://www.facebook.com/ecomarket12/" target="_blank"><i class="fa fa-facebook"></i></a>
                                <a href="https://www.facebook.com/ecomarket12/" target="_blank"><i class="fa fa-twitter"></i></a>
                                <a href="https://www.facebook.com/ecomarket12/" target="_blank"><i class="fa fa-linkedin"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="{{asset('img/vn.png')}}" alt="">
                                <div>Tiếng Việt</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="">Tiếng Việt</a></li>
                                    <li><a href="{{url('lang/en')}}">English</a></li>
                                </ul>
                            </div>
                            <div class="header__top__right__auth">
                                <a href="{{route('admin')}}" target="_blank"><i class="fa-regular fa-user-gear"></i> Kênh người bán</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{route('index')}}"><img src="{{asset('img/eco.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li><a href="{{route('index')}}">Trang chủ</a></li>
                            <li><a href="{{url('market')}}">Cửa hàng</a></li>
                            <li><a href="{{url('blogs')}}">Blog nấu ăn</a></li>
                            <li><a href="{{url('contact')}}">Liên hệ</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            @php
                               $quantity = Session::get('cart') ? Session::get('cart')->totalQuantity : 0
                            @endphp
                            <li><a href="{{url('show-wishlist')}}"><i class="fa fa-heart"></i></a></li>
                            <li><a href="{{url('show-cart')}}"><i id="total-quantity" class="fa fa-shopping-bag"></i> <span>
                            @php
                                echo "$quantity"
                            @endphp
                            </span></a></li>
                        </ul>
                        <?php
                                   $user_id = Session::get('user_id');
                                   if($user_id!=NULL){ 
                                 ?>
                                 <div class="header__top__right__auth">
                                    <ul>
                                        <li> <a href="{{URL::to('/profile')}}"><i class="fa fa-user"></i> Trang cá nhân</a></li>
                                        <li> <a href="{{URL::to('/logout-user')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                    </ul>
                                 
                                </div>
                                <?php
                            }else{
                                 ?>
                                 <div class="header__top__right__auth">
                                 <a href="{{URL::to('/login-user')}}"><i class="fa fa-lock"></i> Đăng nhập</a>
                                </div>
                                 <?php 
                             }
                                 ?>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
<!-- Messenger Plugin chat Code -->
<div id="fb-root"></div>

<!-- Your Plugin chat code -->
<div id="fb-customer-chat" style="float: left" class="fb-customerchat">
</div>

<script>
  var chatbox = document.getElementById('fb-customer-chat');
  chatbox.setAttribute("page_id", "106205815403080");
  chatbox.setAttribute("attribution", "biz_inbox");
</script>

<!-- Your SDK code -->
<script>
  window.fbAsyncInit = function() {
    FB.init({
      xfbml            : true,
      version          : 'v13.0'
    });
  };

  (function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
</script>